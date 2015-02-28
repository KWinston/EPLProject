@extends('layouts.master')

@section('head')
@stop

@section('changeBranch')
    addHolidays(data);
@stop


@section('content')
<table cellpadding="0" style="height: 100%;" >
    <tr>
        <td style="vertical-align: top;">
            @include('components.comp_menu', array(
                'function' => 'homeMenuCallback'
            ))
        </td>
        <td style="padding: 5px 10px; vertical-align: top; text-align: center;">
            <p id="current_kit" style="font-size: 22px;">Select a Kit</p>
            <input type="hidden" id="current_kit_id">
            @include('components.comp_calendar', array(
                'updateMethod' => "updateBooking",
                'insertMethod' => "insertBooking"
            ))
            <div id="bookingStatus">Booking: status</div>
        </td>
    </tr>
</table>


<script type="text/javascript">

    function homeMenuCallback(value)
    {
        $('#current_kit').text("Selected Kit is: " + value.text);
        setBookingKit(value);
        addCalendarKits([
            {
                kitId: 'id-test1',
                kitText: 'another different booking',
                kitAtBranch: 'CAL', 
                start: new Date(2015, 01, 15),
                end: new Date(2015, 01, 20)
            },
            {
                kitId: 'id-test2',
                kitText: 'different booking',
                kitAtBranch: 'CPL',
                start: new Date(2015, 01, 21),
                end: new Date(2015, 01, 25)
            }
        ]);
    }

    function setBookingFeedback(method) {
        $('#bookingStatus').html('Booking Status: ' + method);
                setTimeout(function(){
                    $('#bookingStatus').html('Booking Status: Awaiting');
                }, 2500);
    }

    function insertBooking(event)
    {
        var startBooking = moment(event.start).add(1, 'd').format('YYYY-MM-DD');
        var endBooking = moment(event.end).subtract(1, 'd').format('YYYY-MM-DD');

        var json = { 
            'StartDate' : startBooking,
            'EndDate'   : endBooking,
            'ShadowStartDate' : event.start.format('YYYY-MM-DD'),
            'ShadowEndDate'   : event.end.format('YYYY-MM-DD'),
            'ForBranch' : event.kitAtBranch, 
            'Purpose'   : event.kitText,
            'KitID'     : event.kitId
        };
        $.post("{{ URL::route('book_kit.insert_booking') }}", json)
            .success(function(resp){
                event['bookID'] = resp.insert_id;

                setBookingFeedback('Created');
            })
           .fail(function(){
                console.log("error on insert");
            });
    }

    function updateBooking(event)
    {
        var startBooking = moment(event.start).add(1, 'd').format('YYYY-MM-DD');
        var endBooking = moment(event.end).subtract(1, 'd').format('YYYY-MM-DD');

        var json = { 
            'ID' : event.bookID,
            'StartDate' : startBooking,
            'EndDate'   : endBooking,
            'ShadowStartDate' : event.start.format('YYYY-MM-DD'),
            'ShadowEndDate'   : event.end.format('YYYY-MM-DD'),
            'ForBranch' : event.kitAtBranch, 
            'Purpose'   : event.kitText,
            'KitID'     : event.kitId
        };
        $.post("{{ URL::route('book_kit.update_booking') }}", json)
            .success(function(resp){
                setBookingFeedback('Updated');
            })
           .fail(function(){
                console.log("error on update");
            });
    }

    function addHolidays(id){
        var json = { 'ID' : id };
        $.post("{{ URL::route('book_kit.get_shadow_days') }}", json)
            .success(function(resp){
                var data = JSON.parse(resp);
                addCalendarShadowDays(data.BranchInfo.HolidayClosures.HolidayClosure);
                console.log('shadow days added');
            })
            .fail(function(){
                console.log("error");
            });
    }

    $(document).ready(function() {
        @if(Session::has('branch')) 
            addHolidays({{Session::get('branch', '*')}});
        @endif
        setBookingKit(null);
    });
</script>
@stop
