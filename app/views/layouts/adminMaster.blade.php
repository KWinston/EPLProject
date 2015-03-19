
@extends('layouts.master', array('nested'=>true))

@section('head')

@stop

@section('content')
    @if(Auth::check() && Auth::user()->is_admin == 1)
        <div class="menu">
            <div class="options">
                <div class="option left admin-menu-logs">
                    <a href="{{ route('admin.index'); }}">Logs</a>
                </div>
                <div class="option left admin-menu-manage-kits">
                    <a href="{{ route('kits.index'); }}">Manage Kits</a>
                </div>
                <div class="option left admin-menu-manage-kit-types">
                    <a href="{{ route('kitTypes.index'); }}">Manage Kit Types</a>
                </div>
<!--                 <div class="option left admin-menu-manage-branches">
                    <a href="{{ route('branches.index'); }}">Manage Branches</a>
                </div>
 -->                <div class="option left admin-menu-manage-users">
                    <a href="{{ route('users.index'); }}">Manage Users</a>
                </div>
            </div>
        </div>
    @endif
<div class="content">
        @yield('Content')
</div>
<div class="menu" style="float: bottom;">
    <div class="options">
        <p style="text-align: right;">Ian, Robert, Winston and Wilson</p>
    </div>
</div>

@stop
{{-- This will be included into the script block from the master page, allowing for externsion of the master script in order with the
    code execution from the master layout. --}}
@section('master-script')
    @if (isset($selected_admin_menu))
        helpTopic = "{{$selected_admin_menu}}";
        $(".{{$selected_admin_menu}}").addClass("menu-selected");
    @endif
@stop
