@extends('layouts.helpMaster')
@section('topic')
<h2>Overview</h2>
<table>
	<tr>
	    <td style="width:70%;">
	    	<img style="width:100%;" src="images/help/receiveship.png"/>
	    </td>
	    <td>
	    	<ol>
		        <li>Receive/Ship Kit Menu</li>
		        <li>Choose Kit Operation</li>
		        <li>Kit Details</li>
		        <li>Kit Contents</li>
		        <li>Setting Damaged/Missing Items</li>
		        <li>Receive/Ship Kit Button</li>
		    </ol>
	    </td>
	</tr>
</table>
<br>
This screen is seperated into two panels. The left panel is used to select 
a kit to be processed for shipping or receiving. The right panel is a detailed kit view 
that loads and displays when you select a kit. Then, verify details in the right panel,
to easily receive or ship out kits. 

<h2> Receiving a Kit</h2>
<p>
On the left panel, click a kit under Receive Kit, [2], if there is a kit available that needs confirmation.
Booking and kit details will then load into the right panel. At the top near [3] in the picture above,
booking details such as the kit's name, description, status, destination, previous location, and previous booker.
If you need to check why the kit did not arrive at your branch, you should email the last booker to find out why.
</p>
<p>
Note: You can always confirm a kit whether it has been shipped out or not which updates its status to 'At Branch'.
</p>

<h2> Shipping a Kit</h2>
<p>
To ship a kit, it is really similar to receiving a kit. You click the kit in the left panel under the heading,
Send Kit, [2], if there is a kit that needs to be set to 'In Transit' status. The kit details will load on the right
side and you can proceed to ship the kit if there are no details you need to edit. 
</p>
<p>
Note: The heading under ship kit, 'In transit', lists kits you have shipped but have not had their
reception confirmed. If you would like to modify/view the kits details, click the kit, modify details
and then click the ship button again to save changes in the system.
</p>

<h2> Reviewing Kit Contents</h2>
<p>
Shown in [4] in the picture above, there is the kit's contents listing the item and relating serial number. You
can use this to quickly verify that your kit has all its contents and nothing is missing or damaged.
</p>

<h2> Dealing with Damaged/Missing Items</h2>
<p>
However, in the case of damaged or missing items, you can help keep this information in check. Shown in [5] in
the picture above, there are checkboxes for Missing and Damaged. If you would like to leave a note on the kit
contents, checkmark the corresponding box and write your message in the text fields to the right.
</p>

<h2> Confirming Details </h2>
<p>
When all looks good, click the Receive Kit/Send Kit button, [6], at the bottom of the right panel. 
</p>
@stop
