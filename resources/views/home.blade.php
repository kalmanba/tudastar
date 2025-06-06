@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
         <div class="col-12">
             <h1 class="text-info-emphasis">Üdv a tudástárban!</h1>
             <p>Ezen tudástár célja, hogy az itt felsorolt középiskolai tantárgyak elsajátításást segítse. Az itt található összefoglalók és segédletek összessége (remélhetőleg) tartalmazza az adott témakör elsajátításához szükséges anyagot. A kártyák segítségével válaszd ki azt a tantárgyat és évfolyamot ami érdekel, és nézz körül milyen anyagok állnak rendelkezésre.</p>
             <h2 class="text-danger mt-2">A tudástár fennmaradása veszélyben!</h2>
             <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                 <div class="progress-bar progress-bar-striped progress-bar-animated {{ $bgColor }}" style="width: {{ $fund }}"></div>
             </div>
             <p class="fw-bold">A{{ $month }} havi költségeinknek {{ $fund }}-a fedezett. Ha igazán segítségedre volt az, amit itt találtál kérlek fontold meg a tudástár
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
                                    <a href="/{{ $subject->slug }}"><button class="button-bg btn btn-info">Megnézem</button></a>

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
     @endforeach
    </div>
</div>
@endsection
