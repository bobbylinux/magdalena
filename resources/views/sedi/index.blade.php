@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Lista delle sedi</h1>
            </div>
        </div>
        <div class="row">
            {!! $sedi->links() !!}
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
                    @foreach($sedi as $sede)
                        <tr>
                            <td>{!! $sede->c_sed !!}</td>
                            <td>{!! $sede->t_sed !!}</td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{!! url('/sedi/' . $sede->c_sed . '/edit') !!}"><i class="fa fa-pencil"></i> Modifica</a>
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
                {!! $sedi->links() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <a href="{!! url('/sedi/create') !!}" class="btn btn-success btn-block">Nuova Sede</a>
            </div>
        </div>
    </div>
@stop