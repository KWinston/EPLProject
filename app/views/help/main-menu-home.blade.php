@extends('layouts.helpMaster')
@section('topic')
<h2> Overview</h2>
The home screen shows a overview of the kits at your branch. <br>

<table>
<tr>
    <td><img src="images/help/main-screen.png"/></td>
    <td><ol>
        <li>Menu</li>
        <li>Outgoing kit(shipping)</li>
        <li>Tooltip when hovering over kit</li>
        <li>Incoming kit(receiving)</li>
        <li>Kits in inventory at this branch</li>
    </ol>
    </td>
</tr>
</table>
<br>
This screen is split into two main columns, "Pending Activity" and "Branch Inventory".
The "Pending Activity" shows kits that need attention from staff at the moment. Kits have two kinds of activities, either a kit is
coming into the branch(<a href="#" id="main-menu-receive">Receiving</a>), or it is being shipped to another
branch(<a href="#" id="main-menu-ship">Shipping</a>). Clicking on a kit will take you to the aproprate screen to perform
this operation.
<br/>
<h2> Pending Activity</h2>
<p>
    The Pending activity column lists the kits that need attention from the branch staff.
</p>
<p>
    Kits with a green background(2) are kits that are scheduled to be shipped out of this branch to another branch.
    In addition to the green background these kits are marked with the Outgoing Icon. While kits with a blue background and the
    Incoming Icon are kits that should be arriving soon at the branch.  When a kit inthis area is clicked the browser will display the
    appropriate screen for either receiving or shipping a kit.
</p>
<p>
    The background color of a kit denotes not only the type of activity that needs to be performed but the importance. When a kit is
    within the time that a new booking cannot come in and a booking is pending then the kit will display as activity needed. As a kit
    is booked with a shadow day to allow for shipping the kit to the destination. Once the date is within this shadow date then the
    kit will acquire a pulsing background color to indicate that it must be processed today.
</p>
<p>
    For pending activity kits the tool-tip that is displayed when the mouse is hovered over a kit presents contact information.
    For outgoing kits this is the branch that the kit is going to. For incoming kit this is the branch information for where the
    kit is coming from.
</p>

<h2> Branch Inventory</h2>
<p>
    This area lists all the kits that are in stock at this branch. They will have the Branch Inventory Icon and a white background.
    Clicking on these kits will take you to the booking screen to book this kit.
</p>
<h2> Icons</h2>
<table>
    <tr>
        <td style="vertical-align: middle;">Outgoing</td>
        <td><p class= "sign-out"/></td>
        <td style="vertical-align: middle;">Indicates a kit that is to be shipped out.
            Clicking this item will take you to the <a href="#" id="main-menu-ship">shipping screen</a>
            <br/> while the tool-tip provides details of the receiving branch.
        </td>
    </tr>
    <tr>
        <td style="vertical-align: middle;">Incoming</td>
        <td><p class= "sign-in"/></td>
        <td style="vertical-align: middle;">Indicates a kit that will be arriving at your branch.
            Clicking this will take you to the <a href="#" id="main-menu-receive">receiving screen</a></td>
            <br/> while the tool-tip provides details of the destination branch.
    </tr>
    <tr>
        <td style="vertical-align: middle;">Branch Inventory</td>
        <td><p class= "on-self"/></td>
        <td style="vertical-align: middle;">Indicates a Kit in stock at your branch.
            Clicking this item will take you to the <a href="#" id="main-menu-book"> booking screen</a> to allow you to create a booking for this item.
        </td>
    </tr>
</table>
<br/>

@stop
