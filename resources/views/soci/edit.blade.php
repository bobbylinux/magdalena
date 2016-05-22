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
                    @foreach($errors->get('codice') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <textarea class="form-control" id="descrizione-sede" text ="" rows="5" placeholder="Descrizione Sede">{!! $sede['t_sed'] !!}</textarea>
                    </div>
                    @foreach($errors->get('descrizione') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop