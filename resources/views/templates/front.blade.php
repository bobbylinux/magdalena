<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Magdalena</title>

    <!-- Bootstrap -->
    <link href="{!! url('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('css/custom-theme/jquery-ui-1.10.0.custom.css') !!}" rel="stylesheet">
    <link href="{!! url('css/styles.css') !!}" rel="stylesheet">

    <!-- Font-Awesome-->
    <link href="{!! url('css/font-awesome.min.css') !!}" rel="stylesheet">


    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.11.4/themes/cupertino/jquery-ui.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!!url('')!!}"><i class="fa fa-home"></i></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">{!! Auth::user()->username !!}</a></li>
                @if (Auth::check())
                    @if (Auth::user()->admin == true)
                        <li><a href="{!! url('/dashboard') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @endif
                    <li><a href="{!! url('/logout') !!}"><i class="fa fa-sign-out"></i> Scollegati</a></li>
                @else
                    <li><a href="{!! url('/login') !!}"><i class="fa fa-sign-in"></i> Accedi</a></li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container-fluid">
    @yield('content')
</div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{!! url('js/bootstrap.min.js') !!}"></script>
<script src="{!! url('js/scripts-front.js') !!}"></script>
</body>
</html>