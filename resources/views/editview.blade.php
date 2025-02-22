@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Tananyag szerkesztése</div>

                        <div class="card-body">
                            <form method="POST" action="/edit/{{ $studyGuide->id }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Név</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $studyGuide->title }}" required autocomplete="name" autofocus>
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
                                        <input id="image" type="text" class="form-control @error('name') is-invalid @enderror" name="image" value="{{ $studyGuide->imageLink }}" required autocomplete="image" autofocus>
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
                                        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ $studyGuide->category }}" autocomplete="category" autofocus>
                                    </div>
                                </div>

                                <!-- Pdf file upload and delete checkbox -->
                                <div class="row">
                                    <label for="file" class="col-md-4 col-form-label text-md-end">Pdf fájl</label>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="file" name="file" class="form-control" id="inputGroupFile02">
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="delete_pdf" id="delete_pdf">
                                            <label class="form-check-label" for="delete_pdf">Delete current PDF file</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- HTML file upload and delete checkbox -->
                                <div class="row mb-3">
                                    <label for="docx" class="col-md-4 col-form-label text-md-end">Htm fájl</label>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="file" name="docx" class="form-control" id="inputGroupFile02">
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="delete_htm" id="delete_htm">
                                            <label class="form-check-label" for="delete_htm">Delete current HTML file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="subject" class="col-md-4 col-form-label text-md-end">Tantárgy</label>

                                    <div class="col-md-6">
                                        <select class="dropdown-toggle" name="subject" id="subject">
                                            <option class="dropdown-item" value="1">Fizika</option>
                                            <option class="dropdown-item" value="2">Irodalom</option>
                                            <option class="dropdown-item" value="3">Történelem</option>
                                            <option class="dropdown-item" value="4">Biológia</option>
                                            <option class="dropdown-item" value="5">Biológia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="grade" class="col-md-4 col-form-label text-md-end">Évfolyam</label>

                                    <div class="col-md-6">
                                        <select name="grade" id="grade">
                                            <option value="1">9</option>
                                            <option value="2">10</option>
                                            <option value="3">11</option>
                                            <option value="4">12</option>
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
                    <form method="POST" action="/logout">
                        @csrf
                        <button class=" mt-4 btn btn-primary">Kilépés</button>
                    </form>
                    <div class="row pt-4">
                        <form method="POST" action="/delete/{{ $studyGuide->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this study guide?')">Tananyag törlése</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
