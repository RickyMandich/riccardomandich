<!doctype html>
<html data-bs-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/favicon.ico?v={{ time() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])

    <!-- inclusion -->
    @yield('include')
</head>

@yield('style')

<body>
    <div id="app" class="d-flex flex-column justify-content-between min-vh-100">
        <nav class="navbar navbar-expand-md shadow-sm bg-secondary">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center text-warning" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </nav>


        <main class="@yield('main-class', 'py-4') flex-grow-1 d-flex flex-column">
            <div class="@yield('container-class', 'container') content @yield('content-class')">
                @yield('content')
            </div>
        </main>

        <footer class="bg-secondary mt-auto pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-center">
                        <p class="mb-1">
                            <span class="text-warning"><i class="bi bi-alarm"></i>
                                {{ now()->format('d/m/Y H:i:s') }}</span>
                        </p>
                        <p>
                            {{ env('APP_VERSION') }}
                            hosted with
                            <small class="text-muted text-uppercase">
                                <a href="https://altervista.org" target="_blank" rel="noopener noreferrer">altervista
                                </a>
                            </small>
                            <br>
                            created with
                            <small class="text-muted text-uppercase">
                                <a href="https://laravel.com/docs/12.x" target="_blank"
                                    rel="noopener noreferrer">laravel</a>
                            </small>
                        </p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="row">
                            <h6 class="col-8">
                                informazioni personali
                            </h6>
                            <span class="col-4"></span>
                            <div class="col-3">
                                <ul>
                                    <li>
                                        telefono
                                    </li>
                                    <li>
                                        mail
                                    </li>
                                    <li>
                                        nascita
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul>
                                    <li>
                                        <small class="text-muted text-uppercase">
                                            +39 370 351 3963
                                        </small>
                                    </li>
                                    <li>
                                        <small class="text-muted text-uppercase">
                                            <a href="mailto:riccardo.mandich.25@itsaltoadriatico.it" target="_blank"
                                                rel="noopener noreferrer">
                                                riccardo.mandich.25@itsaltoadriatico.it
                                            </a>
                                        </small>
                                    </li>
                                    <li>
                                        <small>
                                            2026/07/06
                                        </small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </footer>
    </div>
    @yield('script')
</body>

</html>