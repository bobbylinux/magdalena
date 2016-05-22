@extends('templates.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Votazioni</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    <select class="form-control" id="select-data-rif" data-token="{!! csrf_token() !!}">
                        <option value="0">Seleziona una votazione</option>
                        @foreach($dataRif as $data)
                            <option value="{!! $data['c_rif'] !!}">{!! date("d-m-Y", strtotime($data['d_rif_ini'])) !!} -> {!! date("d-m-Y", strtotime($data['d_rif_fin'])) !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

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