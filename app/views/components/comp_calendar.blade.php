{{ HTML::style("plugins/ashaw_2_2_7_calendar/fullcalendar.css") }}
{{ HTML::style("css/comp-calendar.css") }}

{{ HTML::script('plugins/ashaw_2_2_7_calendar/lib/moment.min.js',
	array('type' => 'text/javascript')) }}
{{ HTML::script('plugins/ashaw_2_2_7_calendar/fullcalendar.js',
	array('type' => 'text/javascript')) }}
{{ HTML::script('js/moment-range.min.js',
	array('type' => 'text/javascript')) }}

<div id="booking_dialog" class="booking-dialog">
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
				<select id="branch_insert" class="chosen-select branch-booking" tabindex="2">
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
        			<input id="booking_users_options" class="booking-users-options" />
        			<input type="button" id="booking_add_user" value="Add" class="booking-users-button" />
        		</div>
        		<div id="booking_users" class="booking-users">
	        		<div id="booking_required" class="user-field required">
	        			<div class="user">{{ Auth::user()->username }}</div>
	        			<div class="email">{{ Auth::user()->email }}</div>
	        			<div class="realname">{{ Auth::user()->realname }}</div>
	        			<div class="imgbtn"><img src="css/images/lock_icon.png" /></div>
	        		</div>
        		</div>
        	</td>
        </tr>
        <tr>
        	<td>
        		<label>Purpose of Booking (optional)</label>
        	</td>
        	<td colspan="2" align="right">
        		<textarea id="booking_purpose" 
        			rows="3" cols="50" style="width: 95%;"></textarea>
        	</td>
       	</tr>
        <tr>
        	<td colspan="3">
        		<label id="booking_message"></label>
        	</td>
        </tr>
	</table>
</div>

