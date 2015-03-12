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
        <p class='home-title'>Kits Arriving:</p>
            @foreach ($arrive_today as $kit)
                <div class="kit-block arriving" id="{{$kit->kit->ID}}" data="{{$kit->bookingID}}">
                    <p class="sign-in">{{$kit->ID}}</p>
                    <p class="kit-block-name">{{-- $kit->type->Name --}} - {{ $kit->Name }}
                        @if ($kit->Specialized)
                        + {{ $kit->SecializedName}}
                        @endif
                    </p>
                    <p class="kit-black-contents">Description: {{ $kit->KitDesc }}</p>
                    <p class="kit-black-state">Kit is currently: {{-- $kit->state->StateName--}}</p>
                    <p class="kit-black-state">Pending Activity: None</p>
                </div>
            @endforeach
    </div>

    <div class="branchInventory">
        <p class='home-title'>Kits Departing:</p>
            @foreach ($depart_today as $kit)
                <div class="kit-block departing" id="{{$kit->kit->ID}}" data="{{$kit->bookingID}}">
                    <p class="sign-out">{{$kit->ID}}</p>
                    <p class="kit-block-name">{{-- $kit->type->Name --}} - {{ $kit->Name }}
                        @if ($kit->Specialized)
                        + {{ $kit->SecializedName}}
                        @endif
                    </p>
                    <p class="kit-black-contents">Description: {{ $kit->KitDesc }}</p>
                    <p class="kit-black-state">Kit is currently: {{-- $kit->state->StateName--}}</p>
                    <p class="kit-black-state">Pending Activity: None</p>
                </div>
            @endforeach
    </div>

        {{--write function in controller to match branch name with number--}}
        <p class='home-title'>Kits Currently at {{ $branch_name }}:</p>
            @if ($kits == NULL)
                <p class="kit-no-inventory">There are currently no kits at this branch</p>
            @endif

            @foreach ($kits as $kit)
                <div class="kit-block storage" id="{{$kit->ID}}">
                    <p class="on-self">{{$kit->ID}}</p>
                    <p class="kit-block-name">{{-- $kit->type->Name --}} - {{ $kit->Name }}
                        @if ($kit->Specialized)
                        + {{ $kit->SecializedName}}
                        @endif
                    </p>
                    <p class="kit-black-contents">Description: {{ $kit->KitDesc }}</p>
                    <p class="kit-black-state">Kit is currently: {{-- $kit->state->StateName--}}</p>
                    <p class="kit-black-state">Pending Activity: None</p>
                </div>
            @endforeach

    </div>


@else {{--display page if user has not logged in --}}
    <h1 class='welcome-message'>Welcome to the EPL Kit Manager</h1>
@endif

<script type="text/javascript">
$(function()
{
    $(".kit-block.pulse").pulse({
        'background-color':'rgb(252, 133, 133)',
    },
    {
        duration : 3250,
        pulses   : -1,
        interval : 800
    });
    $(".kit-block.arriving").click(function()
    {
        console.log("arriving " + this.id);
        url = "{{ route('recieve_kit.findKit', array(':BOOKINGID')) }}";
        window.location = url.replace(':BOOKINGID', this.data);
    })
    $(".kit-block.departing").click(function()
    {
        console.log("Departing " + this.id);
        url = "{{ route('ship_kit.findKit', array(':BOOKINGID')) }}";
        window.location = url.replace(':BOOKINGID', this.data);
    })
    $(".kit-block.storage").click(function()
    {
        window.location = "{{ route('book_kit.index', array('selected_id'=>'KITID')) }}".replace('KITID', this.id);
    })
});
</script>
@stop
