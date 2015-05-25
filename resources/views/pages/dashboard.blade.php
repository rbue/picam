@extends('layout.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Betriebsmodi</div>
				<div class="panel-body">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default active"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Ausschalten</button>
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> Streaming</button>
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Überwachung</button>
                    </div>
				</div>
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">Aktueller Modus</div>
                <div class="panel-body">
                    <p>Lörem ipsum dölor</p>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection

@section('title', 'Betriebsmodi')