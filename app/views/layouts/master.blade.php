<!doctype html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        <title>EPL Kit Manager</title>
        {{ HTML::style('css/master.css') }}
        {{ HTML::style('css/help.css') }}
        {{ HTML::style('css/notifications-menu.css') }}
        {{ HTML::style('plugins/chosen_1_4_0_dropdown/chosen.css') }}
        {{ HTML::style('css/jquery-ui.css') }}

        {{ HTML::script('js/jquery.min.js', array('type' => 'text/javascript')) }}
        {{ HTML::script('js/jquery-ui.js', array('type' => 'text/javascript')) }}
        {{ HTML::script('plugins/jquery.pulse.js', array('type' => 'text/javascript')) }}


        <script type="text/javascript">
        // Help system, this will be the code that handles all anchors within a help page.
        var helpTopic;
        var helpDialog;
        function DisplayHelp(topic)
        {
            url = "{{ route('help.page', array('topic' => ':TOPIC')); }}";
            $("#help-dialog").load(url.replace(':TOPIC', topic), function()
            {
                helpDialog.dialog("open");
                $("#help-dialog a").click(function()
                {
                    DisplayHelp(this.id);
                    return false;
                })
                $("td.help-index-cell #"+topic).addClass("help-selected");
            })
        }
        var kitDetailsDialog;
        function DisplayKitDetails(kitID)
        {
            url = "{{ route('kits.kitDetails', array('topic' => ':KitID')); }}";
            $("#kit-details-dialog").load(url.replace(':KitID', kitID), function()
            {
                kitDetailsDialog.dialog("open");
            })
        }
        </script>
        @yield('head')
    </head>

    <body>
        <div id="help-dialog"> </div>
        <div id="kit-details-dialog"> </div>

        <div class="menu">
            <div class="options">
                <div class="option left" style="width: 50px;
                    background: url('images/EPL_Logo.png') no-repeat center center;
                    background-size: 40px 20px;">
                </div>
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
                    <div class="option right" style="padding-left: 10px;" >
                        <div id="settings_button_open" class="settings-icon"></div>
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
                <div class="option right">
                    <a href="#" id="help-button">HELP</a>
                </div>

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

        <div class="branch-select">
            <select data-placeholder="Branch" id="branchMenu" class="chosen-select" tabindex="2">
            </select>
            <br/><br/>
            <input id="settings_button_close" type="button" value="Done" />
        </div>

        {{ HTML::script('plugins/chosen_1_4_0_dropdown/chosen.jquery.min.js',
            array('type' => 'text/javascript')) }}

        {{ HTML::script('js/master.js',
            array('type' => 'text/javascript')) }}

        <script type="text/javascript">
            @if (isset($selected_menu))
                helpTopic = "{{$selected_menu}}";
                $(".{{$selected_menu}}").addClass("menu-selected");
            @else
                helpTopic = "index";
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
                                document.location.href = '/public';
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
                $('.branch-select').css('display', 'none');
                $('.branch-select').css('opacity', '1');        // required for load order
            });
            $(function()
            {
                helpDialog = $("#help-dialog").dialog(
                {
                    autoOpen: false,
                    buttons: [
                    {
                      text: "close",
                      click: function()
                      {
                        $( this ).dialog( "close" );
                      }
                    }],
                    draggable: false,
                    modal: true,
                    height: window.innerHeight * 0.8,
                    width: window.innerWidth * 0.8,
                    resizable: false,
                    title: "Help"

                });
                kitDetailsDialog = $("#kit-details-dialog").dialog(
                {
                    autoOpen: false,
                    buttons: [
                    {
                      text: "close",
                      click: function()
                      {
                        $( this ).dialog( "close" );
                      }
                    }],
                    draggable: false,
                    modal: true,
                    height: window.innerHeight * 0.8,
                    width: 1000,
                    resizable: false,
                    title: "Kit Details"

                });
                $("#help-button").click(function()
                {
                    DisplayHelp(helpTopic);
                })

                $(document).tooltip(
                {
                    content: function ()
                    {
                        var title = $(this).prop('title');
                        if (title.indexOf('__KIT_DETAIL__') == 0)
                        {
                            url = "{{ route('kits.kitDetails', array('topic' => ':KitID')); }}";
                            $.get(url.replace(':KitID', title.substring(14)), function(data){
                                $("div#"+title).html(data);
                                $(".ui-tooltip").addClass("ui-tooltip-wide");
                            });
                            return "<div ID='"+$(this).prop('title')+"' style='width:1000px;'></div>"
                        }
                        else
                        {
                            return $(this).prop('title');
                        }
                    }
                });

                $('#settings_button_open').click(function(){
                    $('.branch-select').fadeIn("slow");
                });

                $('#settings_button_close').button().click(function(){
                    $(this).parent().fadeOut("slow");
                });
            });
        @yield('master-script')

        </script>

        @yield('foot')
    </body>
</html>
