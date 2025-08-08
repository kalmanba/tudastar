<!doctype html>

<!-- (c)2023-2025 Kürthy Márton && Hónap Híre Tudástár -->
<!-- Version: 2.20.2, last update: 2025.04.17. -->

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hónap Híre Tudástár</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Space+Grotesk|Space+Grotesk:bold">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Css -->
    <link rel="stylesheet" href="/css/landing.css">
    <link rel="stylesheet" href="/css/rainbow.css">
    <link rel="stylesheet" href="/css/pdf.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/img/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Tudástár" />
    <link rel="manifest" href="/img/favicon/site.webmanifest" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.6/dist/htmx.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar-bg navbar navbar-expand-lg text-light" style="background-color: #e3f2fd;" >
            <div class="container">
                <a class="navbar-brand text-light" href="/"><img src="/img/favicon/web-app-manifest-512x512.png" alt="Logo" width="25" height="24" class="d-inline-block align-text-top"> HHM Tudástár</a>
                <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon navbar-dark"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"><!--<li class="nav-item text-light"><a class="nav-link active text-light" aria-current="page" href="/">Főoldal</a></li>-->
                        <li class="nav-item dropdown "><span class=""><a target="_blank" class="nav-link active text-light" href="/" aria-expanded="true">Tantárgyak</a></span></li>
                        <li class="nav-item dropdown ">
                            <a class=" pr-5 nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Rólunk</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/about">Rólunk</a></li>
                                <li><a class="dropdown-item" href="/finance">Pénzügyeink</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/ASZF">ÁSZF</a></li>
                                <li><a class="dropdown-item" href="/copyright">Szerzői Jogok</a></li>
                            </ul>
                        <li class="nav-item"><a class="nav-link active text-light" href="https://store.honaphire.net/">Merch</a></li>
                        <li class="nav-item shadowBox"><a class="rainbow rainbow_text_animated" href="/donate">Támogatás</a></li>
                        <!--<li class="nav-item "><a class="nav-link text-light" href="/home/pages/contact.php">Kapcsolat</a></li>-->
                    </ul>
                    <!--
                    <ul class="d-flex navbar-nav">
                        <li class="nav-item"><a class="nav-link active text-light" href="/home/profile.php"><i class="bi bi-person-circle"></i> Profil</a></li>
                        <li class="nav-item "><a class="nav-link active text-light" href="/logout.php"><i class="bi bi-box-arrow-right"></i> Kijelentkezés</a></li>
                    </ul>-->
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
