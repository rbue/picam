@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Betriebsmodi</div>
                    <div class="panel-body">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" id="btn_off" class="btn btn-default @if($status == "OFF")active @endif" @if($status == "OFF")disabled="disabled" @endif><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Ausgeschalten</button>
                            <button type="button" id="btn_stream" class="btn btn-default @if($status == "STREAM")active @endif" @if($status == "STREAM")disabled="disabled" @endif><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> Streaming</button>
                            <button type="button" id="btn_surveillance" class="btn btn-default @if($status == "SURVEILLANCE")active @endif" @if($status == "SURVEILLANCE")disabled="disabled" @endif><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Überwachung</button>
                        </div>
                        <br /><br />
                        <p><b>Hinweis:</b> Bitte vor einem Moduswechsel immer zuerst abschalten!</p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Aktueller Modus</div>
                    <div class="panel-body" id="panel-content">
                        {{-- Include views depending on the status at page reload --}}
                        @if($status == "OFF")
                            @include('parts.dashboard_off')
                        @elseif($status == "STREAM")
                            @include('parts.dashboard_stream')
                        @elseif($status == "SURVEILLANCE")
                            @include('parts.dashboard_surveillance')
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Betriebsmodi')

    {{-- Additional assets for this view --}}
@section('add_assets')
    <script src="{{ asset('/js/libs/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('/js/classes/dashboard.js') }}"></script>
    <script src="{{ asset('/js/pages/dashboard.js') }}"></script>
@endsection
