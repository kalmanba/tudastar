@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="display-6 text-info mb-1 text-dark"><a class="backspan fs-1 mb-4"
                    href="/{{ $subject->slug }}/{{ $grade->slug }}"><i class="backspan bi bi-arrow-90deg-up"></i></a>
                {{ $subject->name }} - <span class="h2 text-subtitle">{{ $study_guide->title }}</span></h1>

            @if($fileContents != '')
                <div class="word-content">
                    {!! $fileContents !!}
                </div>
            @endif

            @if($fileContents == "")
                <div id="pdf-viewer">
                    <div id="loading-message">
                        <div></div> <!-- Simple spinner placeholder -->
                        Loading PDF...
                    </div>
                </div>

                <script>
                    // The URL of your PDF document. Replace with your actual PDF URL.
                    const pdfUrl = '/storage/{{ $study_guide->content }}'; // Example PDF
                </script>
                <!-- PDF.js library -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.0.379/pdf.min.mjs" type="module"></script>
                <script type="module" src="/js/pdfView.js"></script>
            @endif

        </div>
    </div>
@endsection