@extends('layouts.main')
@section('title', 'Commandes')
@section('body')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Commandes clients</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Commandes clients ({{ count($commandes) }})</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px"></th>
                                            <th>CLIENT</th>
                                            <th>LIVRE COMMANDE</th>
                                            <th>DATE COMMANDE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commandes as $k => $el)
                                            @php
                                                $dt = json_decode($el->data);
                                            @endphp
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $el->user->name }}</td>
                                                <td>
                                                    Ref: {{ $el->myref }} <br>
                                                    Montant: {{ v($dt->montant, $dt->devise) }} <br>
                                                    Livre : {{ $dt->book->titre }} <br>
                                                </td>
                                                <td>{{ $el->date?->format('d-m-Y H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
@endsection
@section('js-code')
    <x-plugins.datatablenatif />

    <script>
        $(function() {

        })
    </script>
@endsection
