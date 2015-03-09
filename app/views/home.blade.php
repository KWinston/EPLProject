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
        <p class='inventory-title'>Kits Currently at {{ $branch_name }}:</p>
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

@else {{--display page if user has not logged in --}}
    <h1 class='welcome-message'>Welcome to the EPL Kit Manager</h1>
@endif

@stop
