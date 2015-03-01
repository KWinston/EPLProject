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
		<p>Kits Currently at {{ Session::get('branch') }}:</p>
				@foreach ($kits as $kit)
				@if($kit->AtBranch == Session::get('branch') )
				<div class="kitBlock">
					<p class="kitBlockName">Kit Type: $kitType</p>
					<p class="kitBlockId">Kit Id: $kitID</p>
					<p class="kitBlockSerialNumber">Kit Serial Number: $serialNumber</p>
					<p class="kitBlockRecieved">Last recieved: $date</p>
					<p class="kitBlockUser">Last booked by: $user</p>
				</div>
				@endif
				@endforeach
				
			{{--
			@else
				<p class="noInventory">There are currently no kits at this branch</p>
			@endif
			--}}			
	</div>

{{--display page if user has not logged in --}}
@else 
	<p>Showing all kits: </p>
	@foreach ($kits as $kit)
		<div class="kitBlock">
			<p class="kitBlockName">Type: {{ $kit->KitType }}</p>
			<p class="kitBlockId">Id: {{ $kit->ID }}</p>
			<p class="kitBlackContents">Description: {{ $kit->KitDesc }}</p>
			<p class="kitBlackState">Kit is currently: {{ $kit->KitState }}</p>
			<p class="kitBlockSerialNumber">Currently at: {{ $kit->AtBranch }}</p>
		</div>
	@endforeach


@endif

@stop
