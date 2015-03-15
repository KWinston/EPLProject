{{ HTML::style("plugins/ashaw_2_2_7_calendar/fullcalendar.css") }}
{{ HTML::style("css/comp-calendar.css") }}

{{ HTML::script('plugins/ashaw_2_2_7_calendar/lib/moment.min.js',
	array('type' => 'text/javascript')) }}
{{ HTML::script('plugins/ashaw_2_2_7_calendar/fullcalendar.js',
	array('type' => 'text/javascript')) }}
{{ HTML::script('js/moment-range.min.js',
	array('type' => 'text/javascript')) }}

<div id="booking_dialog">
	<table>
        <tr>
            <td colspan="3">
                <p>
                    Please indicate the start and end dates for your booking.
                    They will be adjusted for shadow days and added to the
                    booking calendar.
                </p>
            </td>
        </tr>
		<tr>
			<td >
				<label>Branch of Booking</label>
			</td>
			<td align="right" colspan="2">
				<select id="branch_booking" class="chosen-select" tabindex="2">
			    </select>
		    </td>
		</tr>
		<tr>
			<td align="center">
				<label>Start Date</label>
				<input type="text" id="start_date_picker">
			</td>
			<td align="center">
				<label>End Date</label>
				<input type="text" id="end_date_picker">
			</td>
            <td align="center" style="width: 10%;">
                <label class="days">Days</label><br/>
                <input type="number" id="booking_duration" min="1" max="14"
                    value="1" style="margin-bottom: 4px;" />
            </td>
        </tr>
        <tr>
        	<td colspan="3">
        		<label class="user-field-label">
        			People to inform about booking details
        		</label><br/>
        		<div style="margin: 5px 0px;">
        			<input id="booking_users_options" />
        			<input type="button" id="booking_add_user" value="Add" />
        		</div>
        		<div id="booking_users">
	        		<div id="booking_required" class="user-field required">
	        			<div class="user">{{ Auth::user()->username }}</div>
	        			<div class="email">{{ Auth::user()->email }}</div>
	        			<div class="realname">{{ Auth::user()->realname }}</div>
	        			<div class="imgbtn"><img src="css/images/lock_icon.png" /></div>
	        		</div>
        		</div>
        	</td>
        </tr>
	</table>
</div>

<div id="booking_information">
	<table>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
</div>

<div id="confirm_delete_dialog"></div>

<div id="calendar"></div>

