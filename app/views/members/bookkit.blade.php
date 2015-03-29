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
            <div style="width: 100%">
                <img src="images/booking-legend.png" style="width: 100%; height; 50px;"/>
            </div>
        </td>
    </tr>
</table>


<script type="text/javascript">
    var getKitRepeater = null;  // interval timer

    function homeMenuCallback(kit) {
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
        if (RegExp('kit', 'i').test(kit.type)) {
            json = { 'ID' : kit.KitID };
            $.post("{{ URL::route('book_kit.get_kit_bookings') }}", json)
                .success(function(resp){
                    console.log(resp);
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
                    //console.log(resp);
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
            'Notifees'  : event.KitRecipients,
            'ShadowStartDate' : event.start.format('YYYY-MM-DD'),
            'ShadowEndDate'   : event.end.format('YYYY-MM-DD'),
            'ForBranch' : parseInt(event.ForBranch, 10),
            'Purpose'   : event.Purpose,
            'KitID'     : parseInt(event.KitID, 10)
        };

        console.log(json);

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
        console.log(event);
        var json = {
            'ID' : event.BookID,
            'StartDate' : startBooking,
            'EndDate'   : endBooking,
            'ShadowStartDate' : event.start.format('YYYY-MM-DD'),
            'ShadowEndDate'   : event.end.format('YYYY-MM-DD'),
            'ForBranch' : parseInt(event.ForBranch, 10),
            'Purpose'   : event.Purpose,
            'KitID'     : parseInt(event.KitID, 10),
            'Notifees'  : event.KitRecipients
        };
        console.log(json);

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
           'BookID': event.BookID
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

    function getDates(startDate, stopDate) {
        var dateArray = [];
        var currentDate = moment(startDate);
        var endDate = moment(stopDate)

        while (endDate.diff(currentDate, 'd') > 0) {
            dateArray.push(moment(currentDate.format('YYYY-MM-DD')));
            currentDate.add(1, 'd');
        }
        return dateArray;
    }

    function getIntersect(arr1, arr2) {
        var temp = [];
        for(var i = 0; i < arr1.length; i++){
            for(var k = 0; k < arr2.length; k++){
                if(arr1[i] == arr2[k]){
                    temp.push(arr1[i]);
                    break;
                }
            }
        }
        return temp;
    }

    function compareOverlapKitTypeBookings(bookings) {
        var bookingsByID = {};
        for (var index in bookings) {
            var start = new Date(bookings[index].ShadowStartDate);
            var end = new Date(bookings[index].ShadowEndDate);

            var range = getDates(start, end);

            if(bookingsByID[bookings[index].KitID] === undefined) {
                bookingsByID[bookings[index].KitID] = [];
            }

            for (var index2 in range) {
                bookingsByID[bookings[index].KitID].push(range[index2].format('YYYY-MM-DD'));
            }
        }
        

        for (var index in bookingsByID)
        {    
            var filtered = 
                bookingsByID[index].filter(function(item, i, ar){ return ar.indexOf(item) === i; });
            bookingsByID[index] = filtered.sort(function(r1, r2) {
                return r1.start > r2.start;
            });
        }
        console.log(bookingsByID);


        var firstRun = true;
        var intersectTypes;
        for (var index in bookingsByID) {
            if (firstRun) {
                intersectTypes = bookingsByID[index];
                firstRun = false;
            }
            else {
                intersectTypes = getIntersect(intersectTypes, bookingsByID[index]);
            }
        }

        console.log(intersectTypes);

        var ranges = [];
        var lastIndex = 0;
        for (var i = 0; i < intersectTypes.length - 1; i++) {
            var prev = moment(intersectTypes[i]);
            var next = moment(intersectTypes[i+1]);

            if (Math.abs(prev.diff(next, 'd')) > 1) {
                ranges.push({
                    'start': moment(intersectTypes[lastIndex] + " 00:00:00"), 
                    'end'  : moment(intersectTypes[i] + " 00:00:00").add(1, 'd')
                });
                lastIndex = i + 1;
            }   
        }
        if (lastIndex < intersectTypes.length - 1)
        {
            ranges.push({
                'start': moment(intersectTypes[lastIndex] + " 00:00:00"), 
                'end'  : moment(intersectTypes[intersectTypes.length - 1] + " 00:00:00").add(1, 'd')
            });
        }

        var kitTypeBookings = ranges.map(function(index) {
            return {
                'ShadowStartDate': index.start,
                'ShadowEndDate'  : index.end,
                'StartDate'      : index.start,
                'EndDate'        : index.end,
                'Name'           : bookings[0].Name,
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
