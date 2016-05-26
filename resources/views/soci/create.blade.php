@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Nuovo Socio</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/soci') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label for="codice-socio">Codice Socio</label>
                        {!! Form::text('codice-socio', null, ['class' => 'form-control', 'id' => 'codice-socio', 'placeholder' => 'Codice Socio']) !!}
                    </div>
                    @foreach($errors->get('codice_socio') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="codice-badge">Codice Badge</label>
                        {!! Form::text('codice-badge', null, ['class' => 'form-control', 'id' => 'codice-badge', 'placeholder' => 'Codice Badge']) !!}
                    </div>
                    @foreach($errors->get('codice_badge') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        {!! Form::text('cognome', null, ['class' => 'form-control', 'id' => 'cognome', 'placeholder' => 'Cognome']) !!}
                    </div>
                    @foreach($errors->get('cognome') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        {!! Form::text('nome', null, ['class' => 'form-control', 'id' => 'nome', 'placeholder' => 'Nome']) !!}
                    </div>
                    @foreach($errors->get('nome') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="cdc">Centro di costo</label>
                        {!! Form::select('cdc', array('0' => 'CDC') + $cdc,'' ,array('class'=>'form-control','id'=>'cdc','name' => 'cdc')) !!}
                    </div>
                    @foreach($errors->get('codice_cdc') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="sede">Sede</label>
                        {!! Form::select('sede', array('0' => 'Sede') + $sedi,'' ,array('class'=>'form-control','id'=>'sede', 'name' => 'sede')) !!}
                    </div>
                    @foreach($errors->get('codice_sede') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="username">Username</label>
                        {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Username']) !!}
                    </div>
                    @foreach($errors->get('username') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    @foreach($errors->get('password') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="conferma-password">Conferma Password</label>
                        <input type="password" class="form-control" id="conferma-password" name="conferma-password" placeholder="Conferma Password">
                    </div>
                    @foreach($errors->get('conferma-password') as $message)
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                        </div>
                    @endforeach
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="amministratore" name="amministratore"> Amministratore
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="attivo" name="attivo"> Utente Attivo
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop