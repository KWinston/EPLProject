@extends('layouts.master')
@section('head')

@stop

@section('content')
<table class="kit-status">
    <tr class="kit-status">
        <th class="kit-status kit-type">Kit Type</th>
        <th class="kit-status kit-name">Kit Name</th>
        <th class="kit-status branch-id">At Branch</th>
        <th class="kit-status kit-state">Kit State</th>
        <th class="kit-status start-date">Next Booking Starts</th>
        <th class="kit-status branch-name">Booked For </th>
        <th class="kit-status booking-count">Total Future Bookings</th>
    </tr>
    <!-- {{$breakKitType = null; }} -->

    @foreach($data as $row)
    <tr class="kit-status">
        @if($row->KitType != $breakKitType)
            <td class="kit-status kit-type" title="<p>{{$row->TypeDescription}}</p>">{{$row->KitType}}</td>
        @else
            <td class="kit-status kit-type"></td>
        @endif
        <td class="kit-status kit-name" title="<p>{{$row->KitDescription}}<p>">{{$row->KitName}}</td>
        <td class="kit-status branch-id" title="<p>{{$row->BranchName}}</p><br/><p>Phone: {{$row->BranchPhone}}</p>">{{$row->BranchID}}</td>
        <td class="kit-status kit-state">{{$row->KitState}}</td>
        @if(isset($row->StartDate))
            <td class="kit-status start-date" title="{{'<p>Booked By:' . $row->UserName . '</p><p>Email:' . $row->UserEmail . '</p>'}}">{{ date("D d-F-Y",strtotime($row->StartDate)) }}</td>
        @else
            <td class="kit-status start-date"></td>
        @endif
        <td class="kit-status branch-name"  title="<p>{{$row->ForBranchName}}</p><br/><p>Phone: {{$row->ForBranchPhone}}</p>">{{$row->ForBranchID}}</td>
        @if($row->BookingCount > 0)
            <td class="kit-status booking-count">{{$row->BookingCount}}</td>
        @else
            <td class="kit-status booking-count"></td>
        @endif

        <!-- {{$breakKitType = $row->KitType;}} -->
    </tr>
    @endforeach
</table>

@stop
