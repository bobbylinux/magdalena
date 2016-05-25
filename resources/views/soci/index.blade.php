@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Lista dei Soci</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/soci/search') !!}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" id="ricerca-socio" name="ricerca-socio" placeholder="Ricerca Socio...">
                        <span class="input-group-btn">
                        <button class="btn btn-success" type="submit" id="btn-ricerca-socio"><span
                                    class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                      </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-2">Codice Badge</th>
                        <th class="col-lg-3">Cognome</th>
                        <th class="col-lg-3">Nome</th>
                        <th class="col-lg-4 text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($soci as $socio)
                        <tr>
                            <td>{!! $socio->c_bdg !!}</td>
                            <td>{!! $socio->t_cgn !!}</td>
                            <td>{!! $socio->t_nom !!}</td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{!! url('/soci/' . $socio->c_soc . '/edit') !!}"><i
                                            class="fa fa-pencil"></i> Modifica</a>
                                <a class="btn btn-danger btn-cancella" data-id="{!! $socio->c_soc !!}" data-anagrafica="soci"><i class="fa fa-trash"></i> Cancella</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                {!! $soci->render()  !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <a href="{!! url('/soci/create') !!}" class="btn btn-success btn-block">Nuovo Socio</a>
            </div>
        </div>
    </div>
@stop