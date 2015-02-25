@extends('layouts.master')
@section('head')
@stop




@section('content')

{{--check if user is logged o
	n to determine what to display--}}
@if (Auth::check())
	{{-- identify the branch --}}
	{{-- use a for loop on each branch extracting out relavent kits based on their currently location --}}
	{{--populate div inventory with relevent data --}}
	<div class="branchInventory">

		{{--write function in controller to match branch name with number--}}
		<p>Kits Currently at $Branch {{ Session::get('branch') }}</p>
		
		{{--
		@foreach ($logTypes as $logType)
			{{ $logType->Name }}


			@if ($kit.branch == {{Session::get('branch')}})

			<div class="kitBlock">
				<p class="kitBlockName">Kit Type: $kitType</p>
				<p class="kitBlockId">Kit Id: $kitID</p>
				<p class="kitBlockSerialNumber">Kit Serial Number: $serialNumber</p>
				<p class="kitBlockRecieved">Last recieved: $date</p>
				<p class="kitBlockUser">Last booked by: $user</p>
			</div>

			@else
				<p class="noInventory">There are currently no kits at this branch</p>
			
			@endif
		@endforeach
		--}}		
			


		{{-- Remove this section once foreach loop works --}}
		<div class="kitBlock">
			<p class="kitBlockName">Kit Type: $kitType</p>
			<p class="kitBlockId">Kit Id: $kitID</p>
			<p class="kitBlockSerialNumber">Kit Serial Number: $serialNumber</p>
			<p class="kitBlockRecieved">Last recieved: $date</p>
			<p class="kitBlockUser">Last booked by: $user</p>
		</div>


	</div>

{{--display page if user has not logged in --}}
@else 
	<p>You have not logged in yet.</p>
@endif

@stop
