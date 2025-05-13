@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="text-info-emphasis">Tudástár Shop</h1>
    <div class="row">
    
        <div class="mb-4 col-md-8">
            <div class="card">
                <div class="card-header navbar-bg text-white">
                    <h4 class="mb-0">Véglegesítés</h4>
                </div>
                <div class="card-body">
                    <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        
                        <h5 class="mb-3">Személyes Adatok</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label">Teljes Név</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="customer_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                            </div>
                            <div class="col-12">
                                <label for="customer_phone" class="form-label">Telefonszám</label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                            </div>
                        </div>

                        <h5 class="mb-3">Szállítási cím</h5>
                        <div class="mb-4">
                            <label for="shipping_address" class="form-label">Cím (A személyes átvételt is ebben a mezőben jelezheti)</label>
                            <textarea class="form-control" id="shipping_address" name="shipping_address" placeholder="pl.: 8888 Simagöröngyös, Keskeny-Széles utca 42." rows="3" required></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="same-billing" checked>
                            <label class="form-check-label" for="same-billing">
                                Számlázási cím megegyezik a szállításival
                            </label>
                        </div>

                        <div id="billing-address-section" class="mb-4 d-none">
                            <h5 class="mb-3">Számlázási cím</h5>
                            <label for="billing_address" class="form-label">Cím</label>
                            <textarea placeholder="pl.: 8888 Simagöröngyös, Keskeny-Széles utca 42." class="form-control" id="billing_address" name="billing_address" rows="3"></textarea>
                        </div>

                        <h5 class="mb-3">Fizetési Mód</h5>
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank-transfer" value="bank_transfer">
                                <label class="form-check-label" for="bank-transfer">
                                    Átutalás (A részleteket emailben továbbítjuk.)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cash-on-delivery" value="cash_on_delivery">
                                <label class="form-check-label" for="cash-on-delivery">
                                    Készpénz átvételkor
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Megjegyzés</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="..."></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Rendelésed</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        @foreach($cartItems as $itemId => $quantity)
                            @php
                                $item = App\Models\Store::find($itemId);
                                $itemTotal = $item ? $item->price * $quantity : 0;
                            @endphp
                            @if($item)
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0">{{ $item->name }}</h6>
                                        <small class="text-muted">{{ $quantity }} × {{ $item->price }} Ft</small>
                                    </div>
                                    <span class="text-muted">{{ $itemTotal }} Ft</span>
                                </li>
                            @endif
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <span>Összesen</span>
                            <strong>{{ $total }} Ft</strong>
                        </li>
                    </ul>

                    <button type="submit" form="checkout-form" class="button-bg btn btn-primary w-100 py-2">
                        Véglegesítés
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Show/hide billing address section
    document.getElementById('same-billing').addEventListener('change', function() {
        const billingSection = document.getElementById('billing-address-section');
        if (this.checked) {
            billingSection.classList.add('d-none');
        } else {
            billingSection.classList.remove('d-none');
        }
    });
</script>

@endsection