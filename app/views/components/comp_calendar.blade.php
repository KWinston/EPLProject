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
	var shadowObjects;
	var kitObjects;
	
	function setBookingKit(kitID, kitText) {
		if(kitID == null || kitText == null) {
			$('#book_kit').prop('disabled', true);
		}
		else {
			_kitID = kitID;
			_kitText = kitText;
			$('#book_kit').prop('disabled', false);
		}
	}

	function generateEventTitle(kitText, start, end) {
		var days = (end - start) / (1000 * 60 * 60 * 24);
		var title =  kitText + "\n Duration: " + days + " days";
		return title;	
	}

	function addCalendarShadowDays(shadowDays)
	{
		$('#calendar').fullCalendar('removeEventSource', shadowObjects);
		shadowObjects = [];
		for (var i in shadowDays) {
			var shadowDay = shadowDays[i];
			var today = new Date(shadowDay.HolidayDate);
			var tomorrow = new Date(today);
			tomorrow.setDate(today.getDate()+1);
			var title = [
				shadowDay.HolidayName,
				"\n Stat Holiday"
				].join('');

			shadowObjects.push({
				objID: 'holiday',
				title: title,
				allDay: true,
				stick: true,
				start: today,
				end: tomorrow,
				editable: false,		// not perminent
				borderColor: '#555',
				backgroundColor: '#000',
				textColor: '#fff'
			});	
		}
		$('#calendar').fullCalendar('addEventSource', shadowObjects);
	}

	function addCalendarKits(events){
		// this needs work
		$('#calendar').fullCalendar('removeEventSource', kitObjects);
		kitObjects = [];
		for (var i in events) {
			var e = events[i];
			var title = generateEventTitle(e.kitText, e.start, e.end);
			kitObjects.push({
				objID: 'other',
				kitText: e.kitText,
				kitId: e.kitId,
				title: title,
				allDay: true,
				stick: true,
				start: e.start,
				end: e.end,
				editable: false,	
				borderColor: '#555',
				backgroundColor: '#ccc',
				textColor: '#fff'
			});	
		}
		$('#calendar').fullCalendar('addEventSource', kitObjects);
	}

	function createBooking(kitID, kitText, days) {
		var borderColor = '#555';
		var backgroundColor = '#006699';
		var created = $('<div/>',{
			'class': "fc-event ui-draggable ui-draggable-handle",
			'html':  kitText + '<br> Duration: ' + days + ' days',
			'style': [
				'background-color: ' + backgroundColor + ';',
				'border-color: ' + borderColor + ';'
			].join('') 
		});

		created.appendTo('#external-events').show('slow');

		created.data('event', {
			objID: 'kit',
			kitText: _kitText,
			kitId: _kitID,
			title: $.trim(created.html().replace("<br>", "\n")),
			allDay: true,
			stick: true,
			duration: parseInt(days * 24).toString() + ":00:00",
			backgroundColor: backgroundColor,
			borderColor: borderColor
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
		console.log('insert');
		var target = "{{ $insertMethod }}";
		var fn = window[target];
		if(typeof fn === 'function')
			fn(event);
		else
			console.log("function not defined: " + target);
	}

	function updateKitDB(event)
	{
		console.log('update');
		var target = "{{ $updateMethod }}";
		var fn = window[target];
		if(typeof fn === 'function')
			fn(event);
		else
			console.log("function not defined: " + target);
	}

	function adjustForShadowDays(event) {
		// non-recieving start date 
		if (event.start.format('dddd') == 'Sunday')
			event.start.subtract(2, 'days').calendar();
		else if (event.start.format('dddd') == 'Saturday')
			event.start.subtract(1, 'days').calendar();

		// non-shipping end date 
		if (event.end.format('dddd') == 'Sunday')
			event.end.add(1, 'days').calendar();
		else if (event.end.format('dddd') == 'Saturday')
			event.end.add(2, 'days').calendar();

		for (var i in shadowObjects)
		{	
			var day = new Date(shadowObjects[i].start);
			if (day.toLocaleDateString() == new Date(event.start).toLocaleDateString())
				event.start.subtract(1, 'days').calendar();

			if (day.toLocaleDateString() == new Date(event.end).toLocaleDateString())
				event.end.add(1, 'days').calendar();
		}

		event.title = generateEventTitle(event.kitText, event.start, event.end);
		$('#calendar').fullCalendar('updateEvent', event);
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
			eventOverlap: function(stillEvent, movingEvent) {
				return stillEvent.objID == 'holiday' && 
					movingEvent.objID == 'kit';
			},
    		fixedWeekCount: false,
        	eventClick: function(event, jsEvent, view) {
        		alert('test popup');
        	},
        	eventMouseover: function(event, jsEvent, view) {
        		console.log(jsEvent);
        	},
        	droppable: true, 
			// internal changes (updates)
			eventDrop: function(event)
			{
				adjustForShadowDays(event);
				updateKitDB(event);
			},
			eventResize: function(event)
			{
				adjustForShadowDays(event);
				updateKitDB(event);
			},
			// external changes (insert)
			drop: function(date, jsEvent, ui) {
				$(this).remove();					// remove dropped object
			},
			eventReceive: function(event) {
				adjustForShadowDays(event);
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