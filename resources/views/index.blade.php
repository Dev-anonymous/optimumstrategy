<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    {{-- <link href="https://bootstrapmade.com/content/demo/Laura/assets/img/favicon.png" rel="icon">
    <link href="https://bootstrapmade.com/content/demo/Laura/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link href="https://fonts.gstatic.com/" rel="preconnect" crossorigin> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;family=Quicksand:wght@300;400;500;600;700&amp;family=Domine:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/bs5.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    {{-- <link href="https://bootstrapmade.com/content/vendors/aos/aos.css" rel="stylesheet"> --}}
    {{-- <link href="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://bootstrapmade.com/content/vendors/glightbox/css/glightbox.min.css" rel="stylesheet"> --}}

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <x-header />

    <main class="main">
        <section id="hero" class="dark-background">
            <div class="row pt-5 px-3">
                <div class="col-lg-4">
                    <img src="{{ asset('assets/a.jpeg') }}" alt="" class="img-fluid" data-aos="fade-in">
                </div>
                <div class="col-lg-8 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="">
                        <h2>Laura Thomson</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam nihil est cupiditate officiis
                            quidem saepe. Saepe nisi impedit doloribus fuga, architecto tenetur, sunt possimus qui
                            consequuntur, error ipsam quam dignissimos?
                        </p>
                        <button class="btn btn-block bg-gold">
                            <i class="bi bi-cart"></i> ACHETER MAINTENANT
                        </button> <br>
                        {{-- <a href="#thebook" class="btn-scroll" title="Scroll Down">
                            <i style="font-size: 48px; margin-left: 60px" class="bi bi-chevron-down"></i>
                        </a> --}}
                    </div>
                </div>
            </div>
        </section>
        <section id="thebook" class="about section">
            <div class="container" data-aos="fade-up">
                <h1 class="title">Titre</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste exercitationem incidunt fugit facilis
                    iusto? Asperiores atque placeat aut, possimus libero inventore laudantium! Nam harum autem voluptate
                    quod repellendus consequatur vitae. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Consequatur
                    explicabo, quaerat quasi soluta nam architecto aut ipsa porro magni, molestias pariatur, voluptates
                    ut
                    nihil nobis quos culpa odio natus et!</p>
            </div>
        </section>
        <section id="about" class="dark-background">
            <div class="row px-3">
                <div class="col-lg-4">
                    <img src="{{ asset('assets/a.jpeg') }}" alt="" class="rounded-circle" data-aos="fade-in">
                </div>
                <div class="col-lg-8 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="">
                        <h2 class="text-gold">APROPOS DE L"AUTEUR</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam nihil est cupiditate officiis
                            quidem saepe. Saepe nisi impedit doloribus fuga, architecto tenetur, sunt possimus qui
                            consequuntur, error ipsam quam dignissimos?</p>
                    </div>
                </div>
            </div>
        </section>


        <section id="services" class="services section">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">My Services</span>
                <h2>My Services</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-activity icon"></i></div>
                            <h4><a href="#" class="stretched-link">Lorem Ipsum</a></h4>
                            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="#" class="stretched-link">Sed ut perspici</a></h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                            <h4><a href="#" class="stretched-link">Magni Dolores</a></h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                            <h4><a href="#" class="stretched-link">Nemo Enim</a></h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <section id="contact" class="contact section">
            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Contact</span>
                <h2>Contact</h2>
                <p>Besoin de plus de plus d'infos? laissez nous un message.</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Addresse</h3>
                            <p>Lubumbashi, DRC</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div
                            class="info-item d-flex flex-column justify-content-center align-items-center info-item-borders">
                            <i class="bi bi-telephone"></i>
                            <h3>Tel</h3>
                            <p><a href="tel:+243811323425">+243 81 13 23 425</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>
                                <a href="mailto:contact@site.com">contact@site.com</a>
                            </p>
                        </div>
                    </div>

                </div>

                <form action="https://bootstrapmade.com/content/demo/Laura/forms/contact.php" method="post"
                    class="php-email-form" data-aos="fade-up" data-aos-delay="300">
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name"
                                required="">
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Your Email"
                                required="">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                required="">
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>

                            <button type="submit">Send Message</button>
                        </div>

                    </div>
                </form><!-- End Contact Form -->

            </div>

        </section>

    </main>

    <x-footer />

    <!-- Vendor JS Files -->
    {{-- <script data-cfasync="false"
        src="https://bootstrapmade.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/php-email-form/validate.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/aos/aos.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/glightbox/js/glightbox.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/isotope-layout/isotope.pkgd.min.js"></script> --}}

    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
