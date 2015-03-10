@extends('layouts.master')

@section('head')
@stop

@section('content')
<div>
<h2> Receiving Branch</h2>

<table cellpadding = "0" class = "receive-table">
    <tr class = "receive-table-row">
        <th class = "receive-table-heading"> Booking ID</th>
        <th class = "receive-table-heading"> Type of Kit</th>
        <th class = "receive-table-heading"> Location</th>
        <th class = "receive-table-heading"> Next Destination</th>
        <th class = "receive-table-heading"> Previous Destinations</th>
        <th class = "receive-table-heading"> Start of Booking</th>
        <th class = "receive-table-heading"> End of Booking</th>
        <th class = "receive-table-heading"> Purpose</th>
        <th class = "receive-table-heading"> Status</th>
        <th class = "receive-table-heading"> Option</th>
    </tr>
    @foreach ($receiveKits as $receiveKit)
    <tr class = "receive-table-row">
        <td class = "receive-table-bookid">{{$receiveKit->ID}}</td>
        <td class = "receive-table-kittype">{{$receiveKit->KitID}}</td> 
        <td class = "receive-table-location">{{$receiveKit->KitID}}</td>
        <td class = "receive-table-nextdest">{{$receiveKit->KitID}}</td>
        <td class = "receive-table-prevdests">{{$receiveKit->KitID}}</td>
        <td class = "receive-table-startdate">{{$receiveKit->StartDate}}</td>
        <td class = "receive-table-enddate">{{$receiveKit->EndDate}}</td>
        <td class = "receive-table-purpose">{{$receiveKit->Purpose}}</td>
        <td class = "receive-table-kitstatus">{{$receiveKit->KitID}}</td>
        <td class = "receive-table-confirm">{{ Form::submit('Verify') }}

        </tr>
    @endforeach
    </table>
</div>
<div class = "pagination">
{{ $receiveKits->links() }}
</div>
@stop