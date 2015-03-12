@extends('layouts.master')
     {{ HTML::style('css/bookkit.css') }}
@section('head')
@stop

@section('changeBranch')
    addHolidays(data);
@stop


@section('content')
<table cellpadding="0" style="height: 100%;" >
    <tr>
        <td style="vertical-align: top;" align="center">
            @include('components.comp_menu', array(
                'function' => 'homeMenuCallback',
                'side_menu_class' => 'button-bar-visible'
            ))
            <input type="button" id="book_kit" value="Book Kit Time" />
        </td>
        <td style="padding: 5px 10px; vertical-align: top; text-align: center;">
            <p id="current_kit" style="font-size: 18px; width: 100%;
                background-color: #ddd; text-align: center;
                border: 2px solid #000;
                margin: 0px 0px 5px 0px; padding: 4px 0px;">
            Select a Kit</p>
            <input type="hidden" id="current_kit_id">
            @include('components.comp_calendar', array(
                'updateMethod' => "updateBooking",
                'insertMethod' => "insertBooking",
                'deleteMethod' => "deleteBooking",
                'kitChange'    => "homeMenuCallback"
            ))
            <div id="bookingStatus" style="font-size: 16px; width: 100%;
                background-color: #ddd; text-align: center;
                border: 2px solid #000;
                margin: 5px 0px 0px 0px; padding: 2px 0px;">
                Booking: status
            </div>
        </td>
    </tr>
</table>


<script type="text/javascript">
    function homeMenuCallback(kitID, kitText, kitType, eventBookID) {
        //onsole.log(kitID + ', ' + kitText + ', ' +  kitType + ', ' + eventBookID);
        $('#current_kit').text("Selected Kit is: " + kitText);

        if (RegExp('kit', 'i').test(kitType)) {
            json = { 'ID' : kitID };
            setBookingKit(kitID, kitText, kitType);
            $.post("{{ URL::route('book_kit.get_kit_bookings') }}", json)
                .success(function(resp){
                    console.log("-------- Got bookings" + resp);
                    addCalendarKits(resp, '{{ Auth::id(); }}');
                })
               .fail(function(){
                    console.log("error on insert");
                });
        }
        else {
            json = { 'Type' : kitID };
            console.log(json);
            $.post("{{ URL::route('book_kit.get_type_bookings') }}", json)
                .success(function(resp){
                    console.log(resp);
                    //addCalendarKits(resp);
                })
               .fail(function(){
                    console.log("error on insert");
                });
        }
    }

    function setBookingFeedback(method) {
        $('#bookingStatus').html('Booking Status: ' + method);
        setTimeout(function(){
            $('#bookingStatus').html('Booking Status: Awaiting');
        }, 2500);
    }

    function insertBooking(event, successCallback, failureCallback) {
        var startBooking = moment(event.start).add(1, 'd').format('YYYY-MM-DD');
        var endBooking = moment(event.end).subtract(1, 'd').format('YYYY-MM-DD');

        var json = {
            'StartDate' : startBooking,
            'EndDate'   : endBooking,
            'Notifees'  : event.kitRecipients,
            'ShadowStartDate' : event.start.format('YYYY-MM-DD'),
            'ShadowEndDate'   : event.end.format('YYYY-MM-DD'),
            'ForBranch' : parseInt(event.kitForBranch, 10),
            'Purpose'   : event.kitText,
            'KitID'     : parseInt(event.kitId, 10)
        };

        $.post("{{ URL::route('book_kit.insert_booking') }}", json)
            .success(function(resp){  
                setBookingFeedback('Created');   
                if (successCallback !== undefined) {
                    successCallback(resp.insert_id);
                }
            })
           .fail(function(){
                console.log("error on insert");
                if (failureCallback !== undefined) {
                    failureCallback();
                }
            });
    }

    function updateBooking(event, successCallback, failureCallback) {
        var startBooking = moment(event.start).add(1, 'd').format('YYYY-MM-DD');
        var endBooking = moment(event.end).subtract(1, 'd').format('YYYY-MM-DD');

        var json = {
            'ID' : event.bookID,
            'StartDate' : startBooking,
            'EndDate'   : endBooking,
            'ShadowStartDate' : event.start.format('YYYY-MM-DD'),
            'ShadowEndDate'   : event.end.format('YYYY-MM-DD'),
            'ForBranch' : parseInt(event.kitForBranch, 10),
            'Purpose'   : event.kitText,
            'KitID'     : parseInt(event.kitId, 10)
        };
        $.post("{{ URL::route('book_kit.update_booking') }}", json)
            .success(function(resp){
                setBookingFeedback('Updated');         
                if (successCallback !== undefined) {
                    successCallback();
                }
            })
           .fail(function(){
                if (failureCallback !== undefined) {
                    failureCallback();
                }
            });
    }

    function deleteBooking(event, successCallback, failureCallback) {
        var json = {
           'BookID': event.bookID
        };

        $.post("{{ URL::route('book_kit.delete_booking') }}", json)
            .success(function(resp) {
                setBookingFeedback('Deleted');
                if (successCallback !== undefined) {
                    successCallback();
                }
            })
           .fail(function(){
                console.log("error on delete");
                if (failureCallback !== undefined) {
                    failureCallback();
                }
            });
    }

    function addHolidays(id) {
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
            addHolidays("{{Session::get('branch', '*')}}");
        @endif
        setBookingKit(null);

        $("#book_kit").click(function() {
            openCreateBookingDialog();
        });
    });
</script>
@stop
