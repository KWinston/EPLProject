@extends('layouts.master')
@section('head')
{{ HTML::style('css/overview.css') }}

<style>
.ui-tooltip
{
    width:500px;
    min-width:500px;
}
</style>
<script type="text/javascript">

    var kitContentDialog;
    var enterMessageDialog;

    function DisplayKitContents(kitID)
    {
        url = "{{ route('kit_contents.edit', array(':KitID')); }}";
        $("#kit-contents-dialog").load(url.replace(':KitID', kitID), function()
        {
            $(".kit-content-form-value.checkbox.disabled").prop('disabled', true);
            $(".kit-content-form-value.damaged.checkbox").unbind().change(DamageChanged);
            $(".kit-content-form-value.missing.checkbox") .unbind().change(MissingChanged);

            kitContentDialog.dialog("open");
        })
    }
    function GetMessage(title, func)
    {
        $("#enter-message-dialog-text").val('');
        enterMessageDialog.dialog("option", "title", title);
        enterMessageDialog.dialog("option", "buttons",[
            {
              text: "Close",
              click: function()
              {
                $( this ).dialog( "close" );
                if (func != undefined && func != null)
                {
                    func();
                }
              }
            }]);
        enterMessageDialog.dialog("open");
    }
    function DamageChanged()
    {
        if ($(this).hasClass("checkbox") )
        {
            var contentIndex = $(this).parent().attr('ID');
            if ($(this).prop('checked'))
            {
                GetMessage("Enter Damaged Item Comment", function()
                {
                    var msg = $("#enter-message-dialog-text").val();
                    var txt = '<td colspan="4">Damage:' + msg +'</td>';
                    txt = txt + '<input name="DamagedMsg_' + contentIndex + '" type="hidden" value="' + window.btoa(msg) + '">'
                    console.log(txt);
                    $("tr.kit-contents-damaged-msg#_" + contentIndex).html(txt);
                });
            }
            else
            {
                $("tr.kit-contents-damaged-msg#_"+contentIndex).html('');
            }
        }
    }
    function MissingChanged()
    {
        if ($(this).hasClass("checkbox"))
        {
            var contentIndex = $(this).parent().attr('ID');
            if($(this).prop('checked'))
            {
                GetMessage("Enter Missing Item Comment", function()
                {
                    var msg = $("#enter-message-dialog-text").val();
                    var txt = '<td colspan="4">Missing:' + msg +'</td>';
                    txt = txt + '<input name="MissingMsg_' + contentIndex + '" type="hidden" value="' + window.btoa(msg) + '">'
                    console.log(txt);
                    $("tr.kit-contents-missing-msg#_" + contentIndex).html(txt);
                });
            }
            else
            {
                $("tr.kit-contents-missing-msg#_"+contentIndex).html('');
            }

        }
    }

</script>
@stop

@section('content')


<table class="kit-status">
    <tr class="kit-status-header">
        <th class="kit-status kit-type">Kit Type</th>
        <th class="kit-status kit-name">Kit Name</th>
        <th class="kit-status branch-id">At Branch</th>
        <th class="kit-status kit-state">Kit State</th>
        <th class="kit-status start-date">Next Booking Starts</th>
        <th class="kit-status branch-name">Booked For </th>
        <th class="kit-status booking-count">Total Future Bookings</th>
    </tr>
    <!-- {{$breakKitType = null; }} -->

    @foreach($data as $row)
    <tr class="kit-status" id="{{$row->KitID}}">
        @if($row->KitType != $breakKitType)
            <td class="kit-status kit-type" title="<p>{{$row->TypeDescription}}</p>">{{$row->KitType}}</td>
        @else
            <td class="kit-status kit-type"></td>
        @endif
        <td class="kit-status kit-name" title="<p>{{$row->KitDescription}}<p>">{{$row->KitName}}</td>
        <td class="kit-status branch-id" title="<table class='tooltip-branch'><tr><td class='tooltip-header'>Name</td><td class='tooltip-value'> {{$row->BranchName}}</td></tr><tr>
            <td class='tooltip-header'>Address</td><td class='tooltip-value'>{{$row->BranchAddress}}</td></tr><tr>
            <td class='tooltip-header'>Phone</td><td class='tooltip-value'>{{$row->ForBranchPhone}}</td></tr></table>
            ">{{$row->BranchID}}</td>
        <td class="kit-status kit-state">{{$row->KitState}}</td>
        @if(isset($row->StartDate))
            <td class="kit-status start-date" title="{{'<p>Booked By:' . $row->UserName . '</p><p>Email:' . $row->UserEmail . '</p>'}}">{{ date("D d-F-Y",strtotime($row->StartDate)) }}</td>
        @else
            <td class="kit-status start-date"></td>
        @endif
        <td class="kit-status branch-name"  title="<p>{{$row->ForBranchName}}</p><br/><p>Phone: {{$row->ForBranchPhone}}</p>">{{$row->ForBranchID}}</td>
        @if($row->BookingCount > 0)
            <td class="kit-status booking-count">{{$row->BookingCount}}</td>
        @else
            <td class="kit-status booking-count"></td>
        @endif

        <!-- {{$breakKitType = $row->KitType;}} -->
    </tr>
    @endforeach
</table>
<div id="kit-contents-dialog"> </div>
<div id="enter-message-dialog">
    <textarea id="enter-message-dialog-text" rows="4" cols="75" ></textarea>
</div>

<script type="text/javascript">
    $(function()
    {
        $("tr.kit-status").click(function()
        {
            DisplayKitContents($(this).attr('id'));
        })
        kitContentDialog = $("#kit-contents-dialog").dialog(
        {
            autoOpen: false,
            buttons: [
            {
              text: "Save",
              click: function()
              {
                $( this ).dialog( "close" );
                $.post("{{ route('kit_contents.store') }}", $('.kit-contents-edit-form').serialize());
              }
            },
            {
              text: "Cancel",
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
            title: "Kit contents"

        });
        enterMessageDialog = $("#enter-message-dialog").dialog(
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
            width: 806,
            resizable: false,
            title: "Enter Damage Message"
        });


    })
</script>
@stop
