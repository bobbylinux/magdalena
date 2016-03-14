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
                <form class="form" action="{!! url('/sedi/'.$sede['c_sed']) !!}" method="PUT">
                    <div class="form-group">
                        <input type="text" class="form-control" value ="{!! $sede['c_sed'] !!}" id="codice-sede" placeholder="Codice Sede">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="descrizione-sede" text ="" rows="5" placeholder="Descrizione Sede">{!! $sede['t_sed'] !!}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop