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
	
	function setBookingKit(value) {
		if(value == null) {
			$('#book_kit').prop('disabled', true);
		}
		else {
			console.log(value);
			var reg = RegExp('kit', 'i');
			if (reg.test(value.original.type)) {
				_kitID = value.original.id;
				_kitText = value.original.text;
				$('#book_kit').prop('disabled', false);
			}
			else {
				console.log('add code for type settings'); // to do
			}
		}
	}

	function generateEventTitle(kitText, start, end) {
		var days = (end - start) / (1000 * 60 * 60 * 24);
		var title =  kitText + "\n Duration: " + days + " days";
		return title;	
	}

	function setEventShadow(event, elem) {

		var width = $('#calendar').find('.fc-day-header').width();

		var startShadow = (width + 3).toString();
		var endShadow = (width + 3).toString();

		var css = [ 
			'; background-size:',
			startShadow + 'px 100%,',
			endShadow + 'px 100%;',
			$(elem).hasClass('fc-start') ? 
				'padding-left: ' + startShadow + 'px;' : 
				'padding-left: 0px;'
			,
			$(elem).hasClass('fc-end') ? 
				'padding-right: ' + endShadow + 'px;' : 
				'padding-right: 0px;'
		].join(' ');

		$(elem).attr('style', $(elem).attr('style') + css);
	}

	function addCalendarShadowDays(shadowDays) {
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

	function addCalendarKits(events) {
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

	var count = 0;
	function createBooking(kitID, kitText, days) {
		var borderColor = '#555';
		var backgroundColor = '#006B00';
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
			id: (count++).toString(),
			objID: 'kit',
			kitAtBranch: $('#branchMenu option:selected').text(), 
			kitText: _kitText,
			kitId: _kitID,
			kitNotes: '',
			title: $.trim(created.html().replace("<br>", "\n")),
			allDay: true,
			stick: true,
			className: 'shadow-day-effect',
			duration: { days: (2 + parseInt(days)), hours:0, minutes:0 },
			borderColor: borderColor,
			backgroundColor: backgroundColor
		});

		created.draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
	}

	function insertKitDB(event) {
		console.log('insert');
		var target = "{{ $insertMethod }}";
		var fn = window[target];
		if(typeof fn === 'function')
			fn(event);
		else
			console.log("function not defined: " + target);
	}

	function updateKitDB(event) {
		console.log('update');
		var target = "{{ $updateMethod }}";
		var fn = window[target];
		if(typeof fn === 'function')
			fn(event);
		else
			console.log("function not defined: " + target);
	}

	function adjustForShadowDays(event) {
		var startDayOrig = moment(event.start);
		var endDayOrig = moment(event.end);

		var startDay = moment(event.start);
		var endDay = moment(event.end).subtract(1, 'd'); // due to 00:00:00 dates posting as next

		// non-recieving start date 
		if (startDay.format('dddd') === "Sunday")
			startDay.subtract(2, 'd');

		else if (startDay.format('dddd') === "Saturday")
			startDay.subtract(1, 'd');

		// non-shipping end date 	
		if (endDay.format('dddd') === "Sunday")
			endDay.add(1, 'd');
		
		else if (endDay.format('dddd') === "Saturday")
			endDay.add(2, 'd');

		// verify against holidays and weekends
		for (var i in shadowObjects)
		{	
			var shadowDay = moment(shadowObjects[i].start);
			if (shadowDay.format('dddd') != 'Sunday' &&
				shadowDay.format('dddd') != 'Saturday') 
			{
				if (shadowDay.format('l') == startDay.format('l'))
					startDay.subtract(1, 'd');
				if (shadowDay.add(1, 'd').format('l') == endDay.format('l'))
					endDay.add(1, 'd');
			}
		}
		// compare to to kit current bookings
		endDay.add(1, 'd');
		var isConflict = false;
		for (var i in kitObjects)
		{
			var kit = kitObjects[i];

			if (endDay.diff(kit.start, 'd') > 0 && 
				endDay.diff(kit.end, 'd') < 0) {
				isConflict = true;
				break;
			}

			if (moment(kit.end).diff(startDay, 'd') > 0 && 
				moment(kit.start).diff(startDay, 'd') < 0) { 				
				isConflict = true;
				break;
			}
		}

		if (!isConflict)
		{
			var diffStart = startDay.diff(event.start, 'd');
			var diffEnd = endDay.diff(event.end, 'd');
			
			event.start.add(diffStart, 'd');
			event.end.add(diffEnd, 'd');
			event.title = generateEventTitle(event.kitText, event.start, event.end);
		}
		else
		{
			var diffStart = startDayOrig.diff(event.start, 'd');
			var diffEnd = endDayOrig.diff(event.end, 'd');

			event.start.add(diffStart, 'd');
			event.end.add(diffEnd, 'd');
			alert('an overlap with another kit has occurred, reverting');	
		}

		event.start.calendar();
		event.end.calendar();
		$('#calendar').fullCalendar('updateEvent', event);

		return !isConflict;
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
			windowResize: function(view) {
				$('#calendar').fullCalendar('rerenderEvents'); 
    		},
			eventOverlap: function(stillEvent, movingEvent) {
				return stillEvent.objID == 'holiday' && 
					movingEvent.objID == 'kit';
			},
    		fixedWeekCount: false,
        	eventClick: function(event, jsEvent, view) {
        		alert('test popup');
        	},
        	eventMouseover: function(event, jsEvent, view) {
        		var tooltip = [
        			'<div class="tooltipevent tool-tip">',
        			event.title,
        			'</div>'
        		].join('');

				$("body").append(tooltip);
				$(this).mouseover(function(e) {
			        $(this).css('z-index', 10000);
			        $('.tooltipevent').fadeIn('500');
			        $('.tooltipevent').fadeTo('10', 1.9);
				}).mousemove(function(e) {
			        $('.tooltipevent').css('top', e.pageY + 10);
			        $('.tooltipevent').css('left', e.pageX + 20);
				});
        	},
        	eventMouseout: function(event) {
        		$(this).css('z-index', 8);
    			$('.tooltipevent').remove();
        	},
        	droppable: true, 
			// internal changes (updates)
			eventDrop: function(event, delta, revertFunc)
			{
				if(adjustForShadowDays(event)) {
					updateKitDB(event);
				}
				else {
					revertFunc();
				}
			},
			eventResize: function(event)
			{
				var days = event.end.diff(event.start, 'd');
				if (days < 3)
					event.end.add(3 - days, 'd');

				if(adjustForShadowDays(event)) {
					updateKitDB(event);
				}
				else {
					revertFunc();
				}
			},
			// external changes (insert)
			drop: function(date, jsEvent, ui) {
				$(this).remove();					// remove dropped object
			},
			eventReceive: function(event) {
				if (adjustForShadowDays(event)) {
					insertKitDB(event);
				}
				else {
					$('#calendar').fullCalendar('removeEvents', event.id);
				}
			},
			eventAfterRender: function(event, element) {
				setEventShadow(event, element[0]);
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