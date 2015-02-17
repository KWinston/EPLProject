@extends('layouts.master')
@section('head')
@stop

@section('content')
<table cellpadding="0" style="height: 100%;" >
	<tr>
		<td style="vertical-align: top;">
			@include('components.comp_menu', array(
				'json' => 
					'[{
						"id"    : "#",
						"text"  : "root",
						"state" : {
							"opened" : false
						},
						"children" : [
							"test 1",
							{
								"id"    : "root2",
								"text"  : "root2",
								"state" : {
									"opened" : false,
									"disabled": true
								},
								"children" : [
									"test 1",
									"test 2"
								]
							}
						]
					}]',
				'function' => 'homeMenuCallback'
		    ))
		</td>
		<td style="padding: 5px 10px; vertical-align: top;">
			<p id="current_kit">Select a Kit</p>
			<input type="hidden" id="current_kit_id">
			@include('components.comp_calendar', array(
				'updateMethod' => "",
				'insertMethod' => ""
			))
		</td>
	</tr>
</table>

<script type="text/javascript">
	var current_kit_id = "";
	function homeMenuCallback(value)
	{
		console.log(value);
		$('#current_kit').text("Selected Kit is: " + value.text);
		$('#current_kit_id').val(value.id);
		setBookingKit(value.id, value.text);
	}

	$(document).ready(function() {
		setBookingKit(null, null);
	});
</script>
@stop
