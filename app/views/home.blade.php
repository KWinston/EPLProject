@extends('layouts.master')
@section('head')
@stop


@section('content')

{{--check if user is logged on to determine what to display--}}
@if (Auth::check())
    {{-- identify the branch --}}
    {{-- use a for loop on each branch extracting out relavent kits based on their currently location --}}
    {{--populate div inventory with relevent data --}}
    <div class="branchInventory">

        {{--write function in controller to match branch name with number--}}
        <p class='home-title'>Kits Currently at {{ $branch_name }}:</p>
            @if ($kits == NULL)
                <p class="kit-no-inventory">There are currently no kits at this branch</p>
            @endif

            @foreach ($kits as $kit)
                <div class="kit-block">
                    <p class="kit-block-name">{{ $kit->type->Name }} - {{ $kit->Name }}
                        @if ($kit->Specialized)
                        + {{ $kit->SecializedName}}
                        @endif
                    </p>
                    <p class="kit-black-contents">Description: {{ $kit->KitDesc }}</p>
                    <p class="kit-black-state">Kit is currently: {{ $kit->state->StateName}}</p>
                    <p class="kit-black-state">Pending Activity: None</p>
                </div>
            @endforeach

    </div>

    <div class="branchInventory">
        <p class='home-title'>Kits Arriving:</p>
            @foreach ($arrivals as $arrival)
                <div class="kit-block">
                    <p class="arrival-kit">ID: {{ $arrival->ID }}</p>
                    <p class="arrival-ID">KitID: {{ $arrival->KitID}}</p>
                    <p class="arrival-forbranch">Execpted at: {{$arrival->ForBranch}}</p>
                    <p class="arrive-date">Expected by: {{ $arrival->StartDate }}</p>
                </div>
            @endforeach
    </div>
    <div class="branchInventory">
        <p class='home-title'>Kits Departing:</p>
            @foreach ($departures as $depart)
                <div class="kit-block">
                    <p class="depart-kit">ID: {{ $depart->ID}} </p>
                    <p class="depart-ID">KitID: {{ $depart->KitID}} </p>
                    <p class="depart-to">Going to: {{ $depart->ForBranch }}</p>
                    <p class="depart-date">Send out on: {{ $depart->$ShadowStartDate }}
                </div>
            @endforeach
    </div>    





@else {{--display page if user has not logged in --}}
    <h1 class='welcome-message'>Welcome to the EPL Kit Manager</h1>
@endif

@stop
