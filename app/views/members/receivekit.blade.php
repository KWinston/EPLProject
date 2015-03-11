@extends('layouts.master')

@section('head')
@stop

@section('content')

<script>
/*
    function confirmReceive(event) {
        
    }
*/
    $(function() {
        $("#filter").click(function(){
        alert('clicked!');
        var json = {
            'ID' : event.bookID,
            'ForBranch' : parseInt(event.kitForBranch, 10),
            'AtBranch'   : event.ForBranch,
            'KitID'     : parseInt(event.kitId, 10)
        };
    });
});
</script>

<div>
<h2> {{ $branch_name }} Kits Awaiting Reception</h2>

<table cellpadding = "0" class = "receive-table">
    <tr class = "receive-table-row">
        <th class = "receive-table-bookid"> Book ID</th>
        <th class = "receive-table-kittype"> Kit Type</th>
        <th class = "receive-table-purpose"> Notes</th>
        <th class = "receive-table-location"> Current Location</th>
        <th class = "receive-table-prevdests"> Previous Location</th>
        <th class = "receive-table-startdate"> Book Start</th>
        <th class = "receive-table-enddate"> Book End</th>
        <th class = "receive-table-kitstatus"> Status</th>
        <th class = "receive-table-confirm"> Option</th>
    </tr>
    @foreach ($receiveKits as $receiveKit)
    <tr class = "receive-table-row">
        <td class = "receive-table-bookid"> {{$receiveKit->ID}}</td>
        <td class = "receive-table-kittype"> {{$receiveKit->Name}}</td> 
        <td class = "receive-table-kitdesc" title="<p>{{$receiveKit->KitDesc}}</p>"> {{ HTML::image('images/viewdetails.gif') }}</td>
        <td class = "receive-table-location"> {{$receiveKit->BName}}</td>
        <td class = "receive-table-prevdests">{{$receiveKit->KitID}}</td>
        <td class = "receive-table-startdate"> {{ date("D d-F-Y",strtotime($receiveKit->StartDate)) }}</td>
        <td class = "receive-table-enddate"> {{ date("D d-F-Y",strtotime($receiveKit->EndDate)) }}</td>
        <td class = "receive-table-kitstatus"> {{$receiveKit->StateName}}</td>
        <td class = "receive-table-confirm"><input type="button" id="filter" name="filter" value="Confirm Kit #{{$receiveKit->KitID}} Received" /></td>
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
@stop