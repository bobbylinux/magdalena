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
    <link href="{!! url('css/ripples.min.css') !!}" rel="stylesheet">
    <link href="{!! url('css/styles.css') !!}" rel="stylesheet">

    <!-- Font-Awesome-->
    <link href="{!! url('css/font-awesome.min.css') !!}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>  
    <div id="wrapper">        
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{!! url('/') !!}">
                        Magdalena
                    </a>
                </li>
                <li>
                    <a href="{!! url('/') !!}">Dashboard</a>
                </li>
                <li>
                    <a href="{!! url('/soci') !!}">Gestione Soci</a>
                </li>
                <li>
                    <a href="{!! url('/sedi') !!}">Gestione Sedi</a>
                </li>
                <li>
                    <a href="{!! url('/cdc') !!}">Gestione Centri di Costo</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @yield('content')
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{!! url('js/bootstrap.min.js') !!}"></script>
    <script src="{!! url('js/ripples.min.js') !!}"></script>
    <script src="{!! url('js/scripts.js') !!}"></script>
  </body>
</html>