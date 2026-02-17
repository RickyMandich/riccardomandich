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
        <nav class="navbar navbar-expand-md shadow-sm glass-nav sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center text-warning fw-bold" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </nav>


        <main class="@yield('main-class', 'py-4') flex-grow-1 d-flex flex-column">
            <div class="@yield('container-class', 'container') content @yield('content-class')">
                @yield('content')
            </div>
        </main>

        <footer class="glass-footer mt-auto py-4">
            <div class="main-container px-3">
                <div class="row g-4 align-items-center">
                    <div class="col-12 col-md-6 text-center text-md-start">
                        <p class="mb-2">
                            <span class="text-warning fw-bold"><i class="bi bi-alarm-fill me-2"></i>
                                {{ now()->format('d/m/Y H:i:s') }}</span>
                        </p>
                        <p class="small mb-0 opacity-75">
                            {{ env('APP_VERSION') }} | Hosted on
                            <a href="https://altervista.org" target="_blank"
                                class="text-info text-decoration-none">Altervista</a>
                            <br>
                            Created with
                            <a href="https://laravel.com/docs/12.x" target="_blank"
                                class="text-info text-decoration-none">Laravel 12</a>
                        </p>
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-end">
                        <h6 class="text-warning text-uppercase mb-2 small fw-bold">Contatti</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <span class="text-muted small text-uppercase">Tel:</span>
                                <small class="text-white"> +39 370 351 3963</small>
                            </li>
                            <li>
                                <span class="text-muted small text-uppercase">Mail:</span>
                                <small>
                                    <a href="mailto:riccardo.mandich.25@stud.itsaltoadriatico.it"
                                        class="text-info text-decoration-none">
                                        riccardo.mandich.25@stud.itsaltoadriatico.it
                                    </a>
                                </small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @yield('script')
</body>

</html>