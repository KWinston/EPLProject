<!doctype html>
<html lang="en">
<html>
	<head>
		<meta charset="utf-8">
		<title>EPL Kit Manager</title>
	    <style> @import url(//fonts.googleapis.com/css?family=Lato:700);</style>
	    {{ HTML::style('css/master.css') }}
	    {{ HTML::style('plugins/chosen_1_3_0_dropdown/chosen.css') }}

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
	    </script>

	    @yield('head')
	</head>

	<body>
		<div class="menu">
			<div class="options">
				<div class="option left">
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
					<div class="option left">
						<a href="{{ route('overview_kit.index'); }}">Kit Overview</a>
					</div>
				@endif

				@if(Auth::check() && Auth::user()->is_admin == 1)
					<div class="option left">
						<a href="">Administrator</a>
					</div>
				@endif

				<div class="option right">
					<select data-placeholder="Choose a Branch" class="chosen-select branch-select" 		tabindex="2">
			            <option value="1"><p>Test1</p></option>
			            <option value="2">Test2</option>
			            <option value="3">Test3</option>
			        </select>
				</div>

				@if (Auth::check())
					<div class="option right">
						<a href="{{ URL::route('authenticate.logout') }}">LOGOUT</a>
					</div>
					<div class="option right">
						<p>Welcome: {{ Auth::user()->username }}</p>
					</div>
				@else
					<div class="option right">
						{{ Form::open(['route' => 'authenticate.login']) }}
							{{ Form::label('username', 'Username:') }}
							{{ Form::text('username') }}

							{{ Form::label('password', 'Password:')}}
							{{ Form::password('password') }}

							{{Form::submit('Login') }}	
						{{ Form::close() }}
					</div>
				
				@endif
				
			</div>
		</div>
		<div class="content">
				@yield('content')
		</div>
		<div class="menu" style="float: bottom;">
			<div class="options">
				<p style="text-align: right;">Ian, Robert, Winston and Wilson</p>
			</div>	
		</div>

  		{{ HTML::script('plugins/chosen_1_3_0_dropdown/chosen.jquery.min.js', 
  			array('type' => 'text/javascript')) }}

  		<script type="text/javascript">
		    var config = 
		    {
		    	'.chosen-select'           : {},
		      	'.chosen-select-deselect'  : {allow_single_deselect: true},
		      	'.chosen-select-no-single' : {disable_search_threshold:10},
		      	'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		      	'.chosen-select-width'     : {width:"95%"}
		    }

		    for (var selector in config) 
		      $(selector).chosen(config[selector]);
		    
  		</script>
  		@yield('foot')
	</body>
</html>