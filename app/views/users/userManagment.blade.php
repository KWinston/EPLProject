@extends('layouts.adminMaster')
@section('head')
<script type="text/javascript">
var userDialog;
</script>
@stop
@section('Content')
<table class="users-list">
    <tr class="users-list-header">
        <th class="users-list-id">ID</th>
        <th class="users-list-username">User Name</th>
        <th class="users-list-realname">Real Name</th>
        <th class="users-list-email">Email Address</th>
        <th class="users-list-homebranch">Home Branch</th>
        <th class="users-list-isadmin">Is Admin</th>
    </tr>
    @foreach($users as $user)
    <tr class="users-list-row" id="{{$user->id}}">
        <td class="users-list-id">{{$user->id}}</td>
        <td class="users-list-username">{{htmlspecialchars($user->username)}}</td>
        <td class="users-list-realname">{{htmlspecialchars($user->realname)}}</td>
        <td class="users-list-email">{{htmlspecialchars($user->email)}}</td>
        <td class="users-list-homebranch">({{$user->homeBranch->BranchID}}) {{$user->homeBranch->Name}}</td>
        @if($user->is_admin == 1)
            <td class="users-list-isadmin">YES</td>
        @else
            <td class="users-list-isadmin">no</td>
        @endif
    </tr>
    @endforeach
</table>
<div id="EditUserDialog" class="edit-user-dialog" style="display:none;">
</div>
<script type="text/javascript">
    $(function()
    {
        $(".users-list-row").click(function()
        {
            var userID = $(this).find(".users-list-id").html()
            url = "{{ route('users.edit', array(':USERID')) }}";
            url = url.replace(':USERID', userID);


            $("#EditUserDialog").load(url, function()
            {
                userDialog.dialog('open');
            });
        });
        // document ready
        userDialog = $("#EditUserDialog").dialog(
        {
            title: "Edit User",
            autoOpen: false,
            width: '500px',
            dialogClass: "no-close",
            draggable: false,
            modal: true,
            resizable: false,
            buttons:
            [{
                text: "CANCEL",
                click: function()
                {
                    $( this ).dialog( "close" );
                }
            },
            {
                text: "OK",
                click: function()
                {

                    $( this ).dialog( "close" );
                    formData = $('#EditUserDialog form').serialize();
                    console.log(formData);
                    // $(".user-edit.homebranch option[selected='selected']").removeAttr('selected');
                    // $(".user-edit.homebranch option[value='"+$(".user-edit.homebranch").val()+"']").attr('selected', 'selected');
                    $.post("{{ route('users.store') }}", $('#EditUserDialog form').serialize(), function( data )
                    {
                        trSelector = "tr.users-list-row#" + data.id;
                        $(trSelector + " td.users-list-username" ).html(data.username);
                        $(trSelector + " td.users-list-realname" ).html(data.realname);
                        $(trSelector + " td.users-list-email" ).html(data.email);

                        $(trSelector + " td.users-list-homebranch" ).html(data.home_branch);
                        if (data.is_admin)
                        {
                            $(trSelector + " td.users-list-isadmin" ).html("YES");
                        }
                        else
                        {
                            $(trSelector + " td.users-list-isadmin" ).html("no");
                        }
                    }, 'json');


                }
            }]
        });
    })
</script>

@stop
