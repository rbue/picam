@extends('layout.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Streaming</div>
				<div class="panel-body">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addStream"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Hinzufügen</button>
                    </div>
                    <hr />
                    <p class="lead">Streams</p>
                    <table class="table table-striped table-bordered dataTable" id="streamList">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titel</th>
                                <th>IP-Adresse</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Modal - Add a stream --}}
<div class="modal fade" id="addStream" tabindex="-1" role="dialog" aria-labelledby="addStream" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schliessen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addStreamLabel">Stream hinzufügen</h4>
            </div>
            <div class="modal-body">
                <form id="frm_addStream">
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titel/Bezeichnung">
                    </div>
                    <div class="form-group">
                        <label for="ip">IP-Adresse</label>
                        <input type="text" class="form-control" id="ip" name="ip" placeholder="IP-Adresse">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="button" class="btn btn-primary" id="btn_addStream">Speichern</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('title', 'Streaming')

{{-- Additional assets for this view --}}
@section('add_assets')
<script src="{{ asset('/js/libs/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/libs/dataTables.bootstrap.min.js') }}"></script>
<link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<script src="{{ asset('/js/pages/streams.js') }}"></script>
@endsection