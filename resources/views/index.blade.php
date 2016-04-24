@extends('templates.front')
@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            @if (isset($dataRif))
                <h1>Votazione {!! date("d/m/Y", strtotime($dataRif->d_rif_ini)) !!}</h1>
                <div class="input-group">
                      <input type="text" class="form-control" id="ricerca-socio" placeholder="Ricerca candidato...">
                      <span class="input-group-btn">
                        <button class="btn btn-success" type="button" id="aggiungi-socio"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                      </span>
                </div><!-- /input-group -->
            @else
                <h1>Non ci sono votazioni attive al momento</h1>
            @endif
        </div>
    </div>
@stop