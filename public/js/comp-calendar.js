var count = 0;
var _kitID = "";
var _kitText = "";
var shadowObjects;
var oldKitObjects;
var newKitObjects;

function setBookingKit(kitID, kitText, kitType) {
	if(kitID == null || kitType == null) {
		$('#book_kit').prop('disabled', true);
	}
	else {
		var reg = RegExp('kit', 'i');
		if (reg.test(kitType)) {
			_kitID = kitID;
			_kitText = kitText;
			$('#book_kit').prop('disabled', false);
		}
		else {
			console.log('add code for type settings'); // to do
		}
	}
}

function generateEventTitle(kitText, start, end) {
	var days = moment(end).diff(moment(start), 'd');
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

	if ($(elem).hasClass('shadow-day-effect'))
		$(elem).attr('style', $(elem).attr('style') + css);
}

function existsInNewBookings(booking) {
	for(var i in newKitObjects) {
		if (parseInt(booking.BookingID, 10) ===
			parseInt(newKitObjects[i].bookID, 10)) {
			return true;
		}
	}
	return false;
}

function checkScheduleConflicts(newKit, startDay, endDay, currentKits) {
	var isConflict = false;
	for (var i in currentKits)
	{
		var kit = currentKits[i];

		// determine if of same kit type or comparing to self
		if (parseInt(newKit.bookID, 10) !== parseInt(kit.bookID, 10) &&
			parseInt(newKit.kitId) === parseInt(kit.kitId)) {
			isConflict = checkEventsOverlap({
				'start': startDay,
				'end': endDay
			}, kit);
		}
		if (isConflict)
			break;
	}
	return isConflict;
}

function addCalendarShadowDays(shadowDays) {
	$('#calendar').fullCalendar('removeEventSource', shadowObjects);
	shadowObjects = [];
	for (var i in shadowDays) {
		var shadowDay = shadowDays[i];
		var today = moment(shadowDay.HolidayDate + " 00:00:00");
		var tomorrow = moment(today).add(1, 'd');
		var title = [
			shadowDay.HolidayName,
			"\n Stat Holiday"
			].join('');

		shadowObjects.push({
			objID: 'holiday',
			title: title,
			allDay: true,
			stick: true,
			start: today.format('YYYY-MM-DD'),
			end: tomorrow.format('YYYY-MM-DD'),
			editable: false,		// not perminent
			borderColor: '#555',
			backgroundColor: '#ccff00',
			textColor: '#000'
		});
	}
	$('#calendar').fullCalendar('addEventSource', shadowObjects);
}

function addCalendarKits(bookings, UserID) {
	// this needs work
	$('#calendar').fullCalendar('removeEventSource', oldKitObjects);
	oldKitObjects = [];
	for (var i in bookings) {
		var e = bookings[i];

		if (!existsInNewBookings(e)) {
			var title = generateEventTitle(e.Purpose,
				moment(e.StartDate), moment(e.EndDate));
			var creator = (e.UserID === UserID);

			oldKitObjects.push({
				bookID: e.BookingID,
				objID: 'other',
				objState: 'old',
				kitText: e.Purpose,
				kitId: e.KitID,
				title: title,
				kitForBranch: e.ForBranch,
				allDay: true,
				stick: true,
				start: moment(e.ShadowStartDate),
				end: moment(e.ShadowEndDate),
				editable: creator,
				className: 'shadow-day-effect',
				borderColor: '#555',
				backgroundColor: creator ? '#0033CC' :'#ccc',
				textColor: '#fff'
			});
		}
	}
	$('#calendar').fullCalendar('addEventSource', oldKitObjects);
}

function createBookingByDuration(kitID, kitText, forBranch, days) {
	var borderColor = '#555';
	var backgroundColor = '#006B00';
	var created = $('<div/>',{
		'kitid': kitID,			// val[0].value
		'kittext': kitText,		// val[1].value
		'kittype': 'kit',
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
		objState: 'new',
		kitForBranch: forBranch, 
		kitText: kitText,
		kitId: kitID,
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
		revertDuration: 0, //  original position after the drag,
		start: function(event, ui) {
			var target = "{{ $kitChange }}";
			var fn = window[target];
			if(typeof fn === 'function') {
				console.log(ui.helper[0].attributes);
				var val = ui.helper[0].attributes;
				fn(val[0].value, val[1].value, 'kit');
			}
			else
				console.log("function not defined: " + target);
		}
	});
}

function createBookingByDateRange(kitID, kitText, forBranch, startDay, endDay) {
	var borderColor = '#555';
	var backgroundColor = '#006B00';
	
	var start = moment(startDay);
	var end = moment(endDay).add(1, 'd');

	var days = moment(endDay).diff(start, 'd');

	var event = {
		id: (count++).toString(),
		objID: 'kit',
		objState: 'new',
		kitForBranch: forBranch, 
		kitText: kitText,
		kitId: kitID,
		kitNotes: '',
		title: kitText + '\n Duration: ' + days + ' days',
		allDay: true,
		stick: true,
		className: 'shadow-day-effect',
		start: start,
		end: end,
		borderColor: borderColor,
		backgroundColor: backgroundColor
	};
	
	var stat = adjustForShadowDays(event);
	if(stat.status) {
		event.start.add(stat.diffStart, 'd');
		event.end.add(stat.diffEnd, 'd');
		event.title = generateEventTitle(event.kitText,
			moment(event.start).add(1, 'd'), moment(event.end).subtract(1, 'd'));

		$('#calendar').fullCalendar('addEventSource', [event]);
	}
}

function insertKitDB(event) {
	var target = "{{ $insertMethod }}";
	var fn = window[target];
	if(typeof fn === 'function')
		fn(event);
	else
		console.log("function not defined: " + target);
}

function updateKitDB(event) {
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
	if (!checkScheduleConflicts(event, startDay, endDay, oldKitObjects) &&
		!checkScheduleConflicts(event, startDay, endDay, newKitObjects))
	{
		return {
			'diffStart': startDay.diff(event.start, 'd'),
			'diffEnd':   endDay.diff(event.end, 'd'), 
			'status':    true
		}
	}
	else
	{
		return {
			'diffStart': startDayOrig.diff(event.start, 'd'),
			'diffEnd':   endDayOrig.diff(event.end, 'd'), 
			'status':    false
		}
	}
}

function checkEventsOverlap(eventActive, eventInactive) {
	var activeStart = moment(
		eventActive.start.format('YYYY-MM-DD') + ' 00:00:00').add(1, 'd');
	var activeEnd	= moment(
		eventActive.end.format('YYYY-MM-DD') + ' 00:00:00').subtract(1, 'd');
	var inactiveStart = moment(
		eventInactive.start.format('YYYY-MM-DD')  + ' 00:00:00');
	var inactiveEnd	  = moment(
		eventInactive.end.format('YYYY-MM-DD') + ' 00:00:00');

	// encompassing events
	if (activeEnd > inactiveEnd && inactiveStart > activeStart) {
		return true;
	}
	else if (activeEnd < inactiveEnd && inactiveStart < activeStart) {
		return true;
	}

	// ends overlap
	if (activeEnd > inactiveEnd) {
		if (activeStart < inactiveEnd) { return true; }
	}
	else {
		if (inactiveStart < activeEnd) { return true; }
	}
	return false;
}

function getKitUpdates(event) {
	var target = "{{ $kitChange }}";
	var fn = window[target];
	if(typeof fn === 'function') {
		console.log(event);
		fn(event.kitId, event.kitText, 'kit', event.bookID);
	}
	else
		console.log("function not defined: " + target);
}

$(document).ready(function() {
	newKitObjects = [];

	$('#calendar').fullCalendar({
		defaultView: 'month',
		height: 450,
		header: {
			left: 'prev,next today',
			center: 'title'
		},
		editable: true,
		windowResize: function(view) {
			$('#calendar').fullCalendar('rerenderEvents');
		},
		eventOverlap: true,
		fixedWeekCount: false,
    	eventClick: function(event, jsEvent, view) {
    		if (RegExp('new', 'i').test(event.objState)) {
    			getKitUpdates(event);
    		}
    	},
    	eventDragStart: function(event, jsEvent, ui, view) {
    		if (RegExp('new', 'i').test(event.objState)) {
    			getKitUpdates(event);
    		}
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
		eventDrop: function(event, delta, revertFunc) {
			var stat = adjustForShadowDays(event);
			console.log(stat);
			if(stat.status) {
				event.start.add(stat.diffStart, 'd');
				event.end.add(stat.diffEnd, 'd');
				event.title = generateEventTitle(event.kitText,
					moment(event.start).add(1, 'd'), moment(event.end).subtract(1, 'd'));

				$('#calendar').fullCalendar('updateEvent', event);
				updateKitDB(event);
			}
			else {
				revertFunc();
			}
		},
		eventResize: function(event, delta, revertFunc) {
			var days = event.end.diff(event.start, 'd');
			if (days < 3)
				event.end.add(3 - days, 'd');

			var stat = adjustForShadowDays(event);
			console.log(stat);
			if(stat.status) {
				event.start.add(stat.diffStart, 'd');
				event.end.add(stat.diffEnd, 'd');
				event.title = generateEventTitle(event.kitText,
					moment(event.start).add(1, 'd'), moment(event.end).subtract(1, 'd'));

				$('#calendar').fullCalendar('updateEvent', event);
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
			var stat = adjustForShadowDays(event);
			if (stat.status) {
				event.start.add(stat.diffStart, 'd');
				event.end.add(stat.diffEnd, 'd');
				event.title = generateEventTitle(event.kitText,
					moment(event.start).add(1, 'd'), moment(event.end).subtract(1, 'd'));
				
				$('#calendar').fullCalendar('updateEvent', event);
				insertKitDB(event);
				newKitObjects.push(event);
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
		'title': "Create Booking",
	    'modal': true,
	    'draggable': true,
	    'show': "fade",
	    'width': 600,
	    'height': 600,
	    'buttons': [
		    {
		    	'text': "Okay",
		    	'icons': {
		    		'primary': ""
		    	},
		    	'click': function() {
		    		$(this).dialog("close");
		    		var method = $(this).find('#booking_method').accordion('option', 'active');
		    		
		    		if (method == 0) {
		    			var booking_days = $(this).find('#booking_duration').val();
		    			createBookingByDuration(_kitID, _kitText, 
		    				$('#branchMenu option:selected').val(), booking_days);
		    		}
		    		else if (method == 1) {
		    			var bookingStart = $(this).find('#start_date_picker').datepicker('getDate');
		    			var bookingEnd = $(this).find('#end_date_picker').datepicker('getDate');
		    		
		    			createBookingByDateRange(_kitID, _kitText, 
		    				$('#branchMenu option:selected').val(), bookingStart, bookingEnd);
		    		}
		    	}
		    }
	    ]
	});

	$("#book_kit").click(function () {
		$("#booking_dialog").dialog('open');
	});
});