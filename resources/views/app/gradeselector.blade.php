@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="display-6 text-info mb-1 text-dark"><a class="backspan fs-2" href="/"><i class="backspan bi bi-arrow-90deg-up"></i></a> {{ $subject->name }}</h1>
        <h2 class="text-subtitle">Évfolyamválasztó:</h2>
    @foreach($grades as $grade)
            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card h-100">
                <img src="{{ $grade->imageLink }}" class="card-img-top cardimg" alt="">
                <div class="card-body">
                    <h3 class="h6 mb-3 card-title lh-base fw-bold">{{ $grade->grade }}. osztály</h3>
                    <div class="row align-items-center">
                        <div class="order-2 order-lg-1 col-lg-6">
                            <a href="/{{ $subject->slug }}/{{ $grade->slug }}"><button class="button-bg btn btn-info">Megnézem</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
