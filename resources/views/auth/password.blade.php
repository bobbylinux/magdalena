@extends('templates.front')
@section('content')
    <div class="container-fluid form-login">
        <div class="row text-center">
            <i class="fa fa-key fa-5x"></i>
        </div>
        <div class="row text-center">
            <h2>Recupera Password</h2>
        </div>
        <div class="row text-center">
            <p>Per recuperare la password è necessario contattare l'amministratore del programma {!! env('SYS_ADMIN_NAME', '')  !!} ai seguenti riferimenti</p>
            <p>Telefono: {!!  env('SYS_ADMIN_PHONE_NUMBER', '') !!}</p>
            <p>Indirizzo e-mail: <a href="mailto:{!!  env('SYS_ADMIN_EMAIL_ADDRESS', '') !!}?subject=Recupero%20Password%20Programma%20Votazioni">{!!  env('SYS_ADMIN_EMAIL_ADDRESS', '') !!}</a></p>
        </div>
    </div>
@stop