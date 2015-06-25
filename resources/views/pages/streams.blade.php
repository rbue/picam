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

    {{-- Include modals --}}
    @include('modals.stream_add')
    @include('modals.stream_delete')
    @include('modals.stream_show')

@endsection

@section('title', 'Streaming')

{{-- Additional assets for this view --}}
@section('add_assets')
    <link rel="stylesheet" href="//releases.flowplayer.org/6.0.1/skin/minimalist.css">
    <script src="//releases.flowplayer.org/6.0.1/flowplayer.min.js"></script>
    <script src="{{ asset('/js/libs/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/libs/dataTables.bootstrap.min.js') }}"></script>
    <link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/classes/streaming.js') }}"></script>
    <script src="{{ asset('/js/pages/streams.js') }}"></script>
@endsection