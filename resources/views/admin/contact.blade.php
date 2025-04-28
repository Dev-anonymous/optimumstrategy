@extends('layouts.main')
@section('title', 'Contact')
@section('body')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Contact & Feedback</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Contact & Feedback ({{ count($data) }})</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px"></th>
                                            <th>NOM</th>
                                            <th>EMAIL/TEL</th>
                                            <th>SUJET</th>
                                            <th>MESSAGE</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $k => $el)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $el->name }}</td>
                                                <td>{{ $el->email }}</td>
                                                <td>{{ $el->subject }}</td>
                                                <td>{{ $el->message }}</td>
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
