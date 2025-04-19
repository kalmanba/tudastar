@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Order Confirmation</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="mb-3">Rendelését rögzítettük!</h3>
                    <p class="lead">A rendelésed száma: <strong>{{ $order->order_number }}</strong></p>
                    <p>A rendelést visszaigazoló ímélt az alábbi címre megküldtük: <strong>{{ $order->customer_email }}</strong></p>
                    
                    <div class="mt-4">
                        <a href="/store" class="button-bg btn btn-primary">
                            Vásárlás folytatása
                        </a>
                        <a href="/" class="btn btn-outline-secondary ms-2">
                            Főoldalra
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection