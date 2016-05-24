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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-1">Codice</th>
                        <th class="col-lg-3">Cognome</th>
                        <th class="col-lg-3">Nome</th>
                        <th class="col-lg-4 text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($soci as $socio)
                        <tr>
                            <td>{!! $socio->c_soc !!}</td>
                            <td>{!! $socio->t_cgn !!}</td>
                            <td>{!! $socio->t_nom !!}</td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{!! url('/soci/' . $socio->c_soc . '/edit') !!}"><i class="fa fa-pencil"></i> Modifica</a>
                                <a class="btn btn-danger"><i class="fa fa-trash"></i> Cancella</a>
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