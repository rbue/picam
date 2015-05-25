<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Robin Bürkli">
	<title>{{ env('APP_TITLE') }} - @yield('title')</title>

    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <!-- Styles -->
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	{{-- <link href="{{ asset('/css/bootstrap-theme.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Google Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-main-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/home') }}">{{ env('APP_TITLE') }}</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-main-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/home') }}">Startseite</a></li>
					<li><a href="{{ url('/dashboard') }}">Betriebsmodi</a></li>
					<li><a href="{{ url('/streams') }}">Streaming</a></li>
					<li><a href="{{ url('/archive') }}">Archiv</a></li>
				</ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/about') }}">Info</a></li>
                </ul>
			</div>
		</div>
	</nav>

	@yield('content')

    <div class="footer">
        <div class="container">
            <p class="content">PiCam created by <a href="mailto:robinbuerkli@bluewin.ch">Robin Bürkli</a> - Modul 152</p>
        </div>
    </div>

	<!-- Scripts -->
	<script src="{{ asset('/js/libs/jquery-1.11.3.min.js') }}"></script>
	<script src="{{ asset('/js/libs/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/libs/notify.min.js') }}"></script>

    <!-- Additional Scripts & Styles (specific for the view) -->
    @yield('add_assets')
</body>
</html>