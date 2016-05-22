@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Lista delle date di riferimento per votazione</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-2">Id</th>
                        <th class="col-lg-2">Data Inizio</th>
                        <th class="col-lg-2">Data Fine</th>
                        <th class="col-lg-2">Descrizione</th>
                        <th class="col-lg-4 text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($dataRiferimento as $data)
                        <tr>
                            <td>{!! $data->c_rif !!}</td>
                            <td>{!! date('d-m-Y', strtotime($data->d_rif_ini)) !!}</td>
                            <td>{!! date('d-m-Y', strtotime($data->d_rif_fin)) !!}</td>
                            <td>{!! $data->t_des !!}</td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{!! url('/dateriferimento/' . $data->c_rif . '/edit') !!}"><i class="fa fa-pencil"></i> Modifica</a>
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
                {!! $dataRiferimento->render() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <a href="{!! url('/dateriferimento/create') !!}" class="btn btn-success btn-block">Nuova Data di Riferimento</a>
            </div>
        </div>
    </div>
@stop