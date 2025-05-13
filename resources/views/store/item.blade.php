@extends('layouts.app')

@section('content')
<script defer type="module" src="/js/add.js"></script>

<div class="container">
     <div class="row">
         <div class="col-12">
             <h1 class="text-info-emphasis">Tudástár Shop</h1>
         </div>
     </div>
    <div class="row">
        <div class="col-lg-5">
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    @if(isset($store->images['images']) && is_array($store->images['images']))
                        @foreach($store->images['images'] as $index => $imageUrl)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $imageUrl }}" class="d-block w-100" alt="Product image {{ $index + 1 }}">
                            </div>
                        @endforeach
                    @elseif(is_array($store->images))
                        @foreach($store->images as $index => $imageUrl)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $imageUrl }}" class="d-block w-100" alt="Product image {{ $index + 1 }}">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="https://placehold.co/600x400?text=Nincs+K%C3%A9p" class="d-block w-100" alt="No image available">
                        </div>
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-lg-7">
            <h1 class="text-subtitle"> {{ $store->name }} </h1>
            <p><span class="badge rounded-pill {{ $status_Colour }}">{{ $status }}</span><span class="mx-2 badge rounded-pill text-bg-primary">{{ $store->qty }}db raktáron</span></p>
            <div class='content'>
                {!! $store->desc !!}
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <form id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $store->id }}">
                        
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Menyiség</label>
                            <div class="input-group" style="max-width: 150px;">
                                <button type="button" class="btn btn-outline-secondary quantity-minus">-</button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="10" class="form-control text-center">
                                <button type="button" class="btn btn-outline-secondary quantity-plus">+</button>
                            </div>
                        </div>
                        
                        <button type="submit" class="button-bg btn btn-primary w-100">
                            <i class="bi bi-cart-plus"></i> Kosárba helyezés
                        </button>
                    </form>
                    <div id="cart-message" class="mt-2 alert d-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script defer type="module" src="/js/cart.js"></script>

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