<script type="text/javascript">
	var count = 0;
	var _kitID = "";
	var _kitText = "";
	var _isType = false;
	var shadowObjects;
	var oldKitObjects;
	var newKitObjects;

	function setBookingKit(kit) {
		var reg = RegExp('kit', 'i');
		if (reg.test(kit.type)) {
			_kitID = kit.KitID;	
			_isType = false;
		}
		else {
			_isType = true;
		}
		_kitTypeID = kit.KitTypeID;
		_kitText = kit.text;
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
		$('#calendar').fullCalendar('removeEventSource', oldKitObjects);
		oldKitObjects = [];

		for (var i in bookings) {
			var e = bookings[i];

			if (!existsInNewBookings(e)) {
				var title = generateEventTitle(
					e.Purpose, 
					moment(e.StartDate), 
					moment(e.EndDate)
				);
				var creator = (e.UserID === UserID);
				var isType = (e.IsTypeKit === true);

				console.log(e.Purpose);
				oldKitObjects.push({
					bookID: e.BookingID,
					objID		 : 'other',
					objState	 : 'old',
					isCreator	 : creator,
					isType 		 : isType,
					kitText 	 : e.Purpose,
					kitId 		 : e.KitID,
					title 		 : title,
					kitForBranch : e.ForBranch,
					allDay 		 : true,
					stick 		 : true,
					start 		 : moment(e.ShadowStartDate),
					end 		 : moment(e.ShadowEndDate),
					editable	 : creator,
					className	 : isType ? "" : 'shadow-day-effect',
					borderColor  : '#555',
					backgroundColor: 
						isType ? '#111' : creator ? '#0033CC' : '#ccc',
					textColor    : '#fff'
				});
			}
		}
		$('#calendar').fullCalendar('addEventSource', oldKitObjects);
	}

	function createBookingByDateRange(kitID, kitText, forBranch, startDay, endDay, recipients) {
		var borderColor = '#555';
		var backgroundColor = '#006B00';

		var start = moment(startDay).subtract(1, 'd'); 	// subtract 1 shadow
		var end = moment(endDay).add(2, 'd');			// add 1 shadow + offset

		var event = {
			id: (count++).toString(),
			objID: 'kit',
			objState: 'new',
			isCreator: true,
			bookID: '',
			kitRecipients: recipients,
			kitForBranch: forBranch,
			kitText: kitText,
			kitId: kitID,
			kitNotes: '',
			title: '',
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

			insertKitDB(event, function(id) {
                event.bookID = id;
			    newKitObjects.push(event);
			    $('#calendar').fullCalendar('addEventSource', [event]);
                $('#booking_dialog').dialog("close");
            }, function(){
            	console.log('error on insert');
            });
		}
	}

	function insertKitDB(event, successCallback, failureCallback) {
		var target = "{{ $insertMethod }}";
		var fn = window[target];
		if(typeof fn === 'function') {
			fn(event, successCallback, failureCallback);
		}
		else {
			if (failureCallback !== undefined | null) {
            	failureCallback();
			}
		}
	}

	function updateKitDB(event, successCallback, failureCallback) {
		var target = "{{ $updateMethod }}";
		var fn = window[target];
		if(typeof fn === 'function') {
			fn(event, successCallback, failureCallback);
        }
		else {
			if (failureCallback !== undefined | null) {
            	failureCallback();
			}
        }
	}

	function deleteKitDB(event, successCallback, failureCallback) {
		var target = "{{ $deleteMethod }}";
		var fn = window[target];
		if(typeof fn === 'function') {
			fn(event, successCallback, failureCallback);
        }
		else {
			if (failureCallback !== undefined | null) {
				failureCallback();
			}
        }
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
			fn(event);
		}
		else
			console.log("function not defined: " + target);
	}

    function openCreateBookingDialog() {
        $("#booking_dialog").dialog('open');
    }

	function confirmDeleteCallback() {
		var event = $('#booking_information').data.event;
		console.log(event);
        deleteKitDB(event, function() {
		    $('#calendar').fullCalendar('removeEvents', event._id);
            $('#calendar').fullCalendar('refetchEvents');
        });
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

	    		var buttons = $('#booking_information').dialog('option', 'buttons');
	    		console.log(buttons[0]);
	    		if(!event.isCreator) {
	    			$('#booking_information').dialog('widget')
	    				.find('.ui-dialog-buttonpane .ui-button:first').hide();
	    		}
	    		else {
	    			$('#booking_information').dialog('widget')
	    				.find('.ui-dialog-buttonpane .ui-button:first').show();
	    		}
	    		$('#' + buttons[0].id).attr("disabled", !event.isCreator);
	    		$("#booking_information").data.event = event;
	    		$("#booking_information").dialog('open');
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

					insertKitDB(event, function(id) {
                        event.bookID = id;
                        newKitObjects.push(event);
                        $('#calendar').fullCalendar('updateEvent', event);
                    });
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
		    'height': 480,
		    'buttons': [
			    {
			    	'text': "Okay",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
		    			var bookingStart = $(this).find('#start_date_picker').datepicker('getDate');
		    			var bookingEnd = $(this).find('#end_date_picker').datepicker('getDate');
		    			var forBranch = $('#branch_booking option:selected').val();
		    			var recipients = [];		    			

		    			$('#booking_users').find('.user-field.optional').each(function() {
		    				recipients.push(
		    					$(this).find('.email').html()
		    				);
		    				$(this).remove();
		    			});

		    			if (_isType)
		    			{
		    				var json = {
		    					'StartDate' : bookingStart,
		    					'EndDate'   : bookingEnd,
		    					'KitTypeID' : _kitTypeID
		    				};

			    			$.post("{{ URL::route('book_kit.get_available_kit') }}", json)
			                    .success(function(resp){			                        
			                        if (resp !== null) {
				                        createBookingByDateRange(
						    				resp.ID, 
						    				resp.Name, 
						    				forBranch, 
						    				bookingStart, 
						    				bookingEnd,
						    				recipients
						    			);
			                    	}	
			                    	else {
			                    		console.log('No kits available at this time');
			                    	}
			                    })
			                   .fail(function(){
			                        console.log("error on kit search");
			                    });
		                }
		                else {
			    			createBookingByDateRange(
			    				_kitID, 
			    				_kitText, 
			    				forBranch, 
			    				bookingStart, 
			    				bookingEnd,
			    				recipients
			    			);
			    		}
			    	}
			    }
		    ],
		    'open': function(event, ui) {
			        $('#branch_booking').val($('#branchMenu option:selected').val());
			        $('#branch_booking').trigger("chosen:updated");
		    }
		});

		$("#booking_information").dialog({
			'autoOpen': false,
			'title': "Booking Details",
		    'modal': true,
		    'draggable': true,
		    'show': "fade",
		    'width': 500,
		    'height': 300,
		    'buttons': [
			    {
			    	'text': "Delete Booking",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
			    		$(this).dialog("close");
			    		$("#confirm_delete_dialog").dialog('open');
			    	}
			    },
			    {
			    	'text': "Close",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
			    		$(this).dialog("close");
			    	}
			    }
		    ],
		    'open': function(event, ui) {
				var event = $(this).data.event;
				console.log(event);
		    }
		});

		$("#confirm_delete_dialog").dialog({
			'autoOpen': false,
			'title': "Confirm Deletion",
		    'modal': true,
		    'draggable': true,
		    'show': "fade",
		    'width': 250,
		    'height': 70,
		    'buttons': [
			    {
			    	'text': "Cancel",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
						$(this).dialog("close");
			    	}
			    },
			    {
			    	'text': "Confirm",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
			    		$(this).dialog("close");
			    		confirmDeleteCallback();
			    	}
			    }
		    ]
		});

		$("#branch_booking").load("{{ URL::route('master.branches') }}", function() {
		    for (var selector in config)
		    {
		        $(selector).chosen(config[selector]);
		        $(selector).chosen().on('change', function(e)
		        {
		            var json = { 'branch' : $(this).chosen().val() };
		            console.log(json);
		        });
		    }
		});

		$("#start_date_picker").datepicker({
			'showOtherMonths': true,
			'minDate': new Date(),
			'onSelect': function() {
				$("#end_date_picker").datepicker('option', 'minDate',
					new Date(moment($("#start_date_picker").datepicker('getDate')).format())
				);
				$("#end_date_picker").datepicker('option', 'maxDate',
					new Date(moment($("#start_date_picker").datepicker('getDate')).add(13, 'd').format())
				);
			}
		}).datepicker('setDate', new Date());

		$( "#end_date_picker" ).datepicker({
			'showOtherMonths': true,
			'onSelect': function() {
				var start = $("#start_date_picker").datepicker('getDate');
				var end = $("#end_date_picker").datepicker('getDate');
				var diff = moment(end).diff(start, 'd');
				$('#booking_duration').val(diff + 1);
			}
		}).datepicker('option', 'minDate',
			new Date(moment($("#start_date_picker").datepicker('getDate')).format())
		).datepicker('option', 'maxDate',
			new Date(moment($("#start_date_picker").datepicker('getDate')).add(13, 'd').format())
		);

		$('#booking_duration').on('change', function() {
			var days = $(this).val();
			var end = moment($("#start_date_picker").datepicker('getDate'))
				.add(days - 1, 'd');
			$("#end_date_picker").datepicker('setDate',
				new Date(end.format()));
		});

		var users = {{ User::select('username', 'email', 'realname')->get() }};

		$('#booking_users_options').autocomplete({
			'source': users.map(function(row) {
				return row.email + ' | '+ row.username + ' | ' + row.realname;
			})
		});

		$('#booking_add_user').button().click(function(){
			var userAdd = $('#booking_users_options').val();
			var userFields = userAdd.split(' | ');

			$('<div>', {
				'class' : 'user-field optional'
			}).append(
				$('<div>', {
					'class' : 'user'
				}).append(userFields[1])
			).append(
				$('<div>', {
					'class' : 'email'
				}).append(userFields[0])
			).append(
				$('<div>', {
					'class' : 'realname'
				}).append(userFields[2])
			).append(
				$('<div>', {
					'class' : 'imgbtn'
				}).append(
					$('<img>', {
						'src' : 'css/images/close_icon.png',
						'class' : 'remove'
					}).click(function() {
						$(this).parent().parent().remove();
					})
				)
			).appendTo('#booking_users');
		});

	});
</script>
