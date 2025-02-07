@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-info-emphasis text-center pb-4">A tudástár pénzügyei</h1>
        <!-- About section-->
        <section id="about">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8 fs-5">
                        <h2>Költségek és bevételek</h2>
                        <p>A tudástár fenntartása a befektetett munkán felül további költségeket is vonz maga után.</p>
                        <ul>
                            <li>Server (netcup GmbH.): <span class="fw-bold">€5,08/hó</span></li>
                            <li>Domain honahire.net (Namecheap, Inc.): <span class="fw-bold">€13,50/év</span></li>
                        </ul>
                        <p class="fw-bold">Ha igazán segítségedre volt az, amit itt találtál kérlek fontold meg a tudástár
                            <a class="text-decoration-none" href="/donate"><span class="rainbow_text_animated">támogatását</span></a>.</p>
                    </div>
                </div>
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8 fs-5">
                        <h2>Részletes költségkimutatások</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Dátum</th>
                                <th scope="col">Pénztár nyitó</th>
                                <th scope="col">Pénzátr záró</th>
                                <th scope="col">Részletek</th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            
                            <tr>
                                <th scope="row">2025. jan</th>
                                <td>- 7.625 Ft</td>
                                <td>- 1.092 Ft</td>
                                <td><a href="https://cloud.kurthy.org/s/iZWtspf2BAeHtK9"><button class="button-bg btn btn-info">Megnézem</button></a></td>
                            </tr>
                            <tr>
                                <th scope="row">2024</th>
                                <td>0 Ft</td>
                                <td>- 7.625 Ft</td>
                                <td><a target="_blank" href="https://cloud.kurthy.org/s/XWdNja8PTxLSdw8"><button class="button-bg btn btn-info">Megnézem</button></a></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
