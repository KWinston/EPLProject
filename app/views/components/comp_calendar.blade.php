{{ HTML::style("plugins/ashaw_2_2_7_calendar/fullcalendar.css") }}
{{ HTML::style("css/comp-calendar.css") }}

{{ HTML::script('plugins/ashaw_2_2_7_calendar/lib/moment.min.js', 
	array('type' => 'text/javascript')) }}
{{ HTML::script('plugins/ashaw_2_2_7_calendar/fullcalendar.js', 
	array('type' => 'text/javascript')) }}

<div id="booking_dialog">
	<p>Please indicate how many days you would like to book this kit. 
		You will pick which day to book after from this menu.</p>
	<input type="number" min="1" max="14" value="1" />
	<p class="days">Days</p>
</div>

<table style="border: 2px solid #aaa;">
	<tr>
		<td class="bookings">
			<div id="external-events">
				<input type="button" id="book_kit" value="Book Kit Time" />
				<hr/><p>Drag to Book</p><hr/>
			</div>
		</td>
		<td style="width: 79%; vertical-align: top;">
			<div id="calendar"></div>
		</td>
	</tr>
</table>

<script type="text/javascript">

	var _kitID = "";
	var _kitText = "";
	
	function setBookingKit(kitID, kitText) {
		if(kitID == null || kitText == null) {
			$('#book_kit').prop('disabled', true);
		}
		else {
			_kitID = kitID;
			_kitText = kitText;
			$('#calendar').fullCalendar('removeEvents');
			$('#book_kit').prop('disabled', false);
		}
	}

	function generateEventTitle(kitText, start, end) {
		var days = (end - start) / (1000 * 60 * 60 * 24);
		var title =  kitText + "\n Duration: " + days + " days";
		return title;	
	}

	function addCalendarEvents(events){
		// this needs work
		var kitObjects = [];
		for (var i in events) {
			var e = events[i];
			var title = generateEventTitle(e.kitText, e.start, e.end);
			kitObjects.push({
				kitText: e.kitText,
				kitId: e.kitId,
				title: title,
				allDay: true,
				stick: true,
				start: e.start,
				end: e.end,
				editable: false,		// not perminent
				overlap: false,
				borderColor: '#555',
				textColor: '#fff'
			});	
		}
		$('#calendar').fullCalendar('addEventSource', kitObjects);
	}

	function createBooking(kitID, kitText, days) {
		var created = $('<div/>',{
			'class': "fc-event ui-draggable ui-draggable-handle",
			'html':  kitText + '<br> Duration: ' + days + ' days',
			'style': 'background-color: #ccc; border-color: #555;' 
		});

		created.appendTo('#external-events').show('slow');

		created.data('event', {
			kitText: _kitText,
			kitId: _kitID,
			title: $.trim(created.html().replace("<br>", "\n")),
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

	function insertKitDB(event)
	{
		var target = "{{ $insertMethod }}";
		var fn = window[target];
		if(typeof fn === 'function')
			fn(event);
		else
			console.log("function not defined: " + target);
	}

	function updateKitDB(event)
	{
		var target = "{{ $updateMethod }}";
		var fn = window[target];
		if(typeof fn === 'function')
			fn(event);
		else
			console.log("function not defined: " + target);
	}

	$(document).ready(function() {
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
        	eventClick: function(event, jsEvent, view) {
        		alert('test popup');
        	},
        	eventMouseout: function(event, jsEvent, view) {
        	
        	},
        	droppable: true, 
			// internal changes (updates)
			eventDrop: function(event)
			{
				updateKitDB(event);
			},
			eventResize: function(event)
			{
				event.title = generateEventTitle(event.kitText, event.start, event.end);
				$('#calendar').fullCalendar('updateEvent', event);
				updateKitDB(event);
			},
			// external changes (insert)
			drop: function(date, jsEvent, ui) {
				console.log(date.toString()); 
				$(this).remove();					// remove dropped object
			},
			eventReceive: function(event) {
				insertKitDB(event);
			}			
    	});

    	$("#booking_dialog").dialog({
			'autoOpen': false,
			'title': "Duration of Booking",
		    'modal': true,
		    'draggable': true,
		    'show': "fade",
		    'buttons': [
			    {
			    	'text': "Okay",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
			    		$(this).dialog("close");
			    		var booking_days = $(this).find('input').val();
			    		createBooking(_kitID, _kitText, booking_days);
			    	}
			    }
		    ]
		});

    	$("#book_kit").click(function () {
    		$("#booking_dialog").dialog('open');
		});
	});
</script>