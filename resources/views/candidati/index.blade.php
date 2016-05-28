@extends('templates.back')
@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 text-center">
            @if (isset($dataRif))
                <div class="row">
                    <div class="form-group">
                        {!! Form::select('cdc', array('0' => 'Seleziona una votazione attiva') + $dataRif,'' ,array('class'=>'form-control','id'=>'select-votazioni-attive')) !!}
                    </div>
                </div>
                <div class="row div-candidato-ricerca" style="display:none">
                    <div class="input-group">
                        <input type="text" class="form-control" id="ricerca-candidato"
                               placeholder="Ricerca socio..."
                               data-id="">
                                  <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="aggiungi-candidato"  data-token="{!! csrf_token() !!}"><span
                                                class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                  </span>
                    </div>
                </div>
            @else
                <h1>Non ci sono votazioni attive al momento</h1>
            @endif
        </div>
    </div>
    <div class="row" id="lista-candidati-container">
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