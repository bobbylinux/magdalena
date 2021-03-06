@extends('templates.back')
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
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <a href="{!! url('/voti/votanti/stampa/'.$dataRif->c_rif) !!}" class="btn btn-success btn-block">Stampa</a>
            </div>
        </div>
    </div>
    <!-- modal wait-->
    <div class="modal fade" tabindex="-1" role="dialog" id="wait-msg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                             aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h4 class="text-center">Attendere Prego</h4>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop