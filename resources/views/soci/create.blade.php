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
                    <div class="form-group">
                        <input type="text" class="form-control" id="codice-socio" name="codice-socio" placeholder="Codice Socio">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="codice-badge" name="codice-badge" placeholder="Codice Badge">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="cognome" name="cognome" placeholder="Cognome">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        {!! Form::select('cdc', array('0' => 'CDC') + $cdc,'' ,array('class'=>'form-control','id'=>'cdc','name' => 'cdc')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('sede', array('0' => 'Sede') + $sedi,'' ,array('class'=>'form-control','id'=>'sede', 'name' => 'sede')) !!}
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="tipo-socio" name="tipo-socio" placeholder="Tipo Socio">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="conferma-password" placeholder="Conferma Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="candidato" name="candidato"> Candidato
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="amministratore" name="amministratore"> Amministratore
                        </label>
                    </div>
                    <div class="form-group">
                        {!! Form::select('data-riferimento', array('0' => 'Data Riferimento Votazione') + $data,'' ,array('class'=>'form-control','id'=>'data-riferimento','name' => 'data-riferimento')) !!}
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Salva</button>
                </form>
            </div>
        </div>
    </div>
@stop