@extends('layouts.web')

@section('title', 'Bienvenue')
@section('body')
    <section id="hero" class="dark-background">
        <div class="row pt-5 px-3">
            <div class="col-lg-4 d-flex justify-content-lg-end justify-content-center" data-aos="fade-right"
                data-aos-delay="100">
                <img src="{{ asset('storage/' . @$livre->affiche) }}" alt="" class="img-fluid" data-aos="fade-in">
            </div>
            <div class="col-lg-8 d-flex align-items-center" data-aos="fade-left" data-aos-delay="100">
                <div class="">
                    <h2>{{ @$livre->titre }}</h2>
                    <i class="text-gold">{{ @$livre->annee . ' | ' . @$livre->auteur }}</i>
                    <p>
                        {{ @$livre->description }}
                    </p>
                    @auth
                        <button class="btn btn-block bg-gold bpay" red="{{ (float) @$livre->reduction }}"
                            value="{{ @$livre->id }}" prixv='{{ v((float) @$livre->prix, @$livre->devise) }}'
                            prixred='{{ v(reduction($livre), @$livre->devise) }}' devise='{{ @$livre->devise }}'>
                            <i class="bi bi-cart"></i> ACHETER MAINTENANT
                        </button>
                    @endauth
                    @guest
                        <button class="btn btn-block bg-gold" value="{{ @$livre->id }}" data-bs-toggle="modal"
                            data-bs-target="#offline">
                            <i class="bi bi-cart"></i> ACHETER MAINTENANT
                        </button>
                    @endguest
                    {{-- <a href="#thebook" class="btn-scroll" title="Scroll Down">
                    <i style="font-size: 48px; margin-left: 60px" class="bi bi-chevron-down"></i>
                </a> --}}
                </div>
            </div>
        </div>
    </section>
    <section id="thebook" class="about section">
        <div class="container" data-aos="fade-up">
            <h1 class="title">{{ @$livre->titre }}</h1>
            <p>{{ @$livre->longuedescription }}</p>
        </div>
    </section>
    <section id="about" class="dark-background">
        <div class="row px-3">
            <div class="col-lg-4 d-flex justify-content-lg-end justify-content-center" data-aos="fade-down"
                data-aos-delay="100">
                <img src="{{ asset('assets/auteur.png') }}" alt="" style="width: 200px; height: 200px;"
                    class=" rounded-circle" data-aos="fade-in">
            </div>
            <div class="col-lg-8 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                <div class="mt-2">
                    <h2 class="text-gold">APROPOS DE L'AUTEUR</h2>
                    <p>{{ @$livre->aproposauteur }}</p>
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
                    <div class="info-item d-flex flex-column justify-content-center align-items-center info-item-borders">
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
            <form data-aos="fade-up" data-aos-delay="300" action="#" id="fcontact">
                <div class="row gy-4 mt-3">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Nom" required="">
                    </div>
                    <div class="col-md-6 ">
                        <input type="email" class="form-control" name="email" placeholder="Email" required="">
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="p-2" id="rep"></div>
                        <button type="submit" class="btn btn-block bg-gold"><span></span> Envoyer</button>
                    </div>
                </div>
            </form>
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
                                Vous devez être connecté pour effectuer cette action !
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
    @auth
        <div class="modal fade" id="submdl" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-body">
                        <div class="p-3">
                            <div class="d-flex justify-content-between">
                                <h4>ACHAT LIVRE</h4>
                                <i class="fa fa-lock text-success fa-2x"></i>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <div class="text-center">
                                    <b class="mr-2">Nous acceptons les paiements par </b>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg" src="{{ asset('payment-method/airtel.png') }}"
                                            width="100px" height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg" src="{{ asset('payment-method/vodacom.png') }}"
                                            width="100px" height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg" src="{{ asset('payment-method/orange.png') }}"
                                            width="100px" height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('payment-method/afrimoney.png') }}" width="100px" height="50px"
                                            alt="" />
                                    </a>
                                </div>
                            </div>
                            <form action="#" id="f-pay2">
                                <input type="hidden" name="book_id">
                                <div class="form-group">
                                    <label for="">Télephone Mobile Money</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">+243</span>
                                        </div>
                                        @php
                                            $tel = '';
                                        @endphp
                                        @auth
                                            @php
                                                $phone = auth()->user()->phone;
                                                $tel = substr($phone, -9);
                                            @endphp
                                        @endauth
                                        <input type="text" required pattern="[0-9.]+" class="form-control"
                                            value="{{ $tel }}" placeholder="Votre numéro Tel." name="telephone"
                                            maxlength="9">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5 hprix></h5>
                                    <b redtext class="text-success"></b>
                                </div>
                                <div class="form-group mb-2 mt-3">
                                    <label for="">Je souhaite payer en</label>
                                    <select name="devise" id="" class="form-control">
                                        <option>CDF</option>
                                        <option>USD</option>
                                    </select>
                                </div>
                                <div class="mt-3 mb-3">
                                    <div id="rep"></div>
                                </div>
                                <button class="btn btn-block w-100 bg-gold" type="submit">
                                    <i></i>
                                    <b>
                                        PAYER <span montant></span>
                                    </b>
                                </button>

                                <button type="button" class="btn btn-light my-2" id="btncancel"
                                    style="display: none">Annuler
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light text-dark my-2" data-bs-dismiss="modal">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
@section('js-code')
    <script>
        $(function() {

            var sel = $('select[name=devise]');
            sel.change(function() {
                mt();
            });

            $('.bpay').click(function() {
                var form = $('#f-pay2');
                var id = this.value;
                var dev = $(this).attr('devise');
                var prix = $(this).attr('prix');
                var prixv = $(this).attr('prixv');
                var prixred = $(this).attr('prixred');
                var red = Number($(this).attr('red'));
                if (red && prixv != prixred) {
                    var hprix =
                        `PRIX DU LIVRE : <del class="text-danger font-weight-bold">${prixv}</del> <b montant class='ml-2'>${prixred}</b>`;
                    $('[redtext]').html(`Bénéficiez jusqu'à ${red}% pour votre première commande.`);
                } else {
                    var hprix =
                        `PRIX DU LIVRE : <b montant class="text-danger font-weight-bold">${prixv}</b>`;
                    $('[redtext]').html('');
                }
                $('[name=book_id]', form).val(id);
                $('[name=devise]', form).val(dev);
                $('span[montant]', form).html(prixred);
                $('[hprix]', form).html(hprix);
                $('#submdl').modal('show');
            });

            function mt() {
                var dev = sel.val();
                var form = $('#f-pay2');
                var book_id = $('[name=book_id]', form).val();
                $(':input', form).attr('disabled', true);
                var btn = $(':submit', form);
                btn.find('i').removeClass().addClass('spinner-border spinner-border-sm');

                $.ajax({
                    data: {
                        devise: dev,
                        book_id: book_id,
                    },
                    url: '{{ route('subscribeval') }}',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Accept', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem(
                            'token'));
                    },
                    success: function(data) {
                        var v = data.val;
                        $('[montant]').html(v);
                        $(':input', form).attr('disabled', false);
                        btn.find('i').removeClass();
                    },
                    error: function(data) {
                        setTimeout(() => {
                            mt();
                        }, 1000);
                    }
                })
            }


            CANSHOW = true;
            var xhr = [];
            var interv = null;

            var callback = function() {
                var x =
                    $.ajax({
                        url: '{{ route('api.check.pay') }}',
                        data: {
                            myref: REF,
                        },
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('Accept', 'application/json');
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                            xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem(
                                'token'));
                        },
                        success: function(res) {
                            var trans = res.transaction;
                            var status = trans?.status;
                            if (status === 'success') {
                                $('#btncancel').hide();
                                clearInterval(interv);
                                var form = $('#f-pay2');
                                var btn = $(':submit', form).attr('disabled', false);
                                btn.html('<i></i><b>PAYER <span montant></span></b>');
                                rep = $('#rep', form);
                                rep.html(
                                    `<b>TRANSACTION EFFECTUEE !</b><p>Merci d'avoir effectuer le paiement! veuillez consulter votre boite e-mail pour télécharger le livre.</p>`
                                ).removeClass();
                                rep.addClass('alert alert-success');
                                rep.slideDown();

                            } else if (status === 'failed') {
                                clearInterval(interv);
                                $('#btncancel').hide();
                                var form = $('#f-pay2');
                                var btn = $(':submit', form).attr('disabled', false);
                                btn.html('<i></i><b>PAYER <span montant></span></b>');
                                var rep = $('#rep', form);
                                rep.html(
                                    `<b>TRANSACTION ECHOUEE !</b><p>Vous avez peut-être saisi un mauvais Pin. Merci de réessayer.</p>`
                                ).removeClass();
                                rep.addClass('alert alert-danger');
                                $(xhr).each(function(i, e) {
                                    e.abort();
                                });
                            }
                        }
                    });
                xhr.push(x);
            }
            $('#btncancel').click(function() {
                clearInterval(interv);
                $(this).hide();
                var form = $('#f-pay2');
                var btn = $(':submit', form).attr('disabled', false);
                btn.html('<i></i><b>PAYER <span montant></span></b>');
                var rep = $('#rep', form);
                rep.html("Paiement annulé.").removeClass();
                rep.addClass('alert alert-danger');
                $(xhr).each(function(i, e) {
                    e.abort();
                });
            });

            $('#f-pay2').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                var rep = $('#rep', form);
                rep.html('').removeClass();
                var data = form.serialize();
                data = data.split('telephone=').join('telephone=+243');

                btn.attr('disabled', true).find('i').removeClass().addClass(
                    'spinner-border spinner-border-sm');
                $.ajax({
                    url: '{{ route('api.init.pay') }}',
                    type: 'post',
                    data: data,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Accept', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem(
                            'token'));
                    },
                    success: function(res) {
                        if (res.success) {
                            rep.html(res.message).removeClass();
                            rep.addClass('alert alert-success');
                            btn.html(
                                '<i class="spinner-border spinner-border-sm"></i> Confirmez votre Pin au téléphone...'
                            );
                            btn.attr('disabled', true);
                            clearInterval(interv);
                            REF = res.data.myref;
                            interv = setInterval(callback, 3000);
                            $('#btncancel').show();
                        } else {
                            rep.removeClass().addClass('text-danger').html(res.message);
                            btn.attr('disabled', false).find('i').removeClass();
                        }
                    },
                    error: function(res) {
                        var j = res.responseJSON;
                        if (j) {
                            j = j.message;
                        }
                        rep.removeClass().addClass('text-danger').html(j ??
                            'Erreur, veuillez reessayer');
                        btn.attr('disabled', false).find('i').removeClass();
                    }
                });
            });
        })
    </script>
@endsection
