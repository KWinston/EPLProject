@extends('layouts.master')

@section('head')
@stop

@section('changeBranch')
    console.log(data);
    var json = { 'ID' : data };
    $.post("{{ URL::route('book_kit.get_shadow_days') }}", json)
        .success(function(resp){
            var data = JSON.parse(resp);
            addCalendarShadowDays(data.BranchInfo.HolidayClosures.HolidayClosure);
            console.log('shadow days added');
        })
        .fail(function(){
            console.log("error");
        });
@stop


@section('content')
<table cellpadding="0" style="height: 100%;" >
<<<<<<< HEAD
    <tr>
        <td style="vertical-align: top;">
            @include('components.comp_menu', array(
                'function' => 'homeMenuCallback'
            ))
        </td>
        <td style="padding: 5px 10px; vertical-align: top; text-align: center;">
            <p id="current_kit" style="font-size: 22px;">Select a Kit</p>
            <input type="hidden" id="current_kit_id">
            @include('components.comp_calendar', array(
                'updateMethod' => "",
                'insertMethod' => ""
            ))
        </td>
    </tr>
=======
	<tr>
		<td style="vertical-align: top;">
			@include('components.comp_menu', array(
				'json' => 
					'[{
					  id          : "string" // required
					  parent      : "string" // required
					  text        : "string" // node text
					  icon        : "string" // string for custom
					  state       : {
					    opened    : boolean  // is the node open
					    disabled  : boolean  // is the node disabled
					    selected  : boolean  // is the node selected
					  },
					  li_attr     : {}  // attributes for the generated LI node
					  a_attr      : {}  // attributes for the generated A node
					}]',
				'function' => 'homeMenuCallback'
		    ))
		</td>
		<td style="padding: 5px 10px; vertical-align: top; text-align: center;">
			<p id="current_kit" style="font-size: 22px;">Select a Kit</p>
			<input type="hidden" id="current_kit_id">
			@include('components.comp_calendar', array(
				'updateMethod' => "",
				'insertMethod' => ""
			))
		</td>
	</tr>
>>>>>>> origin/master
</table>

<script type="text/javascript">

    function homeMenuCallback(value)
    {
        $('#current_kit').text("Selected Kit is: " + value.text);
        $('#current_kit_id').val(value.id);
        setBookingKit(value.id, value.text);
        addCalendarKits([
            {
                kitId: 'id-test1',
                kitText: 'another different booking',
                start: new Date(2015, 01, 15),
                end: new Date(2015, 01, 20)
            },
            {
                kitId: 'id-test2',
                kitText: 'different booking',
                start: new Date(2015, 01, 21),
                end: new Date(2015, 01, 25)
            }
        ]);
    }

    $(document).ready(function() {
        setBookingKit(null, null);
    });
</script>
@stop
