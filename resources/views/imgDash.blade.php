@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Új kép</div>

                        <div class="card-body">
                            <form hx-boost="true" method="POST" action="/images" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="docx" class="col-md-4 col-form-label text-md-end">Kép fájl</label>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="file" name="image" class="form-control" id="inputGroupFile02"
                                                required>
                                        </div>
                                        <span id="imgPath">https://learn.honaphire.net/storage/{{ $topImage ?? '' }}</span>
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
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Képek</div>
                        <details style="margin: 10px 20px;">
                            <summary>Képek</summary>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>Kép</th>
                                        <th>Törlés</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <td>
                                                <a href="/storage/{{ $image->imgPath }}" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <img width="76px" height="51px" src="/storage/{{ $image->imgPath }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <form hx-boost="true" method="POST" action="/images">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                                    <button type="submit">
                                                        BIN
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </details>
                    </div>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class=" mt-4 btn btn-primary">Kilépés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            document.getElementById("imgPath").addEventListener("click", function () {
            const content = this.innerHTML;

            // Create a temporary textarea to copy the content
            const tempInput = document.createElement("textarea");
            tempInput.value = content;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

      });
    </script>
@endsection