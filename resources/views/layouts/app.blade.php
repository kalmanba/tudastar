<!doctype html>

<!-- (c)2023-2025 Kürthy Márton && Hónap Híre Tudástár -->
<!-- Version: 2.17.3, last update: 2025.01.12. -->

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

    <!-- Css -->
    <link rel="stylesheet" href="/css/landing.css">
    <link rel="stylesheet" href="/css/rainbow.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar-bg navbar navbar-expand-lg text-light" style="background-color: #e3f2fd;" >
            <div class="container">
                <a class="navbar-brand text-light" href="/"><img src="/img/android-chrome-512x512.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> HHM Tudástár</a>
                <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon navbar-dark"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item text-light"><a class="nav-link active text-light" aria-current="page" href="/">Főoldal</a></li>
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
    <script type="text/javascript" src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>
</body>
</html>
