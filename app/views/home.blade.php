@extends('layouts.master')
@section('head')
<script type="text/javascript">
var branchID;
var branches;
var inventory; // this is the inventory returned from the server.
function makeKitBlock(kit, cls, selIcon)
{
    // K.ID AS KitID, K.KitType, K.Name AS KitName, K.AtBranch, K.KitState, K.KitDesc, K.Specialized,  K.SpecializedName,
    // B.ID as BookingID, B.ForBranch, B.StartDate, B.EndDate, B.ShadowStartDate, B.ShadowEndDate, B.Purpose,
    // KS.StateName,
    // KT.Name AS KitTypeName, KT.TypeDescription as KitTypeDesc

    console.log(kit);
    var d = $('<div>', { 'class': cls, 'id': kit.KitID});
    d.append($('<p>', {'class': 'kit-block-icon ' + selIcon}).html(kit.KitID));
    var kitName = kit.KitTypeName + " - " + kit.KitName;
    if (kit.Specialized == "1")
    {
        kitName = kitName + " + " + kit.SpecializedName;
    }
    var t = $('<table>');
    t.append($('<tr>', {'class': 'kit-block-name'}).html(kitName));
    t.append($('<tr>', {'class': 'kit-block-contents'}).html(kit.KitDesc));
    t.append($('<tr>', {'class': 'kit-block-state'}).html(kit.StateName));
    if (selIcon == "sign-out")
    {
        t.append($('<tr>', {'class': 'kit-block-activity'}).html("Shipping to " + branches[kit.ForBranch].BranchID));
    }
    if (selIcon == "sign-in")
    {
        t.append($('<tr>', {'class': 'kit-block-activity'}).html("Receiving from " + branches[kit.AtBranch].BranchID));
    }
    d.append(t);
    return d;
}
function loadInventory()
{
    for (var i in inventory)
    {
        var kit = inventory[i];
        var sel = ".kit-blocks.inventory";
        var selClass = 'kit-block storage';
        var selIcon = 'on-self';
        if (kit.BookingID)
        {
            // This has a booking record
            sel = ".kit-blocks.pending";
            selClass = 'kit-block pending';
            if (kit.ForBranch == kit.AtBranch)
            {
                // this booking is for this branch,
                if (kit.KitState == 0)
                {
                    // at branch, so stays in inventory
                    sel = ".kit-blocks.inventory";
                }
            }
            console.info("at " + kit.AtBranch + "  " + branchID);
            if (kit.AtBranch == branchID)
            {
                selIcon = 'sign-out';
            }
            else
            {
                selIcon = 'sign-in';
            }

        }
        else
        {
            // inventory
        }
        console.log("Sel: " +sel + "   SELClass: " + selClass + "  Sel Icon" + selIcon);
        $(sel).append(makeKitBlock(kit, selClass, selIcon));
    }
}
</script>
@stop


@section('content')

{{--check if user is logged on to determine what to display--}}
@if (Auth::check())
    <table cellpadding = 0 style="height:100%">
        <tr>
            <th class="right-seperator">Pending Activity</th>
            <th>Branch Inventory</th>
        </tr>
        <tr>
            <td class="pending right-seperator">
                <div class="kit-blocks pending"></div>
            </td>
            <td class="inventory">
                <div class="kit-blocks inventory"></div>
            </td>
        </tr>
    </table>

@else {{--display page if user has not logged in --}}
    <h1 class='welcome-message'>Welcome to the EPL Kit Manager</h1>
@endif

<script type="text/javascript">

$(function()
{
    $.getJSON( "{{ route('home.getInventory') }}", function( data )
    {
        branchID = data.branch_ID;
        branches = data.branches;
        console.log(data);
        inventory = data.data;
        loadInventory();
    });

});
</script>
@stop
