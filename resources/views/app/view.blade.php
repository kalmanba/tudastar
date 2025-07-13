@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="display-6 text-info mb-1 text-dark"><a class="backspan fs-1 mb-4" href="/{{ $subject->slug }}/{{ $grade->slug }}"><i class="backspan bi bi-arrow-90deg-up"></i></a> {{ $subject->name }} -  <span class="h2 text-subtitle">{{ $study_guide->title }}</span></h1>

            @if($fileContents != '')
                <div class="word-content">
                    {!! $fileContents !!}
                </div>
            @endif

            @if($fileContents == "")
                <div id="pdfContainer" class="pdf-container"></div>
                <script>
                    const PDF_URL = '/storage/{{ $study_guide->content }}';
                </script>
                <script src="/js/pdfView.js"></script>
            @endif

        </div>
    </div>
@endsection
