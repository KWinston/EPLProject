<!doctype html>
<html lang="en">
<html>
	<head>
		<meta charset="utf-8">
		<title>EPL Kit Manager</title>
	    <style> @import url(//fonts.googleapis.com/css?family=Lato:700); </style>
	    {{ HTML::style('css/master.css') }}
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
	    </script>

	    @yield('head')
	</head>

	<body>
		<div class="menu">
			<div class="options">
				<div class="option-left">
					<a href="{{ route('home.index'); }}">HOME</a>
				</div>
				@if(Auth::check())
				<div class="option left">
					<a href="{{ route('book_kit.index'); }}">Book Kit</a>
				</div>
				
				<div class="option left">
					<a href="{{ route('recieve_kit.index'); }}">Recieve Kit</a>
				</div>
				<div class="option left">
					<a href="{{ route('ship_kit.index'); }}">Ship Kit</a>
				</div>
				@endif

				<div class="option right">
				@if (Auth::check())
					<a href="{{ URL::route('account-log-out') }}">LOGOUT</a>
				</div>
				<div class="option right">
					<p>{{ Auth::user()->username }}</p>
				@else
					<a href="{{ URL::route('account-log-in') }}">PLEASE LOGIN</a>
				@endif
				</div>
			</div>
		</div>
		<div class="content">
				@yield('content')
		</div>
		<div class="menu" style="float: bottom;">
			<div class="options">
				<p style="text-align: right;">Ian, Robert, Winston, Wilson</p>
			</div>	
		</div>
	</body>
</html>