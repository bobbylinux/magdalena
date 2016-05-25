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
                    Votazioni
                </a>
            </li>
            <li>
                <a href="{!! url('/password') !!}"><i class="fa fa-key"></i> Cambio Password</a>
            </li>
            <li>
                <a href="{!! url('/candidati') !!}"><i class="fa fa-map-o"></i> Gestione Candidati</a>
            </li>
            <li>
                <a href="{!! url('/cdc') !!}"><i class="fa fa-money"></i> Gestione Centri di Costo</a>
            </li>
            <li>
                <a href="{!! url('/dateriferimento') !!}"><i class="fa fa-calendar"></i> Gestione Date di riferimento</a>
            </li>
            <li>
                <a href="{!! url('/sedi') !!}"><i class="fa fa-truck"></i> Gestione Sedi</a>
            </li>
            <li>
                <a href="{!! url('/soci') !!}"><i class="fa fa-users"></i> Gestione Soci/Utenti</a>
            </li>
            <li>
                <a href="{!! url('/voti') !!}"><i class="fa fa-pencil"></i> Statistiche Votazioni</a>
            </li>
            <li><a href="{!! url('/logout') !!}"><i class="fa fa-sign-out"></i> Scollegati</a></li>
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
<!--modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="msg-conferma-cancella">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Attenzione</h4>
            </div>
            <div class="modal-body">
                <p>Una volta confermata l'operazione non sarà più possibile annullarla.</p>
                <p>Confermare la cancellazione</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger" id="btn-conferma-cancella" data-id="0" data-anagrafica=""
                        data-token="{!! csrf_token() !!}">Conferma
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- modal error-->
<div class="modal fade" tabindex="-1" role="dialog" id="errore-messaggio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Errore</h4>
            </div>
            <div class="modal-body errore-testo">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="{!! url('js/datepicker-it.js') !!}"></script>
<script src="{!! url('js/bootstrap.min.js') !!}"></script>
<script src="{!! url('js/scripts-back.js') !!}"></script>
</body>
</html>