@extends('templates.front')
@section('content')
    <div class="container-fluid form-login">
        <div class="row text-center">
            <i class="fa fa-users fa-5x"></i>
        </div>
        <div class="row text-center">
            <h2>Accedi</h2>
        </div>
        <form class="form-horizontal" action="{!! url('login') !!}" method="post">
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            @foreach($errors->get('username') as $message)
                <div class="form-group">
                    <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                        <div class="alert alert-danger" role="alert">{!! $message !!}</div>
                    </div>
                </div>
            @endforeach
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                    <button type="submit" class="btn btn-success btn-block">Log in</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-xs-12 col-sm-offset-4">
                    <label>
                        <a href="{!! url('password') !!}">Password smarrita?</a>
                    </label>
                </div>
            </div>
        </form>
    </div>
@stop