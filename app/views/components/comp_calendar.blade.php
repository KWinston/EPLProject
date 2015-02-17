{{ HTML::style("plugins/ashaw_2_2_7_calendar/fullcalendar.css") }}
<style type="text/css">
.fc-event 
{
	margin: 2px 0px;
	height: 40px;
}

.bookings
{
	width: 20%; 
	vertical-align: top; 
	text-align: center;
	border-right: 2px solid #aaa; 
}

.bookings input[type="button"]
{
	width: 90%;
	height: 40px;
	border: 1px solid #000;
	box-shadow: none;
	color: white;
	background-color: #333;
	border-radius: 5px;
}

.bookings input[type="button"]:hover
{
	background-color: #666;
}

</style>

{{ HTML::script('plugins/ashaw_2_2_7_calendar/lib/moment.min.js', 
	array('type' => 'text/javascript')) }}
{{ HTML::script('plugins/ashaw_2_2_7_calendar/fullcalendar.js', 
	array('type' => 'text/javascript')) }}

<table style="border: 2px solid #aaa;">
	<tr>
		<td class="bookings">
			<div id="external-events">
				<input type="button" id="bookKit" value="Book Kit Time" 
					onclick="createBooking();" />
				<h4>Drag to Book</h4>
			</div>
		</td>
		<td style="width: 79%; vertical-align: top;">
			<div id="calendar"></div>
		</td>
	</tr>
</table>

<script type="text/javascript">

	function setEnabled(enabled)
	{
		$('#bookKit').prop('disabled', !enabled);
	}

	function createBooking(days)
	{
		var created = $('<div/>',{
			'class': "fc-event ui-draggable ui-draggable-handle",
			'text': 'My Event 1',
			'style': 'background-color: #ccc; border-color: #555;' 
		});

		created.appendTo('#external-events').show('slow');

		created.data('event', {
			title: $.trim(created.text()),
			allDay: true,
			stick: true,
			duration: parseInt(days * 24).toString() + ":00:00",
			backgroundColor: '#ccc',
			borderColor: '#555' 
		});

		created.draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
	}

	function addDays(date, days) {
    	var result = new Date(date);
    	result.setDate(date.getDate() + days);
    	return result;
	}

	$(document).ready(function() {
		var days = 5;
		$('#external-events .fc-event').each(function() {
			$(this).data('event', {
				title: $.trim($(this).text()),
				allDay: true,
				stick: true,
				duration: parseInt(days * 24).toString() + ":00:00" 
			});

			$(this).draggable({
				zIndex: 999,
				revert: true,      
				revertDuration: 0  
			});
		});

    	$('#calendar').fullCalendar({
    		defaultView: 'month',
    		height: 350,
    		header: {
				left: 'prev,next today',
				center: 'title'
			},
			editable: true,
			eventOverlap: false,
    		fixedWeekCount: false,
        	eventClick: function(calEvent, jsEvent, view) {
        	},
        	droppable: true, 
			drop: function(date, jsEvent, ui) {
				// add event to system via ajax,
				console.log(date.toString()); 
				$(this).remove();
			},
			eventRender: function(event, element){
				// update event in system via ajax,
				console.log(event.start.toString());
			} 
    	});
	});
</script>