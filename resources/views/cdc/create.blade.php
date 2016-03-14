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
                    <div class="form-group">
                        <input type="text" class="form-control" id="c_cdc" name="c_cdc" placeholder="Codice Centro di Costo">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="t_sed" name="t_sed" rows="5" placeholder="Descrizione Centro di Costo"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop