@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
         <div class="col-12">
             <h1 class="text-info-emphasis">Tudástár Shop</h1>
         </div>
     </div>
     <h1 class="text-subtitle">Termékek</h1>
     <div class="row">
     @foreach($modifiedStores as $modifiedStore)
                 <div class="col-sm-4 mb-4">
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
@endsection
