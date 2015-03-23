@extends('layouts.master')

@section('head')

@stop

@section('content')

<script type="text/javascript">
    function confirmReceive(theKitID, theForBranch) {

        var json = {
            'KitID'     : parseInt(theKitID, 10),
            'ForBranch' : parseInt(theForBranch, 10)
        };
        $.post("{{ URL::route('recieve_kit.confirmReceive') }}", json)
            .success(function(resp){
                setBookingFeedback('Kit #' + theKitID.toString() + ' Reception Confirmed');
                if (successCallback !== undefined) {
                    successCallback();
                }
            })
           .fail(function(){
                console.log("Error on kit confirmation");
                if (failureCallback !== undefined) {
                    failureCallback();
                }
            });
        $('#receiverecords').load(document.URL +  ' #receiverecords');
    };

    function setBookingFeedback(method) {
    $('#receiveStatus').html('System Status: ' + method);
    setTimeout(function(){
        $('#receiveStatus').html('System Status: Awaiting User Input');
    }, 2500);
}

</script>

<div id="receiverecords">
<h2> {{ $branch->Name }} Kits Awaiting Reception</h2>

<table cellpadding = "0" class = "receive-table">
    <tr class = "receive-table-row">
        <th class = "receive-table-bookid"> Book ID</th>
        <th class = "receive-table-kittype"> Kit Type</th>
        <th class = "receive-table-purpose"> Notes</th>
        <th class = "receive-table-forbranch"> For Branch</th>
        <th class = "receive-table-prevdests"> Last Location</th>
        <th class = "receive-table-startdate"> Book Start</th>
        <th class = "receive-table-enddate"> Book End</th>
        <th class = "receive-table-kitstatus"> Status</th>
        <th class = "receive-table-confirm"> Option</th>
    </tr>
    @foreach ($receiveKits as $receiveKit)
    <tr class = "receive-table-row">
        <td class = "receive-table-bookid"> {{ $receiveKit->BookingID }}</td>
        <td class = "receive-table-kittype"> {{ $receiveKit->Name }}</td>
        <td class = "receive-table-kitdesc" title="<p>{{ $receiveKit->KitDesc }}</p>"> {{ HTML::image('images/viewdetails.gif') }}</td>
        <td class = "receive-table-forbranch"> {{ $branch->Name }}</td>
        <td class = "receive-table-prevdest">{{ $receiveKit->BName }}</td>
        <td class = "receive-table-startdate"> {{ date("D d-F-Y",strtotime($receiveKit->StartDate)) }}</td>
        <td class = "receive-table-enddate"> {{ date("D d-F-Y",strtotime($receiveKit->EndDate)) }}</td>
        <td class = "receive-table-kitstatus"> {{ $receiveKit->StateName }}</td>
        <td class = "receive-table-confirm">
        @if ($receiveKit->AtBranch == $branch->ID)
            <p>Kit Already At Destination</p>
        @else
            <input type="button" onclick="confirmReceive('{{ $receiveKit->KitID }}' , '{{ Session::get('branch') }} ')" value="Confirm Kit #{{$receiveKit->KitID}} Received" /></td>
        @endif
        </tr>
    @endforeach
    </table>
</div>

<div class = "pagination">
@if (0 == (count($receiveKits)))
    No kits are booked for this branch at the moment.
@endif
{{ $receiveKits->links() }}
</div>
<div id="receiveStatus" style="font-size: 16px; width: 100%;
    background-color: #ddd; text-align: center;
    border: 2px solid #000;
    margin: 5px 0px 0px 0px; padding: 2px 0px;">
    System Status: Loaded Kits To Be Confirmed
</div>
@stop
