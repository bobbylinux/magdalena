@extends('templates.reports')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>VOTANTI GLOBALI {!! strtoupper($dataRif->t_des) !!}</h1>
            </div>
        </div>
        <div class="row div-dettagli">
            <div class="col-lg-8 col-lg-offset-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-1">Totale</th>
                        <th class="col-lg-1">Votanti</th>
                        <th class="col-lg-1">Astenuti</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{!! $votanti->totali !!}</td>
                            <td>{!! $votanti->votanti !!}</td>
                            <td>{!! $votanti->astenuti !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop