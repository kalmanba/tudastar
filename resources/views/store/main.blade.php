@extends('layouts.app')

@section('content')

 <div class="container">
     <div class="row">
         <div class="col-12">
             <h1 class="text-info-emphasis">Tudástár Shop</h1>
             <p>Ezen oldalrész célja, hogy Tudsátár feliratos és logós termékek vásárlását lehetővé tegye. A tudásár "merch" vásárlásával úgy támogathatod az oldal fenmaradását, hogy közben egy igazán stílusos tárgyal gazdagodsz.</p>
         </div>
     </div>
     <h1 class="text-subtitle">Termékek</h1>
     <div class="row">
     @foreach($modifiedStores as $modifiedStore)
                 <div class="col-sm-6 col-lg-4 mb-4">
                     <div class="card h-100">
                         <img src="{{ $modifiedStore['images']}}" class="card-img-top cardimg" alt="">
                         <div class="card-body">
                            <h3 class="h4 fw-bold mb-3 card-title lh-base">{{ $modifiedStore['name'] }}</h3>
                            
                             <div class="row">
                                <div class="col-6">
                                <div class="order-2 order-lg-1 col-lg-6">
                                    <a href="/store/item/{{ $modifiedStore['id'] }}"><button class="button-bg btn btn-info">Megnézem</button></a>
                                 </div>
                                </div>
                                <div class="col-6">
                                    <h3 class="h4 fw-bold mb-3 card-title text-end">{{ $modifiedStore['price'] }} Ft</h3>
                                </div>
                             </div>
                         </div>
                     </div>
                 </div>
     @endforeach
    </div>
</div>
<script type="module" src="/js/cart.js"></script>
<!-- Floating Cart Button -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000;">
    <button id="cart-button" class="btn btn-primary rounded-circle p-0" 
            style="width: 56px; height: 56px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-cart-fill fs-4"></i>
    </button>
</div>

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kosár</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cart-content">
                <!-- Cart items will be loaded here -->
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Betöltés</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vásárlás folytatása</button>
                <a href="/checkout" class="btn btn-primary">Véglegesítés</a>
            </div>
        </div>
    </div>
</div>
@endsection
