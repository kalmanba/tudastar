@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="display-6 text-info mb-2 text-dark">
                <a class="backspan fs-1" href="/gradeselector?_token={{ csrf_token() }}&subject_id={{ $subjectid }}">
                    <i class="backspan bi bi-arrow-90deg-up"></i>
                </a>
                {{ $subject }} - <span class="text-subtitle h2">{{ $grade }}. osztály</span>
            </h1>
            <h2 class="text-subtitle">Elérhető tananyagok:</h2>
            @foreach($studyGuides as $studyGuide)
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-3">
                    <div class="card h-100 d-flex flex-column">
                        <img src="{{ $studyGuide->imageLink }}" class="card-img-top cardimg" alt="">
                        <div class="card-body flex-grow-1">
                            <h2 class="h5 mb-3 card-title lh-base fw-bold">{{ $studyGuide->title }}</h2>
                        </div>
                        <div class="px-3 pb-3 mt-auto">
                            <div class="d-flex justify-content-between">
                                <a href="/view-guide/{{$studyGuide->id}}">
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
@endsection