<div id="booking_information" class="booking-dialog">
	<table>
		<tr>
            <td colspan="3">
                <p>
                    Update booking information. Add or remove users to inform.
                    Change branch for kit booking.
                </p>
            </td>
        </tr>
		<tr>
			<td>
				<label>Branch of Booking</label>
			</td>
			<td align="right" colspan="2">
				<select id="branch_update" class="chosen-select branch-booking" tabindex="2">
			    </select>
		    </td>
		</tr>
		<tr>
        	<td colspan="3">
        		<label class="user-field-label">
        			People to inform about booking details
        		</label><br/>
        		<div style="margin: 5px 0px;">
        			<input id="booking_users_update_options" class="booking-users-options" />
        			<input type="button" id="booking_add_update_user" value="Add" class="booking-users-button"/>
        		</div>
        		<div id="booking_update_users" class="booking-users">
	        		<div class="user-field required">
	        			<div class="user">{{ Auth::user()->username }}</div>
	        			<div class="email">{{ Auth::user()->email }}</div>
	        			<div class="realname">{{ Auth::user()->realname }}</div>
	        			<div class="imgbtn"><img src="css/images/lock_icon.png" /></div>
	        		</div>
        		</div>
        	</td>
		</tr>
		<tr>
        	<td>
        		<label>Purpose of Booking (optional)</label>
        	</td>
        	<td colspan="2" align="right">
        		<textarea id="booking_update_purpose" 
        			rows="3" cols="50" style="width: 95%;"></textarea>
        	</td>
       	</tr>
       	<tr>
        	<td colspan="3">
        		<label id="booking_update_message"></label>
        	</td>
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
	var users = {{ User::select('username', 'email', 'realname', 'id')->get() }};

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
			if (parseInt(booking.ID, 10) ===
				parseInt(newKitObjects[i].BookID, 10)) {
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
			if (parseInt(newKit.BookID, 10) !== parseInt(kit.BookID, 10) &&
				parseInt(newKit.KitID) === parseInt(kit.KitID)) {
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
				type: 'holiday',
				objState: 'shadow',
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
					e.Name,
					moment(e.StartDate),
					moment(e.EndDate)
				);
				var creator = (e.UserID === UserID);
				var isType = (e.IsTypeKit === true);
				oldKitObjects.push({
					BookID        : e.ID,
					type		  : 'other',
					objState	  : 'old',
					isCreator	  : creator,
					isType 		  : isType,
					text 	      : e.Name,
					KitID 		  : e.KitID,
					Purpose	      : e.Purpose,
					title 		  : title,
					ForBranch     : e.ForBranch,
					KitRecipients : e.KitRecipients,
					allDay 		  : true,
					stick 		  : true,
					start 		  : moment(e.ShadowStartDate),
					end 		  : moment(e.ShadowEndDate),
					editable	  : creator,
					className	  : isType ? "" : 'shadow-day-effect',
					borderColor   : '#555',
					backgroundColor:
						isType ? '#111' : creator ? '#0033CC' : '#ccc',
					textColor    : '#fff'
				});
			}
		}
		$('#calendar').fullCalendar('addEventSource', oldKitObjects);
	}

	function createBookingByDateRange(kitID, kitTypeID, kitText, forBranch, startDay, endDay, recipients, purpose) {
		var borderColor = '#555';
		var backgroundColor = '#006B00';

		var start = moment(startDay).subtract(1, 'd'); 	// subtract 1 shadow
		var end = moment(endDay).add(2, 'd');			// add 1 shadow + offset
		var event = {
			id 			  : (count++).toString(),
			type 		  : 'kit',
			objState 	  : 'new',
			isCreator 	  : true,
			BookID 		  : '',
			KitRecipients : recipients,
			ForBranch     : forBranch,
			Purpose       : purpose,
			text 		  : kitText,
			KitID 		  : kitID,
			KitTypeID 	  : kitTypeID,
			kitNotes 	  : '',
			title 	      : '',
			allDay        : true,
			stick 		  : true,
			className	  : 'shadow-day-effect',
			start         : start,
			end           : end,
			borderColor   : borderColor,
			backgroundColor: backgroundColor
		};

		var stat = adjustForShadowDays(event);
		if(stat.status) {
			event.start.add(stat.diffStart, 'd');
			event.end.add(stat.diffEnd, 'd');
			event.title = generateEventTitle(event.text,
				moment(event.start).add(1, 'd'), moment(event.end).subtract(1, 'd'));

			insertKitDB(event, function(id) {
                event.BookID = id;
                console.log(event);
			    newKitObjects.push(event);
			    $('#calendar').fullCalendar('addEventSource', [event]);
                $('#booking_dialog').dialog("close");
            }, function(){
            	console.log('error on insert');
            });
		}
		return stat.status;
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

		var change;
		do  {
			change = false;
			// verify against holidays and weekends
			for (var i in shadowObjects)
			{
				var shadowStart = moment(moment(shadowObjects[i].start).format("YYYY-MM-DD" + " 00:00:00"));
				var shadowEnd = moment(shadowStart).subtract(1, 'd');
				if (!RegExp("Sunday", "i").test(shadowStart.format('dddd')) &&
					!RegExp("Saturday", "i").test(shadowStart.format('dddd')))
				{
					if (shadowStart.diff(startDay, 'd') == 0) {
						startDay.subtract(1, 'd');
						change = true;
					}
					if (shadowEnd.diff(endDay, 'd') == 0) {
						endDay.add(1, 'd');
						change = true;
					}
				}
			}

			// check for weekends
			// non-recieving start date
			if (startDay.format('dddd') === "Sunday") {
				startDay.subtract(2, 'd');
				change = true;
			}

			else if (startDay.format('dddd') === "Saturday") {
				startDay.subtract(1, 'd');
				change = true;
			}

			// non-shipping end date
			if (endDay.format('dddd') === "Sunday") {
				endDay.add(1, 'd');
				change = true;
			}

			else if (endDay.format('dddd') === "Saturday") {
				endDay.add(2, 'd');
				change = true;
			}
		}
		while(change);
		

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

		var activeRange = moment().range(activeStart, activeEnd);
		var inactiveRange = moment().range(inactiveStart, inactiveEnd);

		return activeRange.overlaps(inactiveRange);
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

	function dialogMessage(id, text) {
		$(id).html(text);
		setTimeout(function(){
			$(id).html('');
		}, 2500);
	}

	function getRecipients(userFields) {
		var recipients = [];
		$(userFields).find('.user-field.optional').each(function() {
			var email = $(this).find('.email').html();
			var username = $(this).find('.user').html();
			var realname = $(this).find('.realname').html();

			var found = users.filter(function(user){
				return email === user.email;
			});
			if (found != null && found.length > 0)
			{
				recipients.push({
					'Email': found[0].email,
					'Username' : found[0].username,
					'Realname' : found[0].realname,
					'UserID'   : found[0].id
				});
			}
			else {
				recipients.push({
					'Email': email,
					'Username' : username,
					'Realname' : realname,
					'UserID'   : null
				});
			}
		});
		return recipients;
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

	    		if(event.BookID !== "*" && event.isCreator) {
		    		var buttons = $('#booking_information').dialog('option', 'buttons');
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
		    	}
	    	},
	    	eventDragStart: function(event, jsEvent, ui, view) {
	    		if (RegExp('new', 'i').test(event.objState)) {
	    			getKitUpdates(event);
	    		}
	    	},
	    	eventMouseover: function(event, jsEvent, view) {
	    		if (RegExp('shadow', 'i').test(event.objState) ||
	    			event.isType) {
	    			return;
	    		}
	    		$('.tooltip-event').fadeOut('250');
				$('.tooltip-event').remove();

				var url = "{{ route('kits.kitDetails', array('topic' => ':KitID')); }}";
	    		url = url.replace(':KitID', event.KitID);
	    		console.log(url);
                $.get(url, function(data){
                	var tooltip = $('<div>', {
                		'class' : "tooltip-event",
                		'style' : [
                			'width: 500px;',
                			'position: absolute;',
                			'top: 110px;',
                			'left: 5px;',
                			'z-index: 15000;',
                			'background-color: #fff;',
                			'border: 2px solid #333;',
                			'border-radius: 5px;',
                			'padding: 3px;'
                		].join(' ')
                	}).append(data);

                    $("body").append(tooltip);
		        	tooltip.fadeIn('500');
		        	tooltip.fadeTo('10', 1.9);
                });

                setTimeout(function(){
                	$('.tooltip-event').fadeOut('250');
					$('.tooltip-event').remove();
                }, 5000);
	    	},
	    	eventMouseout: function(event) {
	    		$(this).css('z-index', 8);
	    		$('.tooltip-event').fadeOut('250');
				$('.tooltip-event').remove();
	    	},
	    	droppable: true,
			// internal changes (updates)
			eventDrop: function(event, delta, revertFunc) {
				if (event.start.diff(moment(), 'd') < 1) {
					revertFunc();
				}
				else {
					var stat = adjustForShadowDays(event);
					if(stat.status) {
						event.start.add(stat.diffStart, 'd');
						event.end.add(stat.diffEnd, 'd');
						event.title = generateEventTitle(event.text,
							moment(event.start).add(1, 'd'), moment(event.end).subtract(1, 'd'));

						$('#calendar').fullCalendar('updateEvent', event);
						updateKitDB(event);
					}
					else {
						revertFunc();
					}
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
					event.title = generateEventTitle(event.text,
						moment(event.start).add(1, 'd'), moment(event.end).subtract(1, 'd'));

					$('#calendar').fullCalendar('updateEvent', event);
					updateKitDB(event);
				}
				else {
					revertFunc();
				}
			},
			/*// external changes (insert)
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
			},*/
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
		    'hide': "fade",
		    'width': 600,
		    'height': 550,
		    'buttons': [
			    {
			    	'text': "Book Kit",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
		    			var bookingStart = $(this).find('#start_date_picker').datepicker('getDate');
		    			var bookingEnd = $(this).find('#end_date_picker').datepicker('getDate');
		    			var forBranch = $('#branch_insert option:selected').val();
		    			var recipients = getRecipients('#booking_users');
		    			var purpose = $(this).find('#booking_purpose').val();

		    			if (_isType)
		    			{
		    				var json = {
		    					'StartDate' : moment(bookingStart).format('YYYY-MM-DD'),
		    					'EndDate'   : moment(bookingEnd).format('YYYY-MM-DD'),
		    					'KitTypeID' : _kitTypeID
		    				};

			    			$.post("{{ URL::route('book_kit.get_available_kit') }}", json)
			                    .success(function(resp){
			                    	//console.log(resp);
			                        if (resp == "" ||
				                        !createBookingByDateRange(
						    				resp.ID,
						    				_kitTypeID,
						    				_kitText,
						    				forBranch,
						    				moment(bookingStart).format('YYYY-MM-DD'),
						    				moment(bookingEnd).format('YYYY-MM-DD'),
						    				recipients, 
						    				purpose
						    			)) {
			                    		dialogMessage('#booking_message', 'No kit available at this time');
			                    		console.log('No kits available at this time');
			                    	}
			                    	else {
			                    		$('#booking_users').find('.user-field.optional').each(function() {
						    				$(this).remove();
						    			});
			                    	}
			                    })
			                   .fail(function(){
			                        console.log("error on kit search");
			                    });
		                }
		                else {
			    			if (!createBookingByDateRange(
			    				_kitID,
			    				_kitTypeID,
			    				_kitText,
			    				forBranch,
			    				bookingStart,
			    				bookingEnd,
			    				recipients,
			    				purpose
			    			)) {
			    				dialogMessage('#booking_message', 'This kit is not available at this time');
			    			}
			    			else {
			    				$('#booking_users').find('.user-field.optional').each(function() {
		    				$(this).remove();
		    			});
			    			}
			    		}
			    	}
			    }
		    ],
		    'open': function(event, ui) {
			        $('#branch_insert').val($('#branchMenu option:selected').val());
			        $('#branch_insert').trigger("chosen:updated");
		    }
		});

		$("#booking_information").dialog({
			'autoOpen': false,
			'title': "Booking Details",
		    'modal': true,
		    'draggable': true,
		    'show': "fade",
		    'hide': "fade",
		    'width': 600,
		    'height': 500,
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
			    	'text': "Save Changes",
			    	'icons': {
			    		'primary': ""
			    	},
			    	'click': function() {
			    		var event = $(this).data.event;

			    		event.ForBranch = $('#branch_update').val();
			    		var recipients = getRecipients('#booking_update_users');
			    		event.KitRecipients = recipients;
			    		event.Purpose = $('#booking_update_purpose').val();
			    		console.log(event);
			    		updateKitDB(event, function(){
			    			var kit = oldKitObjects.filter(function(e){
			    				return parseInt(e.BookID, 10) === parseInt(event.BookID, 10);
			    			});
			    			kit.KitRecipients = recipients;
			    			$('#booking_users_update_options').val('');

			    			$('#booking_update_users').find('.user-field.optional').each(function() {
		    					$(this).remove();
		    				});
		    				$("#booking_information").dialog("close");
			    		});
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
				$('#branch_update').val(event.ForBranch);
			    $('#branch_update').trigger("chosen:updated");

			    $('#booking_update_users').find('.user-field.optional').each(function() {
    				$(this).remove();
    			});

			    for (var index in event.KitRecipients) {
			    	var recipient = event.KitRecipients[index];
			    	if (recipient.UserID != null || recipient.UserID !== "")
			    	{
			    		var found = users.filter(function(user) {
			    			return parseInt(user.id, 10) === parseInt(recipient.UserID, 10);
			    		});
			    		if (found != null && found.length > 0) {
				    		createUserField(found[0].username, found[0].email, found[0].realname)
				    			.appendTo('#booking_update_users');
			    		}
			    		else {
			    			createUserField(recipient.Username, recipient.Email, recipient.Realname)
			    				.appendTo('#booking_update_users');
			    		}
			    	}
			    	else {
			    		createUserField(recipient.Username, recipient.Email, recipient.Realname)
			    			.appendTo('#booking_update_users');
		    		}
			    }
			    $('#booking_update_purpose').val(event.Purpose);
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

		$(".branch-booking").load("{{ URL::route('master.branches') }}", function() {
		});

		$("#start_date_picker").datepicker({
			'showOtherMonths': true,
			'minDate': new Date(moment().add(1, 'd').format('YYYY-MM-DD')),
			'onSelect': function() {
				$("#end_date_picker").datepicker('option', 'minDate',
					new Date(moment($("#start_date_picker").datepicker('getDate')).format())
				);
				$("#end_date_picker").datepicker('option', 'maxDate',
					new Date(moment($("#start_date_picker").datepicker('getDate')).add(13, 'd').format())
				);

				$('#booking_duration').val(1);
				$("#end_date_picker").datepicker('setDate', $("#start_date_picker").datepicker('getDate'));
			}
		}).datepicker('setDate', new Date().setDate(new Date().getDate() + 1));

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
		).datepicker('setDate', new Date().setDate(new Date().getDate() + 1));

		$('#booking_duration').on('change', function() {
			var days = $(this).val();
			var end = moment($("#start_date_picker").datepicker('getDate'))
				.add(days - 1, 'd');
			$("#end_date_picker").datepicker('setDate',
				new Date(end.format()));
		});

		$('.booking-users-options').autocomplete({
			'source': users.map(function(row) {
				return row.email + ' | '+ row.username + ' | ' + row.realname;
			})
		});

		$('#booking_add_user').button().click(function() {
			var userAdd = $('#booking_users_options').val();
			if (userAdd.length > 0) {
				var userFields = userAdd.split(' | ');
				createUserField(userFields[1], userFields[0], userFields[2])
					.appendTo('#booking_users');
			}
			else {
				dialogMessage('#booking_message', 'Please fill in user information or email');
			}
		});

		$('#booking_add_update_user').button().click(function() {
			var userAdd = $('#booking_users_update_options').val();
			if (userAdd.length > 0) {
				var userFields = userAdd.split(' | ');
				createUserField(userFields[1], userFields[0], userFields[2])
					.appendTo('#booking_update_users');
			}
			else {
				dialogMessage('#booking_update_message', 'Please fill in user information or email');
			}
		});
	});

	function createUserField(username, email, realname)
	{
		return $('<div>', {
			'class' : 'user-field optional'
		}).append(
			$('<div>', {
				'class' : 'user'
			}).append(username)
		).append(
			$('<div>', {
				'class' : 'email'
			}).append(email)
		).append(
			$('<div>', {
				'class' : 'realname'
			}).append(realname)
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
		);
	}
</script>
