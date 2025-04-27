@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Új tananyag</div>

                    <div class="card-body">
                        <form method="POST" action="/newguide" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Név</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">Kép</label>

                                <div class="col-md-6">
                                    <input id="image" type="text" class="form-control @error('name') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-md-4 col-form-label text-md-end">Kategória</label>

                                <div class="col-md-6">
                                    <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}"  autocomplete="category" autofocus>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-end">Pdf fájl</label>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="file" name="file" class="form-control" id="inputGroupFile02">
                                    </div>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="docx" class="col-md-4 col-form-label text-md-end">Htm fájl</label>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="file" name="docx" class="form-control" id="inputGroupFile02">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subject" class="col-md-4 col-form-l abel text-md-end">Tantárgy</label>

                                <div class="col-md-6">
                                    <select class="dropdown-toggle" name="subject" id="subject">
                                        @foreach ($subjects as $subject)
                                            <option class="dropdown-item-form" value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="grade" class="col-md-4 col-form-label text-md-end">Évfolyam</label>

                                <div class="col-md-6">
                                    <select name="grade" id="grade">
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Feltöltés
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <button type="button" class="btn btn-warning" id="sendRequest">Send Request</button>
                <script>
                    document.getElementById('sendRequest').addEventListener('click', function() {
                        // Data to be sent to the backend
                        const data = { data: 'HelloWorld' };

                        // Get CSRF token from meta tag
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        // Sending a POST request to the PHP backend with CSRF token
                        fetch('/release-upgrade', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify(data)
                        })
                            .then(response => response.text())
                            .then(data => {
                                // Display the output in a JavaScript alert
                                alert(data);
                            })
                            .catch(error => console.error('Error:', error));
                    });
                </script>
                <form method="POST" action="/logout">
                    @csrf
                    <button class=" mt-4 btn btn-primary">Kilépés</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
