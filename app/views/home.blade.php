@extends('layouts.master')
@section('head')
<style>
.ui-tooltip
{
    width:500px;
    min-width:500px;
}
.ui-tooltip-content
{
}
</style>
<script type="text/javascript">
var branchID;
var branches;
var inventory; // this is the inventory returned from the server.
var bookings;
var kitTypes;

function makeBranchTooltip(branchID)
{
    str = "<table class='tooltip-branch'>";
    str += "<tr>";
    str += "<td class='tooltip-header'>Name</td>";
    str += "<td class='tooltip-value'>" + branches[branchID].Name + "</td>";
    str += "</tr>";
    str += "<tr>";
    str += "<td class='tooltip-header'>Address</td>";
    str += "<td class='tooltip-value'>" + branches[branchID].Address + "</td>";
    str += "</tr>";
    str += "<tr>";
    str += "<td class='tooltip-header'>Phone</td>";
    str += "<td class='tooltip-value'>" + branches[branchID].PhoneNumber + "</td>";
    str += "</tr>";
    str += "</table>";
    return str;
}
function makeKitBlock(kit, cls, selIcon)
{
    var tooltipStr = "";

    // Make The div block
    var d = $('<div>', { 'class': cls, 'id': kit.KitID, 'data-badge': '!'});
    d.prop("data", kit.BookingID);
    d.append($("<div>", {'class': 'kit-block-icon-div', 'data-badge': '!'}).append($('<p>', {'class': 'kit-block-icon ' + selIcon, 'data-badge': '!', title: '__KIT_DETAIL__'+kit.KitID}).html(" ")));

    var kitName = kit.KitTypeName + " - " + kit.KitName;
    if (kit.Specialized == "1")
    {
        kitName = kitName + " + " + kit.SpecializedName;
    }

    var t = $('<table>');
    d.append(t);

    // First row is kit name
    t.append($('<tr>', {'class': 'kit-block-name'}).html("<b>" + kitName + "</b>"));
    // the barcode below it.
    t.append($('<tr>', {'class': 'kit-block-contents'}).html(kit.BarcodeNumber));

    // Display the state information
    if (kit.KitState == "1")
    {
        if (kit.StartDate)
        {
            var startDate = new Date(kit.StartDate);
            var dateOptions = {weekday: "short",  month:"short", day:"numeric" };
            t.append($('<tr>', {'class': 'kit-block-book-date'}).html("Booked For: " + startDate.toLocaleDateString("en-US", dateOptions)));
            t.append($('<tr>', {'class': 'kit-block-state'}).append($("<td>").html("Going to: " + branches[kit.ForBranch].BranchID )));
        }
        else
        {
            t.append($('<tr>', {'class': 'kit-block-state'}).append($("<td>").html("Located at: " + branches[kit.AtBranch].BranchID )));
        }
    }
    else if (kit.KitState == "2")
    {
        t.append($('<tr>', {'class': 'kit-block-state'}).append($("<td>").html("In Transit")));
    }

    // Add action button
    if (selIcon == "sign-out")
    {
        // t.append($('<tr>', {'class': 'kit-shipping kit-block-activity', 'id': kit.KitID})
        d.append($("<div>", {'class': 'kit-shipping kit-block-activity', 'id': kit.KitID}).html("Ship Kit to<br/>" + branches[kit.ForBranch].BranchID));
        d.addClass("kit-shipping");
        tooltipStr = makeBranchTooltip(kit.ForBranch);
    }
    else if (selIcon == "sign-in")
    {
        d.append($('<div>', {'class': 'kit-receiving kit-block-activity', 'id': kit.KitID}).html("Receiving Kit"));
        d.addClass("kit-receiving");
        tooltipStr = makeBranchTooltip(kit.AtBranch);
    }
    else
    {
        d.append($('<div>', {'class': 'kit-booking kit-block-activity', 'id': kit.KitID}).html("Create Booking"));
        d.addClass("kit-booking");
    }

    // If we are in the shadow date, then we are priority flashing the kit.
    var shadowStart = new Date(kit.ShadowStartDate);
    var now = new Date();
    if (now >= shadowStart)
    {
        // d.addClass('pulse'); // cam Doesn't like blinking text!
        d.find("div.kit-block-icon-div").addClass('badge1');
    }

    d.prop("title", tooltipStr);
    return d;
}
function loadInventory()
{
    // Erase the storage rows.
    $(".kit-blocks.inventory").html("");
    $(".kit-blocks.pending").html("");

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
        $(sel).append(makeKitBlock(kit, selClass, selIcon));
    }
}
function loadBookings()
{
    $("#bookings-table").html("").append($("<tr>", {'class': 'header'})
    .append("<th class='type'>Type</th>")
    .append("<th class='name'>Name</th>")
    .append("<th class='event'>Event</th>")
    .append("<th class='booker'>Booker</th>")
    .append("<th class='branch'>Branch</th>")
    .append("<th class='booking-start-date'>Start Date</th>")
    .append("<th class='booking-end-date'>End Date</th>")

    );

    for (var i in bookings)
    {
        var booking = bookings[i];
        $("#bookings-table").append($("<tr>")
        .append("<td class='type' title='__KIT_DETAIL__"+booking.KitID+"'>"+kitTypes[booking.type].Name+"</td>")
        .append("<td class='name' title='__KIT_DETAIL__"+booking.KitID+"'>"+booking.Name+"</td>")
        .append("<td class='event'>"+booking.Event+"</td>")
        .append("<td class='booker'>"+booking.Booker+"</td>")
        .append("<td class='branch'>"+booking.Branch+"</td>")
        .append("<td class='booking-start-date'>"+booking["Start Date"]+"</td>")
        .append("<td class='booking-end-date'>"+booking["End Date"]+"</td>")
        )
    }

}
function doShipping()
{
    console.log("ship IT! " + this.data);
    url = "{{ route('ship_kit.findKit', array(':BOOKINGID')) }}";
    window.location = url.replace(':BOOKINGID', this.data);
}
function doReceiving()
{
    console.log("Receive IT! " + this.data);
    url = "{{ route('recieve_kit.findKit', array(':BOOKINGID')) }}";
    window.location = url.replace(':BOOKINGID', this.data);
}
function doBooking()
{
    console.log("Receive IT! " + this.id);
    window.location = "{{ route('book_kit.index', array('selected_id'=>'KITID')) }}".replace('KITID', this.id);
}
</script>
@stop


