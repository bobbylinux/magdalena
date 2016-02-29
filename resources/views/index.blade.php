@extends('templates.front')
@section('content')
	<div class="container-fluid form-login">    
		<div class="row text-center">
			<i class="fa fa-users fa-5x"></i>
		</div>
		<div class="row text-center">
			<h2>Accedi</h2>
		</div>
      	<form class="form-horizontal">
		  <div class="form-group">
		    <div class="col-sm-4 col-lg-offset-4">
		      <input type="email" class="form-control" id="username" placeholder="Username">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-4 col-lg-offset-4">
		      <input type="password" class="form-control" id="password" placeholder="Password">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-4 col-lg-offset-4">
		      <button type="submit" class="btn btn-success btn-block">Log in</button>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-4 col-lg-offset-4">
		       	<label>
		       		<a href="">Password smarrita?</a>
				</label>
		    </div>
		  </div>
		</form>
    </div>
@stop