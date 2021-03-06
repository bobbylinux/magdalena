@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Nuova Data di Riferimento Votazione</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/dateriferimento') !!}" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="data-inizio" name="data-inizio" placeholder="Data di inizio">
                    </div>
                    @foreach($errors->get('data_inizio') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <input type="text" class="form-control" id="data-fine" name="data-fine" placeholder="Data di fine">
                    </div>
                    @foreach($errors->get('data_fine') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <input type="text" class="form-control" id="descrizione" name="descrizione" placeholder="Descrizione">
                    </div>
                    @foreach($errors->get('descrizione') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <input type="number" class="form-control" id="min-voti" name="min-voti" placeholder="Numero minimo di voti">
                    </div>
                    @foreach($errors->get('numero_voti_minimo') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <input type="number" class="form-control" id="max-voti" name="max-voti" placeholder="Numero massimo di voti">
                    </div>
                    @foreach($errors->get('numero_voti_massimo') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="attivo"> Attivo
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop