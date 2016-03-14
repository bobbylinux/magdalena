@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Modifica Sede</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/cdc/'.$cdc['c_cdc']) !!}" method="PUT">
                    <div class="form-group">
                        <input type="text" class="form-control" value ="{!! $cdc['c_cdc'] !!}" id="codice-sede" placeholder="Codice Centro di Costo">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="descrizione-sede" text ="" rows="5" placeholder="Descrizione Centro di Costo">{!! $cdc['t_sed'] !!}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop