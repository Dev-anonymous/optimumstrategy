@extends('layouts.main')
@section('title', 'Clients')
@section('body')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Clients</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Clients (<span clients></span>)</h4>
                            </div>
                            <div class="table-responsive">
                                <table tclient class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">
                                                <span loader>
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                </span>
                                            </th>
                                            <th>NOM</th>
                                            <th>TEL/EMAIL</th>
                                            <th>DERNIERE CONNEXION</th>
                                            <th>DATE CREATION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js-code')
    <x-plugins.datatablenatif />

    <script>
        $(function() {
            function getdata() {
                $("[loader]").html('<i class="fa fa-spinner fa-spin"></i>');
                $.getJSON('{{ route('clients.index') }}', function(d) {
                    var str = '';
                    var data = d.data;
                    $.each(data, function(i, e) {
                        str += `
                        <tr style="cursor:pointer;">
                            <td>${i+1}</td>
                            <td>
                                ${e.name}
                            </td>
                            <td>
                                ${e.phone} <br> ${e.email}
                            </td>
                            <td>
                                 ${e.derniere_connexion??''}
                            </td>
                            <td>
                                 ${e.datecreation}
                            </td>
                        </tr>
                        `;
                    });
                    var table = $('[tclient]');
                    $('[clients]').html(data.length);
                    table.DataTable().destroy();
                    table.find('tbody').html(str);
                    table.DataTable({
                        stateSave: true
                    });
                }).always(function() {
                    $("[loader]").html('');
                })
            }
            getdata();
        })
    </script>
@endsection
