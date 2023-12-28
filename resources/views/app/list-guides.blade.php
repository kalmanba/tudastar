@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="display-6 text-info mb-2 text-dark"><a class="backspan fs-1" href="/gradeselector?_token={{ csrf_token() }}&subject_id={{ $subjectid }}"><i class="backspan bi bi-arrow-90deg-up"></i></a> {{ $subject }} - <span class="text-subtitle h2 ">{{ $grade }}. osztály</span></h1>
            <h2 class="text-subtitle">Elérhető tananyagok:</h2>
            @foreach($studyGuides as $studyGuide)
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <img src="{{ $studyGuide->imageLink }}" class="card-img-top cardimg" alt="">
                        <div class="card-body">
                            <h2 class="h5 mb-3 card-title lh-base fw-bold">{{ $studyGuide->title }}</h2>
                            <div class="row align-items-center">
                                <div class="order-2 order-lg-1 col-lg-6">
                                    <a href="/view-guide/{{$studyGuide->id}}"><button class="button-bg btn btn-info">Megnézem</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
