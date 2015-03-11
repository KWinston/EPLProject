@extends('layouts.master')

@section('head')
@stop

@section('content')

<script>
/*
    function confirmSent(event) {
        
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
<h2> {{ $branch_name }} Kits To Be Shipped</h2>

<table cellpadding = "0" class = "ship-table">
    <tr class = "ship-table-row">
        <th class = "ship-table-bookid"> Book ID</th>
        <th class = "ship-table-kittype"> Kit Type</th>
        <th class = "ship-table-purpose"> Notes</th>
        <th class = "ship-table-location"> Current Location</th>
        <th class = "ship-table-prevdests"> Previous Location</th>
        <th class = "ship-table-startdate"> Book Start</th>
        <th class = "ship-table-enddate"> Book End</th>
        <th class = "ship-table-kitstatus"> Status</th>
        <th class = "ship-table-confirm"> Option</th>
    </tr>
    @foreach ($shipKits as $shipKit)
    <tr class = "ship-table-row">
        <td class = "ship-table-bookid"> {{$shipKit->ID}}</td>
        <td class = "ship-table-kittype"> {{$shipKit->Name}}</td> 
        <td class = "ship-table-kitdesc" title="<p>{{$shipKit->KitDesc}}</p>"> {{ HTML::image('images/viewdetails.gif') }}</td>
        <td class = "ship-table-location"> {{$shipKit->BName}}</td>
        <td class = "ship-table-prevdests">{{$shipKit->KitID}}</td>
        <td class = "ship-table-startdate"> {{ date("D d-F-Y",strtotime($shipKit->StartDate)) }}</td>
        <td class = "ship-table-enddate"> {{ date("D d-F-Y",strtotime($shipKit->EndDate)) }}</td>
        <td class = "ship-table-kitstatus"> {{$shipKit->StateName}}</td>
        <td class = "ship-table-confirm"><input type="button" id="filter" name="filter" value="Confirm Kit #{{$shipKit->KitID}} Sent" /></td>
        </tr>
    @endforeach
    </table>        
</div>
 
<div class = "pagination">
@if (0 == (count($shipKits)))
    No kits to be shipped from this branch at the moment.
@endif
{{ $shipKits->links() }}
</div>
@stop