@section('content')

{{--check if user is logged on to determine what to display--}}
@if (Auth::check())
    <table cellpadding = 0 style="height:100%; width:100%;">
        <tr>
            <th class="home-table-headers">Pending Activity</th>
            <th class="home-table-headers">Kit Bookings</th>
        </tr>
        <tr>
            <td class="kit-blocks pending right-seperator"></td>
            <td>
                <table style="width:100%;height:100%;">
                    <tr>
                        <td>
                            <div class="bookings-table">
                                <table id="bookings-table" class="bookings-table">
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr><th class="home-table-headers">Branch Inventory</th></tr>
                    <tr style="width:100%; height:100%">
                        <td style="width:100%; height:50%;" class="kit-blocks inventory"></td>
                    </tr>
                </table>
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
        bookings = data.bookings;
        kitTypes = {};
        // convert the array of kit types into a associated array. 
        for(i in data.kitTypes)
        {
            kitTypes[data.kitTypes[i].ID] = data.kitTypes[i];
        }
        loadInventory();
        loadBookings();
        $("div.kit-block-activity.kit-shipping").button();
        $("div.kit-block-activity.kit-receiving").button();
        $("div.kit-block-activity.kit-booking").button();
        $("div.kit-shipping").click(doShipping);
        $("div.kit-receiving").click(doReceiving);
        $("div.kit-booking").click(doBooking);

        $(".kit-block.pulse").pulse({
            'background-color':'rgb(252, 133, 133)',
        },
        {
            duration : 3250,
            pulses   : -1,
            interval : 1500
        });
    });

});
</script>
@stop
