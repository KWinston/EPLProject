@extends('layouts.helpMaster')
@section('topic')
<h2>Overview</h2>
<table>
	<tr>
	    <td style="width:70%;">
	    	<img style="width:100%;" src="images/help/book-insert-1.png"/>
	    </td>
	    <td>
	    	<ol>
		        <li>Create Booking</li>
		        <li>Update Booking Details</li>
		        <li>Change Booking Time</li>
		    </ol>
	    </td>
	</tr>
</table>
<br>
This Screen is seperated into two seperate panels. The left panel is used to select 
a kit by type or specifically to make a booking for. The right panel is a calendar view of 
bookings that have already been made for a kit (coloured blue or silver) or the particular 
type of kit (shaded dark grey). Newly created kits (coloured green) will be shown until the
page is refreshed. Kit bookings can either be created, updated or have their 
times changed from this screen. 

<h2>Create Booking</h2>

<table>
	<tr>
	    <td style="width:60%;">
	    	<img style="width:100%;" src="images/help/book-insert-1.png"/></td>
	    <td>
		    Creating a Booking kit starts with selecting either a specific kit (i.e. Kit #2) or a 
		    kit type (i.e. iPad2). Upon selection a current list of bookings for the particular kit or 
		    type have been made. When you find an available time, click on the 'Book Kit Time' button
		    (bottom left corner).
	    </td>
	</tr>
		<tr>
	    <td style="width:60%;">
	    	<img style="width:100%;" src="images/help/book-insert-2.png"/></td>
	    <td>
	    	A dialog window will pop up on screen at this point. To finish creating a booking
	    	you will have to fill in the fields. These include:
	    	<ul>
	    		<li>Branch of Booking</li>
	    		<li>Start Date</li>
	    		<li>End Date</li>
	    		<li>Notifees (email recipients)</li>
	    	</ul>
	    </td>
	</tr>
	<tr>
	    <td colspan="2" style="padding: 10px 0px;">
	    	<h3 class="help-topic-cell">Booking Kit Dialog</h3>
	    	<table>
	    		<tr><td style="width: 32%;" align="left">
	    				<img style="width: 90%" src="images/help/book-insert-3.png"/>
	    			</td><td style="width: 32%;" align="center">
	    				<img style="width: 90%" src="images/help/book-insert-4.png"/>
	    			</td><td style="width: 32%;" align="right">
	    				<img style="width: 90%" src="images/help/book-insert-5.png"/>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>
	    				Branch of Booking is a clickable dropdown menu. You can use the 
	    				search box to filter down branches. Default branch selected is the 
	    				one assigned to the user logged in.
	    			</td>
	    			<td>
	    				Start Date and End Date are both textbox entry as well as a clickable
	    				popup calendar. The minimum date of booking is one day beyond current date.
	    				the maximum length of a booking is 2 weeks. Simply click the textbox then a
	    				date on the calendar popup to select the book time.
	    			</td>
	    			<td>
	    				The final field is used to add notification emails for people who may need to 
	    				know when a kit is to be shipped or recieved. Existing users in the system 
	    				will show up as options in a drop down menu (by typing either their email, 
	    				user name, or real name). Any people not in the user database can still be 
	    				notified by typing their full email address. Once a email or user has been 
	    				selected, clicking the 'Add' button will add it to the notify list. Any user 
	    				can be removed by clicking the X on right side of the email address.
	    			</td>
	    		</tr>
	    	</table>
	    	<br>
	    	Once all fields have been filled in, clicking the 'Okay' button will create the booking.
	    	The newly created booking will be shown as green with shadow days added to both start and 
	    	end date to allow for shipping.
	    </td>
	</tr>
</table>

<h2>Update Booking Details</h2>

<table>
	<tr>
	    <td style="width:60%;">
	    	<img style="width:100%;" src="images/help/book-edit-1.png"/></td>
	    <td>
		    Updating bookings can be done by selecting a kit from the left menu. In the calendar 
		    view, all the kits current bookings will be shown in either blue or grey. Blue bookings
		    can be edited as they are bookings made under your user profile. Grey bookings can 
		    not be edited as they are bookings made by other users. To edit booking details simply 
		    click on it. A dialog will then popup.
	    </td>
	</tr>
		<tr>
	    <td style="width:60%;">
	    	<img style="width:100%;" src="images/help/book-edit-2.png"/></td>
	    <td>
	    	In the dialog you will be able to edit the branch for booking as well as
	    	add or remove notification recieving users. Use of which can be found in the 
	    	Create Booking help section above. 
	    </td>
	</tr>
</table>

<h2>Change Booking Time</h2>

Changing a booking kit can be done by selecting a kit from the left menu. In the calendar 
view, all the kits current bookings will be shown in either blue or grey. Blue bookings
can be edited as they are bookings made under your user profile. You can drag a booking time to 
any open space where the kit is not already booked. You can also extend or shorten a booking time
by selecting the right edge of the event and dragging left or right. A booking must be atleast 3 
days (including shadows) and maximum 16 days (including shadows). Shadow days are allowed to overlap and
are readjusted if they overlap a weekend or holiday to allow for adequate shipping time. 
If an invalid booking date is made the booking will revert to the original time.


@stop
