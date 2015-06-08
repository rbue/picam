@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Archiv</div>

                    <div class="panel-body">
                        <p>Nachfolgend sehen Sie eine Liste mit den bisher aufgezeichneten Aufnahmen der Überwachungskamera bzw. dem Überwachungsmodus.</p>
                        <hr />
                        <table class="table table-striped table-bordered dataTable" id="vidsList">
                            <thead>
                            <tr>
                                <th>Dateiname</th>
                                <th>Erstellungsdatum</th>
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
@endsection

@section('title', 'Archiv')

{{-- Additional assets for this view --}}
@section('add_assets')
    <script src="{{ asset('/js/libs/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/libs/dataTables.bootstrap.min.js') }}"></script>
    <link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/classes/archive.js') }}"></script>
    <script src="{{ asset('/js/pages/archive.js') }}"></script>
@endsection