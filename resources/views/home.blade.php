@extends('layouts.app')

@section('content')
 <div class="container">

     <style>
         /* customizable snowflake styling */
         .snowflake {
             color: #fff;
             font-size: 1em;
             font-family: Arial, sans-serif;
             text-shadow: 0 0 5px #000;
         }

         .snowflake,.snowflake .inner{animation-iteration-count:infinite;animation-play-state:running}@keyframes snowflakes-fall{0%{transform:translateY(0)}100%{transform:translateY(110vh)}}@keyframes snowflakes-shake{0%,100%{transform:translateX(0)}50%{transform:translateX(80px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;user-select:none;cursor:default;animation-name:snowflakes-shake;animation-duration:3s;animation-timing-function:ease-in-out}.snowflake .inner{animation-duration:10s;animation-name:snowflakes-fall;animation-timing-function:linear}.snowflake:nth-of-type(0){left:1%;animation-delay:0s}.snowflake:nth-of-type(0) .inner{animation-delay:0s}.snowflake:first-of-type{left:10%;animation-delay:1s}.snowflake:first-of-type .inner,.snowflake:nth-of-type(8) .inner{animation-delay:1s}.snowflake:nth-of-type(2){left:20%;animation-delay:.5s}.snowflake:nth-of-type(2) .inner,.snowflake:nth-of-type(6) .inner{animation-delay:6s}.snowflake:nth-of-type(3){left:30%;animation-delay:2s}.snowflake:nth-of-type(11) .inner,.snowflake:nth-of-type(3) .inner{animation-delay:4s}.snowflake:nth-of-type(4){left:40%;animation-delay:2s}.snowflake:nth-of-type(10) .inner,.snowflake:nth-of-type(4) .inner{animation-delay:2s}.snowflake:nth-of-type(5){left:50%;animation-delay:3s}.snowflake:nth-of-type(5) .inner{animation-delay:8s}.snowflake:nth-of-type(6){left:60%;animation-delay:2s}.snowflake:nth-of-type(7){left:70%;animation-delay:1s}.snowflake:nth-of-type(7) .inner{animation-delay:2.5s}.snowflake:nth-of-type(8){left:80%;animation-delay:0s}.snowflake:nth-of-type(9){left:90%;animation-delay:1.5s}.snowflake:nth-of-type(9) .inner{animation-delay:3s}.snowflake:nth-of-type(10){left:25%;animation-delay:0s}.snowflake:nth-of-type(11){left:65%;animation-delay:2.5s}
     </style>
     <div class="snowflakes" aria-hidden="true">
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
         <div class="snowflake">
             <div class="inner">❅</div>
         </div>
     </div>

     <div class="row">
         <div class="col-12">
             <h1 class="text-info-emphasis">Üdv a tudástárban!</h1>
             <p>Ezen tudástár célja, hogy az itt felsorolt középiskolai tantárgyak elsajátításást segítse. Az itt található összefoglalók és segédletek összessége (remélhetőleg) tartalmazza az adott témakör elsajátításához szükséges anyagot. A kártyák segítségével válaszd ki azt a tantárgyat és évfolyamot ami érdekel, és nézz körül milyen anyagok állnak rendelkezésre.</p>
             <h2 class="text-danger mt-2">A tudsátár fennmaradása veszélyben!</h2>
             <p class="fw-bold">A tudástár szerereinek költségeit az eseti támogatások nem fedezik. Ha igazán segítségedre volt az, amit itt találtál kérlek fontold meg a tudástár
                 <a class="text-decoration-none fw-bold" target="_blank" href="/donate"><span class="rainbow_text_animated">rendszeres támogatását</span></a>!</p>
         </div>
     </div>
     <h1 class="text-subtitle">Tantárgyak</h1>
     @if(session('showcd'))
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script defer>
             $(document).ready(function(){
                 $('#staticBackdrop2').modal('show'); // Replace 'yourModalId' with your actual modal ID
             });
         </script>
     @endif
     @if(session('showModal'))
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script defer>
             $(document).ready(function(){
                 $('#staticBackdrop').modal('show'); // Replace 'yourModalId' with your actual modal ID
             });
         </script>
     @endif
     <!-- Modal -->
     <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="staticBackdropLabel">Tananyagok nem találhatók!</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <p>Jelenleg egyetlen elérhető tananyagunk sincs ami a kritériumoknak (<span class="fw-bold">{{ session('subject') ?? 'N/A' }} - {{ session('grade') ?? 'N/A' }}. osztály</span>) megfelelne.</p>
                     <p>Folyamatosan dolgozunk a tudástár bővítésén, amíg feltöltjük amit keresel, nézz körül további anyagaink között.</p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Bezárás</button>
                 </div>
             </div>
         </div>
     </div>
     <div class="row">
     @foreach($subjects as $subject)
                 <div class="col-sm-4 mb-4">
                     <div class="card h-100">
                         <img src="{{ $subject->imageLink }}" class="card-img-top cardimg" alt="">
                         <div class="card-body">
                             <h3 class="h4 fw-bold mb-3 card-title lh-base">{{ $subject->name }}</h3>
                             <div class="row align-items-center">
                                 <div class="order-2 order-lg-1 col-lg-6">
                                     <form method="GET" action="/gradeselector">
                                         @csrf
                                         <input name="subject_id" type="hidden" value="{{ $subject->id }}">
                                         <button class="button-bg btn btn-info">Megnézem</button>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
     @endforeach
    </div>
</div>
@endsection
