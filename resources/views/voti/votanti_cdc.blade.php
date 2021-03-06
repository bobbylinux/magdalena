@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>VOTANTI PER CENTRO DI COSTO {!! strtoupper($dataRif->t_des) !!}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/voti/votanti_cdc/search') !!}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" id="ricerca-cdc" name="ricerca-cdc" placeholder="Ricerca Centro di Costo...">
                        <input type="hidden" name="c_rif" value="{!! $dataRif->c_rif !!}" />
                        <span class="input-group-btn">
                        <button class="btn btn-success" type="submit" id="brn-ricerca-cdc"><span
                                    class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                      </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row div-dettagli">
            <div class="col-lg-8 col-lg-offset-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-1">Codice</th>
                        <th class="col-lg-8">Descrizione</th>
                        <th class="col-lg-1">Totale</th>
                        <th class="col-lg-1">Votanti</th>
                        <th class="col-lg-1">Astenuti</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($votanti as $row)
                        <tr>
                            <td>{!! $row->c_cdc !!}</td>
                            <td>{!! $row->t_sed !!}</td>
                            <td>{!! $row->totali !!}</td>
                            <td>{!! $row->votanti !!}</td>
                            <td>{!! $row->astenuti !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                {!! $votanti->render()  !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <a href="{!! url('/voti/votanti/cdc/stampa/pdf') !!}" class="btn btn-success btn-block">Stampa</a>
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