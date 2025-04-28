@extends('layouts.web')
@section('title', 'Blog')
@section('body')
    <section id="hero" class="dark-background">
        <div class="row pt-5 px-3">
            <div class="col-lg-4">
                <img src="{{ asset('assets/a.jpeg') }}" alt="" class="img-fluid" data-aos="fade-in">
            </div>
            <div class="col-lg-8 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                <div class="p-3">
                    <h2>BLOG</h2>
                    <h5>
                        Un blog pour les curieux, les rêveurs et les passionnés! Chaque article est une invitation à
                        explorer de nouveaux horizons, à échanger des idées et à nourrir votre soif de découvertes.
                        Le blog qui nourrit votre curiosité! Ouvrez votre esprit, explorez nos mots.
                    </h5>
                    <a href="#blog" class="btn-scroll" title="Scroll Down">
                        <i style="font-size: 48px;" class="bi bi-chevron-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="blog" class="services section">
        <div class="container">
            <div class="row gy-4" magdiv>
                @if ($blog)
                    <div class="w-100" magdiv>
                        <div class="d-flex justify-content-center">
                            <div class="p-3" style="box-shadow: 0px 5px 90px rgba(0, 0, 0, 0.1); border-radius: 20px;">
                                <div class="">
                                    <h1 class="mb-3">{{ $blog->titre }}</h1>
                                    <div class="my-3 p-3 text-dark"
                                        style="border-radius: 20px; background: rgba(0,0,0,.25)">
                                        <h5>{{ $blog->description }}</h5>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    {!! $blog->text !!}
                                </div>
                                <div class="mb-5">
                                    @if (candl($blog))
                                        @guest
                                            <button class="btn btn-light bg-gold btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#offline">
                                                <i class="bi bi-download"></i>
                                                Télécharger
                                            </button>
                                        @endguest
                                        @auth
                                            <button value="{{ $blog->id }}" dlmag class="btn btn-light bg-gold btn-sm"
                                                style="z-index: 1000">
                                                <i class="bi bi-download"></i>
                                                Télécharger
                                            </button>
                                        @endif
                                    @endauth
                                </div>
                                <div class="mb-3">
                                    <i>{{ $blog->categorieblog->categorie }}</b> <br>
                                        <b>Blog du : {{ $blog->date?->format('d-m-Y H:i:s') }}</b> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($blogs as $el)
                        <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item position-relative p-3">
                                <div class="icon">
                                    <img src="{{ asset('storage/' . $el->image) }}" class="img-fluid rounded-3"
                                        alt="">
                                </div>
                                <h4><span class="stretched-link">{{ $el->titre }}</span></h4>
                                <div class="h-100y">
                                    <p>{{ $el->description }}</p> <br><br>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>{{ $el->date?->format('d-m-Y H:i:s') }}</small>
                                    <span><i class="bi bi-eye"></i> {{ $el->view }}</span>
                                    @if (candl($el))
                                        @auth
                                            <button value="{{ $el->id }}" dlmag class="btn btn-light text-danger btn-sm"
                                                style="z-index: 1000">
                                                <i class="bi bi-download"></i>
                                            </button>
                                        @endauth
                                        @guest
                                            <button data-bs-toggle="modal" data-bs-target="#offline"
                                                class="btn btn-light text-danger btn-sm" style="z-index: 1000">
                                                <i class="bi bi-download"></i>
                                            </button>
                                        @endguest
                                    @endif
                                    <a href="{{ route('blog', ['v' => $el->id]) }}" style="z-index: 1000"
                                        class="btn btn-outline-light bg-gold btn-sm">
                                        <i class="bi bi-three-dots"></i> Suite
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-12 mt-4 d-flex justify-content-center">
                    <div class="">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @guest
        <div class="modal fade" id="offline" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <h3>Veuillez vous connecter</h3>
                            <img src="{{ asset('logo.png') }}" alt="" width="40px">
                        </div>
                        <hr>
                        <div class="mt-4 mb-2">
                            <h5>
                                Vous devez être connecté pour avoir accès au téléchargement des blogs
                            </h5>
                        </div>
                        <div class="w-100 d-flex justify-content-end">
                            <div class="">
                                <button type="button" class="btn btn-outline-light text-dark my-2" data-bs-dismiss="modal">
                                    Pas maintenant
                                </button>
                            </div>
                            <div class="">
                                <a href="{{ route('login', ['r' => url()->full()]) }}" class="btn bg-gold  my-2">
                                    Se connecter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest

@endsection
@section('js-code')
    <script>
        setTimeout(() => {
            $('html,body').animate({
                scrollTop: $('[magdiv]').offset().top - 100
            }, 600);
        }, 1000);

        $('[dlmag]').click(function() {
            event.preventDefault();
            var v = this.value;
            var btn = $(this);
            var i = btn.find('i');
            i.removeClass().addClass('spinner-border spinner-border-sm text-danger');
            btn.attr('disabled', true);
            location.href = "{{ route('blogdl', ['item' => '']) }}" + v;
            i.removeClass().addClass('bi bi-check-circle');
            setTimeout(() => {
                i.removeClass().addClass('bi bi-download');
                btn.attr('disabled', false);
            }, 3000);
        });
    </script>
@endsection
