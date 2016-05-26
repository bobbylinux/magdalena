@extends('templates.back')
@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 text-center">
            @if (isset($dataRif))
                <h1>{!! $dataRif['t_des'] !!}</h1>
                <div class="input-group">
                    <input type="text" class="form-control" id="ricerca-socio" placeholder="Ricerca candidato..."
                           data-id="">
                      <span class="input-group-btn">
                        <button class="btn btn-success" type="button" id="aggiungi-socio"><span
                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                      </span>
                </div><!-- /input-group -->
            @else
                <h1>Non ci sono votazioni attive al momento</h1>
            @endif
        </div>
    </div>
    <div class="row" id="voti-container">
    </div>
    <div class="row" id="conferma-container">
        <div class="col-xs-8 col-xs-offset-2 text-center">
            <button class="btn btn-success btn-block" id="conferma-voto" type="submit">Conferma</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 text-center">
            <h1>Lista dei candidati</h1>
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!--modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="conferma-messaggio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Attenzione</h4>
                </div>
                <div class="modal-body">
                    <p>Una volta confermata l'operazione non sarà più possibile effettuare una votazione!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-success" id="conferma-voto-definitivo"
                            data-token="{!! csrf_token() !!}">Conferma
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- modal error-->
    <div class="modal fade" tabindex="-1" role="dialog" id="errore-messaggio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Errore</h4>
                </div>
                <div class="modal-body errore-testo">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
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