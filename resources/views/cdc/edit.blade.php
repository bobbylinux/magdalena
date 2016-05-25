@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Modifica Centro di Costo</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/cdc/'.$cdc['c_cdc']) !!}" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group" style="display: none">
                        <input type="text" class="form-control" value ="{!! $cdc['c_cdc'] !!}" id="codice-cdc" name="codice-cdc" placeholder="Codice Centro di Costo">
                    </div>
                    @foreach($errors->get('codice') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <textarea class="form-control" id="descrizione-cdc" text ="" rows="5" name="descrizione-cdc" placeholder="Descrizione Centro di Costo">{!! $cdc['t_sed'] !!}</textarea>
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