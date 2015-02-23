<!doctype html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        <title>EPL Kit Manager</title>
        <style> @import url(//fonts.googleapis.com/css?family=Lato:700);</style>
        {{ HTML::style('css/master.css') }}
        {{ HTML::style('css/notifications-menu.css') }}
        {{ HTML::style('plugins/chosen_1_3_0_dropdown/chosen.css') }}
        {{ HTML::style('css/jquery-ui.css') }}

        {{ HTML::script('plugins/jQuery_1_1_2/jquery-1.11.2.min.js', array('type' => 'text/javascript')) }}
        {{ HTML::script('plugins/jQuery_1_1_2/jquery-ui.js', array('type' => 'text/javascript')) }}

        @yield('head')
    </head>

    <body>
        <div class="slideout-menu">
            <h3>NOTIFICATIONS</h3>
            <a href="#" class="slideout-menu-toggle">&times;</a>
        </div>

        <div class="menu">
            <div class="options">
                <div class="option left">
                    <a href="{{ route('home.index'); }}">HOME</a>
                </div>
                @if(Auth::check())
                    <div class="option left">
                        <a href="{{ route('book_kit.index'); }}">BOOK KIT</a>
                    </div>
                    <div class="option left">
                        <a href="{{ route('recieve_kit.index'); }}">RECIEVE KIT</a>
                    </div>
                    <div class="option left">
                        <a href="{{ route('ship_kit.index'); }}">SHIP KIT</a>
                    </div>
                    <div class="option left">
                        <a href="{{ route('overview_kit.index'); }}">OVERVIEW</a>
                    </div>
                @endif

                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <div class="option left">
                        <a href="">ADMINISTRATOR</a>
                    </div>
                @endif

                @if(Auth::check())
                    <div class="option right">
                        <a href="#" class="slideout-menu-toggle">
                            <i class="fa fa-bars"></i>NOTIFICATIONS
                        </a>
                    </div>

                    <div class="option right">
                        <select data-placeholder="Branch" 
                            class="chosen-select branch-select" tabindex="2">
                        </select>
                    </div>
                @endif

                @if (Auth::check())
                    <div class="option right">
                        <a href="{{ URL::route('master.logout') }}">LOGOUT</a>
                    </div>
                    <div class="option right">
                        <p>WELCOME: {{ Auth::user()->username }}</p>
                    </div>
                @else
                    <div class="option right">
                        {{ Form::open(['route' => 'master.login']) }}
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

        {{ HTML::script('js/master.js',
            array('type' => 'text/javascript')) }}

        <script type="text/javascript">
            $(".branch-select").load("{{ URL::route('master.branches') }}", function(){

                for (var selector in config)
                {
                    $(selector).chosen(config[selector]);
                    $(selector).chosen().on('change', function(e)
                    {
                        var json = { 'branch' : $(this).chosen().val() };
                        $.post("{{ URL::route('master.select_branch') }}", json)
                            .success(function(data){
                                @yield('changeBranch')
                            })
                            .fail(function(){
                                console.log("error");
                            });
                    });

                    @if (Session::has('branch'))
                        $(selector).val("{{ Session::get('branch') }}");
                        $(selector).trigger("chosen:updated");
                    @endif
                }
            });
        </script>

        @yield('foot')
    </body>
</html>
