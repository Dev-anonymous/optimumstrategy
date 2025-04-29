<!DOCTYPE html>
<html lang="fr">

<head>
    {{-- <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <script>
        eruda.init();
    </script> --}}
    <meta name="theme-color" content="#E6BE8A">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }} </title>
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('files.css')
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="nav-header" style="background-color: #fff">
            <div class="brand-logo">
                <a href="{{ route('login') }}">
                    <span class="brand-title d-flex justify-content-center">
                        <img src="{{ asset('logo.png') }}" height="40" alt="">
                    </span>
                </a>
            </div>
        </div>
        <x-nav />
        <x-sidebar />

        @yield('body')

        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; {{ date('Y') }}, {{ config('app.name') }}</p>
            </div>
        </div>
    </div>

    @include('files.js')
    @yield('js-code')
</body>

</html>
