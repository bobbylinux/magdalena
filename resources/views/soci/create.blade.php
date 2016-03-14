@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Nuova Sede</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/sedi') !!}" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="codice-sede" placeholder="Codice Sede">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="descrizione-sede" rows="5" placeholder="Descrizione Sede"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop