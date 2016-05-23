@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Statistiche Votazioni</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-1">Id</th>
                        <th class="col-lg-3">Descrizione</th>
                        <th class="col-lg-8 text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataRif as $data)
                        <tr>
                            <td>{!! $data->c_rif !!}</td>
                            <td>{!! $data->t_des !!}</td>
                            <td class="text-right">
                                <a class="btn btn-default" href="{!! url('/voti/votanti/' . $data->c_rif ) !!}"><i
                                            class="fa fa-pencil"></i> Votanti</a>
                                <a class="btn btn-success" href="{!! url('/voti/votanti/cdc/' . $data->c_rif ) !!}"><i
                                            class="fa fa-pencil"></i> Votanti Per CDC</a>
                                <a class="btn btn-info" href="{!! url('/voti/votanti/sede/' . $data->c_rif ) !!}"><i
                                            class="fa fa-pencil"></i> Votanti Per Sede</a>
                                <a class="btn btn-primary" href="{!! url('/voti/classifica/' . $data->c_rif ) !!}"><i
                                            class="fa fa-bars"></i> Classifica</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                {!! $dataRif->render() !!}
            </div>
        </div>
    </div>
@stop