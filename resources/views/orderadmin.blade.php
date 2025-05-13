@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Orders</h1>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="hideArchived" 
                   {{ request()->has('hide_archived') && request()->hide_archived ? 'checked' : '' }}>
            <label class="form-check-label" for="hideArchived">Hide Archived</label>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Payment Method</th>
                    <th>Address</th>
                    <th>Notes</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        {{ $order->customer_name }}<br>
                        {{ $order->customer_email }}<br>
                        {{ $order->customer_phone }}
                    </td>
                    <td>
                        @php
                            $paymentMethods = [
                                'credit_card' => 'Credit Card',
                                'paypal' => 'PayPal',
                                'bank_transfer' => 'Bank Transfer',
                                'cash_on_delivery' => 'Cash on Delivery'
                            ];
                        @endphp
                        {{ $paymentMethods[$order->payment_method] ?? ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                    </td>
                    <td>{{ $order->shipping_address }}</td>
                    <td>{{ $order->notes }}</td>
                    <td>
                        @foreach($order->cart_items as $item)
                            {{ $item['name'] }}: {{ $item['price'] }} × {{ $item['quantity'] }}<br>
                        @endforeach
                    </td>
                    <td>{{ $order->total_amount }}</td>
                    <td>
                        <span class="badge bg-{{ [
                            'pending' => 'warning',
                            'processing' => 'info',
                            'shipped' => 'primary',
                            'pickup' => 'primary',
                            'completed' => 'success',
                            'archived' => 'secondary'
                        ][$order->status] }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" 
                                    data-bs-target="#editModal-{{ $order->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            
                            <!-- Pickup Date Button -->
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" 
                                    data-bs-target="#pickupModal-{{ $order->id }}">
                                <i class="bi bi-calendar"></i>
                            </button>
                            
                            <!-- Tracking Button -->
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" 
                                    data-bs-target="#trackingModal-{{ $order->id }}">
                                <i class="bi bi-truck"></i>
                            </button>
                            
                            <!-- Archive Button -->
                            <form action="{{ route('admin.orders.archive', $order) }}" method="POST" 
                                  onsubmit="return confirm('Archive this order?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-archive"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $orders->links() }}
    </div>
</div>

<!-- Modals for each order -->
@foreach($orders as $order)
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Order #{{ $order->order_number }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" 
                                   value="{{ $order->customer_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" class="form-control" name="customer_email" 
                                   value="{{ $order->customer_email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" name="payment_method">
                                @foreach([
                                    'credit_card' => 'Credit Card',
                                    'paypal' => 'PayPal',
                                    'bank_transfer' => 'Bank Transfer',
                                    'cash_on_delivery' => 'Cash on Delivery'
                                ] as $value => $label)
                                    <option value="{{ $value }}" {{ $order->payment_method == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                @foreach(['pending', 'processing', 'shipped', 'completed', 'archived'] as $status)
                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Pickup Date Modal -->
    <div class="modal fade" id="pickupModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.orders.pickup', $order) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Set Pickup Date</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pickup Date</label>
                            <input type="datetime-local" class="form-control" name="pickup_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Tracking Modal -->
    <div class="modal fade" id="trackingModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.orders.tracking', $order) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Set Tracking Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tracking Number</label>
                            <input type="text" class="form-control" name="tracking_number" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    // Toggle archived orders
    document.getElementById('hideArchived').addEventListener('change', function() {
        const url = new URL(window.location.href);
        if (this.checked) {
            url.searchParams.set('hide_archived', true);
        } else {
            url.searchParams.delete('hide_archived');
        }
        window.location.href = url.toString();
    });
</script>
@endsection