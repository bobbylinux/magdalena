@extends('templates.back')
@section('content')
    <div class="container-fluid form-login">
        <div class="row text-center">
            <i class="fa fa-key fa-5x"></i>
        </div>
        <div class="row text-center">
            <h2>Reset Password </h2>
        </div>
        <form class="form-horizontal" action="{!! url('/soci/password') !!}" method="post">
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4 text-center">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" class="form-control" id="id" name="id" value={!! $user->id !!}>
                    <input type="hidden" class="form-control" id="c_soc" name="c_soc" value={!! $user->c_soc !!}>
                    <h4>{!! $user->username !!}</h4>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            @foreach($errors->get('password') as $message)
                <div class="form-group">
                    <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                        <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                    </div>
                </div>
            @endforeach
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                    <input type="password" class="form-control" id="conferma_password" name="conferma_password" placeholder="Conferma Password">
                </div>
            </div>
            @foreach($errors->get('conferma_password') as $message)
                <div class="form-group">
                    <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                        <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                    </div>
                </div>
            @endforeach
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                    <button type="submit" class="btn btn-success btn-block">Cambia Password</button>
                </div>
            </div>
        </form>
    </div>
@stop