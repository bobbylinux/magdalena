@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Modifica Socio</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form class="form" action="{!! url('/soci/'.$socio['c_soc']) !!}" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label for="codice-socio">Codice Socio</label>
                        <input type="text" class="form-control" value="{!! $socio['c_soc'] !!}" id="codice-socio" name="codice-socio" placeholder="Codice Socio">
                    </div>
                    <div class="form-group">
                        <label for="codice-badge">Codice Badge</label>
                        <input type="text" class="form-control" value="{!! $socio['c_bdg'] !!}" id="codice-badge" name="codice-badge" placeholder="Codice Badge">
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        <input type="text" class="form-control" value="{!! $socio['t_cgn'] !!}" id="cognome" name="cognome" placeholder="Cognome">
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" value="{!! $socio['t_nom'] !!}" id="nome" name="nome" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="cdc">Centro di Costo</label>
                        {!! Form::select('cdc', array('0' => 'CDC') + $cdc,'' ,array('class'=>'form-control','id'=>'cdc','name' => 'cdc')) !!}
                    </div>
                    <div class="form-group">
                        <label for="sede">Sede</label>
                        {!! Form::select('sede', array('0' => 'Sede') + $sedi,'' ,array('class'=>'form-control','id'=>'sede', 'name' => 'sede')) !!}
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" value="{!! $user['username'] !!}" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="amministratore" name="amministratore"> Amministratore
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop