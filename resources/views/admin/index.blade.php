@extends('layouts.main')
@section('title', 'Dashboard')
@section('body')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('admin.commande') }}">
                        <div class="card carte0">
                            <div class="card-body">
                                <h3 class="card-title ">Commandes</h3>
                                <div class="d-inline-block">
                                    <h2 class="" cmd></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-bag"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('admin.client') }}">
                        <div class="card carte0">
                            <div class="card-body">
                                <h3 class="card-title ">Clients</h3>
                                <div class="d-inline-block">
                                    <h2 class="" clients></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('admin.blog') }}">
                        <div class="card carte0">
                            <div class="card-body">
                                <h3 class="card-title ">Blog</h3>
                                <div class="d-inline-block">
                                    <h2 class="" blog></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-book"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('admin.contact') }}">
                        <div class="card carte0">
                            <div class="card-body">
                                <h3 class="card-title ">Contacts</h3>
                                <div class="d-inline-block">
                                    <h2 class="" contact></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rss"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-1">Statistiques des commandes</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div id="chart0"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-1">Statistique de nouveaux clients</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-code')
    <style>
        .carte0 {
            border-top: 2px solid var(--appcolor);
        }

        .carte0:hover {
            border: 2px solid #ccc;
        }
    </style>
    <script src="{{ asset('dash/js/apexchart.js') }}"></script>
    <script>
        $(function() {
            var options0 = {
                series: [{
                    name: "Commandes",
                    data: [],
                }],
                colors: ['#E6BE8A'],
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                labels: [
                    'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre',
                    'Octobre', 'Novembre',
                    'Decembre'
                ],

                legend: {
                    horizontalAlign: 'left'
                }
            };

            var chart0 = new ApexCharts(document.querySelector("#chart0"), options0);
            chart0.render();

            var options1 = {
                series: [{
                    name: "Nouveaux clients",
                    data: [],
                }],
                colors: ['#E6BE8A'],
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                labels: [
                    'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre',
                    'Octobre', 'Novembre',
                    'Decembre'
                ],

                legend: {
                    horizontalAlign: 'left'
                }
            };

            var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
            chart1.render();


            $('#seldoc').change(function() {
                stat(false);
            })

            function stat(interval = true) {
                var data = new FormData($('#fdoc')[0]);
                $.ajax({
                    url: ' {{ route('stat') }}',
                    type: 'POST',
                    data: data,
                    crossDomain: true,
                    contentType: false,
                    processData: false,
                    success: function(r) {
                        $('[contact]').html(r.contact);
                        $('[clients]').html(r.clients);
                        $('[cmd]').html(r.cmd);
                        $('[blog]').html(r.blog);

                        chart0.updateSeries([{
                            data: r.commandes,
                        }]);
                        chart1.updateSeries([{
                            data: r.nouveauxclients,
                        }]);

                    },
                    error: function(e, b, c) {
                        console.log(e, b, c);
                    }
                }).always(function() {
                    if (!interval) {
                        return;
                    }
                    setTimeout(() => {
                        stat();
                    }, 3000);
                })
            }

            stat();
        })
    </script>
@endsection
