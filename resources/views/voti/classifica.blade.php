@extends('templates.back')
@section('content')
    <div class="container-fluid">
        @if (count($classifica) > 0)
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>CLASSIFICA {!! strtoupper($dataRif->t_des) !!} </h1>
            </div>
        </div>
        <div class="row div-dettagli">
            <div class="col-lg-8 col-lg-offset-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-2">Codice Badge</th>
                        <th class="col-lg-4">Cognome</th>
                        <th class="col-lg-4">Nome</th>
                        <th class="col-lg-2">Voti</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($classifica as $row)
                        <tr>
                            <td>{!! $row->c_bdg !!}</td>
                            <td>{!! $row->t_cgn !!}</td>
                            <td>{!! $row->t_nom !!}</td>
                            <td>{!! $row->voti  !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                {!! $classifica->render()  !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <a href="{!! url('/voti/classifica/stampa/'. $dataRif->c_rif) !!}" class="btn btn-success btn-block">Stampa</a>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>ANCORA NESSUN VOTO PER {!! strtoupper($dataRif->t_des) !!}</h1>
            </div>
        </div>
        @endif
    </div>
    <!-- modal wait-->
    <div class="modal fade" tabindex="-1" role="dialog" id="wait-msg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                             aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h4 class="text-center">Attendere Prego</h4>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop