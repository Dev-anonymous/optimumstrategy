<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#E6BE8A">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Connexion | {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link href="{{ asset('dash/css/style.css') }}" rel="stylesheet">
    <style>
        .card {
            transition: all .5s ease;
        }

        .card:hover {
            box-shadow: 6px 5px 21px -18px var(--appcolor);
            transform: scale(1.01);
        }
    </style>
</head>

<body class="h-100" style="background: rgba(0,0,0,0.35)">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0"
                            style="background: rgba(255,255,255,0.8); border-radius: 30px">
                            <div class="card-body pt-5">
                                <a class="text-center" href="{{ route('login') }}">
                                    <h4>
                                        <img src="{{ asset('logo.png') }}" alt="" height="70px">
                                    </h4>
                                </a>
                                <div id="dlog">
                                    <form class="mt-5 login-input" id="log">
                                        <h3 class="text-center">Connexion</h3>
                                        @csrf
                                        <div class="form-group">
                                            <input required class="form-control" name="login" id="login"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input required id="pass" type="password" class="form-control"
                                                name="password" placeholder="Mot de passe">
                                        </div>
                                        <div class="form-check form-check-inline mb-3">
                                            <input name="remember" class="form-check-input" type="checkbox"
                                                id="inlineCheckbox1">
                                            <label class="form-check-label" for="inlineCheckbox1">Se souvenir de
                                                moi</label>
                                        </div>
                                        <div class="w-100" id="rep"></div>
                                        <button class="btn btn-block" style="background: var(--appcolor);">
                                            <span></span>
                                            Connexion
                                        </button>
                                        <button type="button" bcmpt class="btn btn-link mt-2 text-success">
                                            <i class="fa fa-user-plus"></i>
                                            Je m'inscris
                                        </button>
                                    </form>
                                </div>
                                <div id="dcmpt" style="display: none">
                                    <form class="mt-5 login-input" id="cmpt">
                                        <h3 class="text-center">Inscription</h3>
                                        @csrf
                                        <div class="form-group">
                                            <input required class="form-control" name="name"
                                                placeholder="Votre nom complet">
                                        </div>
                                        <div class="form-group">
                                            <input required class="form-control" name="email"
                                                placeholder="Votre email">
                                        </div>
                                        <div class="form-group">
                                            <input required class="form-control phone" placeholder="Votre numero">
                                        </div>
                                        <div class="form-group">
                                            <input required type="password" class="form-control" name="password"
                                                placeholder="Mot de passe">
                                        </div>
                                        <div class="w-100" id="rep"></div>
                                        <button class="btn btn-block" style="background: var(--appcolor);">
                                            <span></span>
                                            Inscription
                                        </button>
                                        <button type="button" blog class="btn btn-link mt-2 text-success">
                                            <i class="fa fa-lock"></i>
                                            Connexion
                                        </button>
                                    </form>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('home') }}" class="btn text-danger">
                                        <i class="fa fa-home"></i>
                                        Accueil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dash/js/common.min.js') }}"></script>
    <script src="{{ asset('dash/js/custom.min.js') }}"></script>

    <script src="{{ asset('dash/plugins/intl/js.js') }}"></script>
    <script src="{{ asset('dash/plugins/intl/imask.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dash/plugins/intl/css.css') }}">
    <style>
        .iti.iti--show-flags.iti--inline-dropdown {
            width: 100% !important
        }
    </style>

    <script>
        window.intlTelInput($('.phone')[0], {
            separateDialCode: true,
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "CD";
                    callback(countryCode);
                });
            },
        });

        $('.phone').each(function(i, e) {
            IMask(e, {
                mask: '00000000000'
            });
        });

        $('[bcmpt]').click(function() {
            event.preventDefault();
            $('#dlog').stop().hide();
            $('#dcmpt').stop().show();
        });
        $('[blog]').click(function() {
            event.preventDefault();
            $('#dcmpt').stop().hide();
            $('#dlog').stop().show();
        })

        $('#log').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form);
            btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
            var data = form.serialize();
            $(':input', form).attr('disabled', true);
            var rep = $('#rep', form);
            rep.stop().slideUp();
            $.ajax({
                type: 'post',
                data: data,
                url: '{{ route('web.login') }}',
                success: function(data) {
                    if (data.success) {
                        form[0].reset();
                        localStorage.setItem('token', data.data.token);
                        rep.removeClass().addClass('alert alert-success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        rep.removeClass().addClass('alert alert-danger');
                    }
                    rep.html(data.message).slideDown();
                },
                error: function(data) {
                    rep.removeClass().addClass('alert alert-danger').html(
                        "Erreur, veuillez réessayer.").slideDown();
                }
            }).always(function() {
                btn.find('span').removeClass();
                $(':input', form).attr('disabled', false);
            })


        });

        $('#cmpt').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form);
            btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
            var data = form.serialize();
            var d = $('.iti__selected-dial-code').html().trim();
            var p = $('.phone').val();
            var phone = '' + d + p;
            data += '&phone=' + phone;

            $(':input', form).attr('disabled', true);
            var rep = $('#rep', form);
            rep.stop().slideUp();


            $.ajax({
                type: 'post',
                data: data,
                url: '{{ route('web.signup') }}',
                success: function(data) {
                    if (data.success) {
                        form[0].reset();
                        localStorage.setItem('token', data.data.token);
                        rep.removeClass().addClass('alert alert-success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        rep.removeClass().addClass('alert alert-danger');
                    }
                    rep.html(data.message).slideDown();
                },
                error: function(data) {
                    rep.removeClass().addClass('alert alert-danger').html(
                        "Erreur, veuillez réessayer.").slideDown();
                }
            }).always(function() {
                btn.find('span').removeClass();
                $(':input', form).attr('disabled', false);
            });

        })
    </script>
</body>

</html>
