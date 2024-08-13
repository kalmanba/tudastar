@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-info-emphasis text-center pb-4">Támogatás</h1>
        <section id="about">
            <div class="container px-lg-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Közvetlen támogatás</h2>
                        <p class="lead">
                            Támogasd a Tudástárt közvetlenül bankkártyával, a Buymeacoffee.com oldalon keresztül.
                        </p>
                        <a target="_blank" class="mb-4" href="https://www.buymeacoffee.com/hhtudastar"><img lass="mb-4" src="https://img.buymeacoffee.com/button-api/?text=Vegyél egy teát&emoji=🫖&slug=hhtudastar&button_colour=40DCA5&font_colour=ffffff&font_family=Bree&outline_colour=000000&coffee_colour=FFDD00" /></a>
                    </div>
                </div>
            </div>
            <div class="container mt-3 px-lg-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Egy palack a tudástárért</h2>
                        <p class="lead mb-4">Add a plackok betétdíát a tudástárnak. Szkenneld be az alábbi kódot a REPont autómatával, ezt követően az 50Ft-ok a Tudástár támogatásához járulnak majd hozzá.</p>
                        <div class="qr-code-container">
                            <img src="https://i.imgur.com/2T34z5T.png" alt="QR Code" class="qr-code">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
