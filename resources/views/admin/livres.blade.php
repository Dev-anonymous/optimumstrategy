@extends('layouts.main')
@section('title', 'Livres')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Livres</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Livres (<span nb></span>)</h4>
                                <div class="">
                                    <button class="mb-2 btn btn-default" data-toggle="modal" data-target="#addmdl">
                                        <i class="fa fa-plus-circle"></i> Nouveau livre</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px!important"><span loader><i
                                                        class="fa fa-spinner fa-spin"></i></span></th>
                                            <th></th>
                                            <th>LIVRE</th>
                                            <th>PRIX</th>
                                            <th>REDUCTION SUR PREMIERE CMD</th>
                                            <th>DETAILS</th>
                                            <th style="width: 10px!important"></th>
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

    <div class="modal fade" id="addmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau livre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fadd">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Titre du livre</label>
                            <input type="text" class="form-control" name="titre" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Prix du livre</label>
                                    <input type="number" min="1" class="form-control" name="prix" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Devise</label>
                                    <select name="devise" id="" class="form-control">
                                        <option value="CDF">CDF</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Réduction sur première commande (%)</label>
                            <input type="number" min="0" value="0" max="90" class="form-control"
                                name="reduction" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Auteur du livre</label>
                            <input type="text" class="form-control" name="auteur" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">A propos de l'auteur</label>
                            <textarea name="aproposauteur" id="" cols="30" rows="3"
                                class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Année d'édition du livre</label>
                            <input type="number" class="form-control" name="annee" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Petite desctiption du livre</label>
                            <textarea name="description" id="" cols="30" rows="3" maxlength="255" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Grande desctiption du livre</label>
                            <textarea name="longuedescription" id="" cols="30" rows="3"
                                class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Image Affiche du livre (.png)</label>
                            <input type="file" accept=".png" name="affiche" class="form-control" required id="">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Fichier PDF</label>
                            <input type="file" name="fichier" class="form-control" required id="">
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                            <i class="fa fa-times-circle"></i> Fermer
                        </button>
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-check-circle"></i> <span></span>
                            Valider
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="delmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fdel">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>Confirmer la suppression du livre ?</p>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                            <i class="fa fa-times-circle"></i> NON
                        </button>
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-trash"></i> <span></span>
                            SUPPRIMER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fedit">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Titre du livre</label>
                            <input type="text" class="form-control" name="titre" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Prix du livre</label>
                                    <input type="number" min="1" class="form-control" name="prix" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Devise</label>
                                    <select name="devise" id="" class="form-control">
                                        <option value="CDF">CDF</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Réduction sur première commande (%)</label>
                            <input type="number" min="0" value="0" max="90" class="form-control"
                                name="reduction" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Auteur du livre</label>
                            <input type="text" class="form-control" name="auteur" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">A propos de l'auteur</label>
                            <textarea name="aproposauteur" id="" cols="30" rows="3"
                                class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Année d'édition du livre</label>
                            <input type="number" class="form-control" name="annee" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Petite desctiption du livre</label>
                            <textarea name="description" id="" cols="30" rows="3" maxlength="255" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Grande desctiption du livre</label>
                            <textarea name="longuedescription" id="" cols="30" rows="3"
                                class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Image Affiche du livre (.png) (optionnel)</label>
                            <input type="file" accept=".png" name="affiche" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Fichier PDF (optionnel)</label>
                            <input type="file" name="fichier" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                            <i class="fa fa-times-circle"></i> Fermer
                        </button>
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-edit"></i> <span></span>
                            Valider
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@section('js-code')
    <x-plugins.datatablenatif />

    <script>
        $(function() {
            $('#fadd').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = new FormData(form[0]);
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'post',
                    data: data,
                    contentType: false,
                    processData: false,
                    url: '{{ route('livre.store') }}',
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
                            setTimeout(() => {
                                $('.modal').modal('hide');
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

            $('#fdel').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = form.serialize();
                var id = $('[name=id]', form).val();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'delete',
                    data: data,
                    url: '{{ route('livre.destroy', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
                            setTimeout(() => {
                                $('.modal').modal('hide');
                            }, 10000);
                        } else {
                            rep.removeClass().addClass('alert alert-danger');
                        }
                        rep.html(data.message).slideDown();
                    },
                    error: function(data) {
                        console.log(rep);
                        rep.removeClass().addClass('alert alert-danger').html(
                            "Erreur, veuillez réessayer.").slideDown();
                    }
                }).always(function() {
                    btn.find('span').removeClass();
                    $(':input', form).attr('disabled', false);
                })
            });

            $('#fedit').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = new FormData(form[0]);
                var id = $('[name=id]', form).val();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'post',
                    data: data,
                    contentType: false,
                    processData: false,
                    url: '{{ route('livre.update', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
                            setTimeout(() => {
                                $('.modal').modal('hide');
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

            var table = $('[table]');

            function getdata() {
                $("[loader]").html('<i class="fa fa-spinner fa-spin"></i>');
                $.getJSON('{{ route('livre.index') }}', function(data) {
                    var str = '';
                    $.each(data, function(i, e) {
                        str += `
                        <tr>
                            <td>${i+1}</td>
                            <td><img src="{{ asset('storage') }}/${e.affiche}" class="img-thumbnail"></td>
                            <td>${e.titre}</td>
                            <td class='text-nowrap'>${e.prixv}</td>
                            <td class='text-nowrap'>${e.reduction}%</td>
                            <td class='text-nowrap'>Auteur: ${e.auteur}<br>Année Edition: ${e.annee}</td>
                            <td>
                                <div class='d-flex'>
                                    <button user="${escape(e.name)}" value='${e.id}' class='bdel btn btn-outline-danger btn-sm m-1'><i class='fa fa-trash'></i></button>
                                    <button user="${escape( JSON.stringify(e) )}" class='bedit btn btn-default btn-sm m-1'><i class='fa fa-edit'></i></button>
                                </div>
                            </td>
                        </tr>
                        `;
                    });
                    $('[nb]').html(data.length);
                    table.DataTable().destroy();
                    table.find('tbody').html(str);
                    $('.bdel').off('click').click(function() {
                        var id = this.value;
                        var mdl = $('#delmdl');
                        $('[name=id]', mdl).val(id);
                        mdl.modal('show');
                    })
                    $('.bedit').off('click').click(function() {
                        var d = $(this).attr('user');
                        var cmpt = JSON.parse(unescape(d));
                        var mdl = $('#editmdl');
                        $('[name=id]', mdl).val(cmpt.id);
                        $('[name=titre]', mdl).val(cmpt.titre);
                        $('[name=prix]', mdl).val(cmpt.prix);
                        $('[name=reduction]', mdl).val(cmpt.reduction);
                        $('[name=devise]', mdl).val(cmpt.devise);
                        $('[name=auteur]', mdl).val(cmpt.auteur);
                        $('[name=aproposauteur]', mdl).val(cmpt.aproposauteur);
                        $('[name=annee]', mdl).val(cmpt.annee);
                        $('[name=description]', mdl).val(cmpt.description);
                        $('[name=longuedescription]', mdl).val(cmpt.longuedescription);
                        mdl.modal('show');
                    });

                    table.DataTable({
                        stateSave: true
                    });
                }).always(function() {
                    $("[loader]").html('');
                });
            }
            getdata();
        })
    </script>
@endsection
