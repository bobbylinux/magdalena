@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Nuovo Centro di Costo</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/cdc') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <input type="text" class="form-control" id="codice-cdc" name="codice-cdc" placeholder="Codice Centro di Costo">
                    </div>
                    @foreach($errors->get('codice') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <textarea class="form-control" id="descrizione-cdc" name="descrizione-cdc" rows="5" placeholder="Descrizione Centro di Costo"></textarea>
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