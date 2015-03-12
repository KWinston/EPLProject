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

        {{ HTML::script('js/jquery.min.js', array('type' => 'text/javascript')) }}
        {{ HTML::script('js/jquery-ui.js', array('type' => 'text/javascript')) }}
        {{ HTML::script('plugins/jquery.pulse.js', array('type' => 'text/javascript')) }}

        @yield('head')
    </head>

    <body>
        <div class="slideout-menu">
            <h3>NOTIFICATIONS</h3>
            <a href="#" class="slideout-menu-toggle">&times;</a>
        </div>

        <div class="menu">
            <div class="options">
                <div class="option left main-menu-home">
                    <a class="main-menu" href="{{ route('home.index', array('selected_menu' => 'main-menu-home')); }}">HOME</a>
                </div>
                @if(Auth::check())
                    <div class="option left main-menu-book" >
                        <a href="{{ route('book_kit.index', array('selected_menu' => 'main-menu-book')); }}">BOOK KIT</a>
                    </div>
                    <div class="option left main-menu-receive">
                        <a href="{{ route('recieve_kit.index', array('selected_menu' => 'main-menu-receive')); }}">RECIEVE KIT</a>
                    </div>
                    <div class="option left main-menu-ship">
                        <a href="{{ route('ship_kit.index', array('selected_menu' => 'main-menu-ship')); }}">SHIP KIT</a>
                    </div>
                    <div class="option left main-menu-overview">
                        <a href="{{ route('overview_kit.index', array('selected_menu' => 'main-menu-overview')); }}">BROWSE KITS</a>
                    </div>
                @endif

                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <div class="option left main-menu-administration">
                        <a href="{{ route('admin.index', array('selected_menu' => 'main-menu-administration')); }}">ADMINISTRATOR</a>
                    </div>
                @endif

                @if(Auth::check())
                    <div class="option right">
                        <a href="#" class="slideout-menu-toggle">
                            <i class="fa fa-bars"></i>NOTIFICATIONS
                        </a>
                    </div>

                    <div class="option right">
                        BRANCH&#58;
                        <select data-placeholder="Branch" id="branchMenu"
                            class="chosen-select branch-select" tabindex="2">
                        </select>
                    </div>
                @endif

                @if (Auth::check())
                    <div class="option right">
                        <p>WELCOME: {{ Auth::user()->username }} <a href="{{ URL::route('master.logout') }}">(logout)</a></p>
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
        @if (!isset($nested))
            <div class="content">
        @endif
        @yield('content')
        @if (!isset($nested))
            </div>
            <div class="menu" style="float: bottom;">
                <div class="options" id="footer_credits">
                    <p style="text-align: right;"> Ian, Robert, Winston and Wilson</p>
                </div>
            </div>
        @endif

        {{ HTML::script('plugins/chosen_1_3_0_dropdown/chosen.jquery.min.js',
            array('type' => 'text/javascript')) }}

        {{ HTML::script('js/master.js',
            array('type' => 'text/javascript')) }}

        <script type="text/javascript">
            @if (isset($selected_menu))
                $(".{{$selected_menu}}").addClass("menu-selected");
            @else
                $(".main-menu-home").addClass("menu-selected");
            @endif

            $("#branchMenu").load("{{ URL::route('master.branches') }}", function() {
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
            $(function(){
                $(document).tooltip(
                {
                    content: function ()
                    {
                        return $(this).prop('title');
                    }
                });
            });
        </script>

        @yield('foot')
    </body>
</html>
