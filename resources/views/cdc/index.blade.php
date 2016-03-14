@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Lista dei Centri di Costo</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-1">Codice</th>
                        <th class="col-lg-7">Descrizione</th>
                        <th class="col-lg-4 text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cdc as $centroDiCosto)
                        <tr>
                            <td>{!! $centroDiCosto->c_cdc !!}</td>
                            <td>{!! $centroDiCosto->t_sed !!}</td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{!! url('/cdc/' . $centroDiCosto->c_cdc . '/edit') !!}"><i class="fa fa-pencil"></i> Modifica</a>
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
                {!! $cdc->links() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <a href="{!! url('/cdc/create') !!}" class="btn btn-success btn-block">Nuovo Centro di Costo</a>
            </div>
        </div>
    </div>
@stop