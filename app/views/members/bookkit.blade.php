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
        <td style="vertical-align: top;" align="left">
            @include('components.comp_menu', array(
                'function' => 'homeMenuCallback',
                'side_menu_class' => 'button-bar-visible',
                'selectedNode' => $selected_id
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
    var getKitRepeater = null;  // interval timer

    function homeMenuCallback(kit) {
        console.log(kit);
        if(kit == null) {
            $('#book_kit').prop('disabled', true);
        }
        else {
            $('#current_kit').text("Selected Kit is: " + kit.text);
            $('#book_kit').prop('disabled', false);      
            setBookingKit(kit);

            getKitBookings(kit);
            clearInterval(getKitRepeater);
            getKitRepeater = setInterval(getKitBookings, 10000, kit);
        }
    }

    function getKitBookings(kit) {
        console.log('get kit bookings');
        if (RegExp('kit', 'i').test(kit.type)) {
                    json = { 'ID' : kit.KitID };
                    $.post("{{ URL::route('book_kit.get_kit_bookings') }}", json)
                        .success(function(resp){
                            addCalendarKits(resp, '{{ Auth::id(); }}');
                        })
                       .fail(function(){
                            console.log("error while getting kit bookings");
                        });
                }
                else {
                    json = { 'Type' : kit.KitTypeID };
                    $.post("{{ URL::route('book_kit.get_type_bookings') }}", json)
                        .success(function(resp) {
                            var kitOverlaps = compareOverlapKitTypeBookings(resp);
                            addCalendarKits(kitOverlaps);
                        })
                       .fail(function(){
                            console.log("error while getting kit type bookings");
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

    function compareOverlapKitTypeBookings(bookings)
    {

        var ranges = [];
        for (var index in bookings) {
            var start = new Date(bookings[index].ShadowStartDate).setHours(0);
            var end = new Date(bookings[index].ShadowEndDate).setHours(0);

            ranges.push(moment().range(start, end));
        }
        ranges.sort(function(r1, r2){ return r1.start > r2.start });

        // intersect ranges and check overlapping areas
        var intersectTypes = [];
        var intersectType = ranges.shift(); // init intersect check
        while(ranges.length > 0) {
            var compareType = ranges.shift();
            var overlap = false;
            while(compareType !== undefined && intersectType.overlaps(compareType)) 
            {
                overlap = true;
                intersectType = intersectType.intersect(compareType);
                compareType = ranges.shift();
            }
            if (overlap) {
                intersectTypes.push(intersectType);
                intersectType = compareType;
            }
        }

        var kitTypeBookings = intersectTypes.map(function(index) {
            return {
                'ShadowStartDate': index.start,
                'ShadowEndDate'  : index.end,
                'StartDate'      : index.start,
                'EndDate'        : index.end,
                'Purpose'        : bookings[0].Name,
                'UserID'         : '*',
                'BookingID'      : '*',
                'KitID'          : '*',
                'IsTypeKit'      : true
            };
        });

        return kitTypeBookings;
    }

    $(document).ready(function() {
        @if(Session::has('branch'))
            addHolidays("{{Session::get('branch', '*')}}");
        @endif

        homeMenuCallback(null);

        $("#book_kit").click(function() {
            openCreateBookingDialog();
        });
    });
</script>
@stop
