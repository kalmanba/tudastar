@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="display-6 text-info mb-1 text-dark"><a class="backspan fs-1 mb-4" href="/list-guides?_token={{ csrf_token() }}&subject_id={{ $study_guide->subject_id }}&grade_id={{ $study_guide->grade_id }}"><i class="backspan bi bi-arrow-90deg-up"></i></a> {{ $subject->name }} -  <span class="h2 text-subtitle">{{ $study_guide->title }}</span></h1>

            @if($fileContents != '')
                <div class="word-content">
                    {!! $fileContents !!}
                </div>
            @endif

            @if($fileContents == "")
                <div id="adobe-dc-view" style="margin: 0 auto;"></div>
                <script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>
                <script type="text/javascript">
                    document.addEventListener("adobe_dc_view_sdk.ready", function(){
                        var adobeDCView = new AdobeDC.View({clientId: "84277f96dab74221ae1f38e5321c3451", divId: "adobe-dc-view"});
                        adobeDCView.previewFile({
                            content:{location: {url: "/storage/{{ $study_guide->content }}"}},
                            metaData:{fileName: "{{ $study_guide->title }}"}
                        }, {embedMode: "IN_LINE", showDownloadPDF: false, showPrintPDF: false});
                    });
                </script>
            @endif

        </div>
    </div>
@endsection
