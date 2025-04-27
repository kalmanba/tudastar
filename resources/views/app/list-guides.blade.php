@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="display-6 text-info mb-2 text-dark">
                <a class="backspan fs-1" href="/{{ $subject->slug }}">
                    <i class="backspan bi bi-arrow-90deg-up"></i>
                </a>
                {{ $subject->name }} - <span class="text-subtitle h2">{{ $grade->grade }}. osztály</span>
            </h1>
            @foreach($studyGuides as $category => $guides)
                <div class="category-section">
                    @if($category)
                        <h2 class="text-subtitle">{{ $category }}</h2>
                    @else
                        <h2 class="text-subtitle">Elérhető tananyagok</h2>
                    @endif
                    <div class="row">
                        @foreach($guides as $studyGuide)
                            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-3">
                                <div class="card h-100 d-flex flex-column">
                                    <img src="{{ $studyGuide->imageLink }}" class="card-img-top cardimg" alt="">
                                    <div class="card-body flex-grow-1">
                                        <h2 class="h5 mb-3 card-title lh-base fw-bold">{{ $studyGuide->title }}</h2>
                                    </div>
                                    <div class="px-3 pb-3 mt-auto">
                                        <div class="d-flex justify-content-between">
                                            <a href="/{{ $subject->slug }}/{{ $grade->slug }}/{{ $studyGuide->slug }}">
                                                <button class="button-bg btn btn-info">Megnézem</button>
                                            </a>
                                            @if(Auth::user())
                                                <form method="POST" action="/editview">
                                                    @csrf
                                                    <input name="guide_id" type="hidden" value="{{$studyGuide->id}}">
                                                    <button class="btn btn-outline-warning">Szerkesztés</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

