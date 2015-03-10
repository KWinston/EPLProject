@extends('layouts.master')

@section('head')
@stop

@section('content')
<div>
<h2> {{ $branch_name }} Kits Awaiting Reception</h2>

<table cellpadding = "0" class = "receive-table">
    <tr class = "receive-table-row">
        <th class = "receive-table-heading"> Booking ID</th>
        <th class = "receive-table-heading"> Kit Type</th>
        <th class = "receive-table-heading"> Notes</th>
        <th class = "receive-table-heading"> Current Location</th>
        <th class = "receive-table-heading"> Previous Destinations</th>
        <th class = "receive-table-heading"> Book Start</th>
        <th class = "receive-table-heading"> End Book</th>
        <th class = "receive-table-heading"> Status</th>
        <th class = "receive-table-heading"> Option</th>
    </tr>
    @foreach ($receiveKits as $receiveKit)
    <tr class = "receive-table-row">
        <td class = "receive-table-bookid">{{$receiveKit->ID}}</td>
        <td class = "receive-table-kittype">{{$receiveKit->Name}}</td> 
        <td class = "receive-table-purpose">{{$receiveKit->Purpose}}</td>
        <td class = "receive-table-location">{{$receiveKit->KitID}}</td>
        <td class = "receive-table-prevdests">{{$receiveKit->KitID}}</td>
        <td class = "receive-table-startdate">{{$receiveKit->StartDate}}</td>
        <td class = "receive-table-enddate">{{$receiveKit->EndDate}}</td>
        <td class = "receive-table-kitstatus">{{$receiveKit->StateName}}</td>
        <td class = "receive-table-confirm">{{ Form::submit('Verify') }}

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