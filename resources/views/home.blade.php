@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
         <div class="col-12">
             <h1 class="text-info-emphasis">Üdv a tudástárbasn!</h1>
             <p>Ezen tudástár célja, hogy az itt felsorolt középiskolai tantárgyak elsajátításást segítse. Az itt található összefoglalók és segédletek összessége (remélhetőleg) tartalmazza az adott témakör elsajátításához szükséges anyagot. A kártyák segítségével válaszd ki azt a tantárgyat és évfolyamot ami érdekel, és nézz körül milyen anyagok állnak rendelkezésre.</p>
             <p>Ha igazán segítségedre volt az, amit itt találtál kérlek fontold meg a tudástár
                 <a class="text-decoration-none" target="_blank" href="https://buymeacoffee.com/hhtudastar"><span class="rainbow_text_animated">támogatását</span></a>.</p>
         </div>
     </div>
     <h1 class="text-subtitle">Tantárgyak</h1>
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
                 <div class="col-sm-4 mb-4 mb-sm-0">
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
