<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="{{ asset('logo.png') }}" alt="">
            <b class= "text-gold">{{ config('app.name') }}</b>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="@if (Route::is('home')) active @endif scrollto">Accueil</a></li>
                <li><a href="#thebook" class="scrollto">Le Livre</a></li>
                <li><a href="#about" class="scrollto">A propos</a></li>
                <li>
                    <a href="{{ route('blog') }}"
                        class="active @if (Route::is('blog')) active @endif">Blog</a>
                </li>
                <li><a href="#contact" class="scrollto">Contact</a></li>
                @auth
                    @php
                        $user = auth()->user();
                    @endphp
                    <li class="dropdown">
                        <a href="#" onclick="event.preventDefault()">
                            <span style="margin-left: 5px">{{ $user->name }}</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li><a href="#" logout>Se deconnecter</a></li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                @endguest
                {{-- <li class="dropdown">
                    <a href="#"><span>Dropdown</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li> --}}
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <div class="header-social-links">
            <a href="https://www.facebook.com/share/1AQo2fdNXZ" target="_blank" class="facebook"><i
                    class="bi bi-facebook"></i></a>
            <a href="#" onclick="event.preventDefault()" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" onclick="event.preventDefault()" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" onclick="event.preventDefault()" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>

    </div>
</header>
