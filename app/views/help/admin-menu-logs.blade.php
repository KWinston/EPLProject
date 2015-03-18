@extends('layouts.helpMaster')
@section('topic')
<h2> Overview</h2>


<table>
<tr>
    <td style="width:70%;"><img style="width:100%;" src="images/help/logs-screen.png"/></td>
    <td><ol>
        <li>Kit Search Box</li>
        <li>Kit Types</li>
        <li>Kits</li>
        <li>Log Filters & refresh</li>
        <li>Log Details</li>
        <li>Kit Quick controls (when kit selected)</li>
    </ol>
    </td>
</tr>
</table>
<br>
<p>
    The kit logs page allows for a administrator to see what activity has been occurring for either a specific kit, or a
    type of kits.  The logs are keyed on the kit Type, kit, and kit component.
</p>
<p>
    The logging in the system happens automatically as various operations are preformed. For example creating a new kit will
    generate several log entries. The first will be the Kit Created message, followed by Kit Contents added log messages.

</p>
<p>
    When editing kits and contents, the log message will show what a attribute was changes: from -> to.
    Each log message will record the user who performed the operation.

</p>
<h2> Filtering</h2>
<p>
    The first level of filtering is performed in the tree on the left(2) when a kit type or kit is selected. The logs will filter
    to display only records for that kit type, or kit. Next are the individual log message filters (4) which allows for the
    displaying of only specific types of messages. Handy buttons for selecting all/none and refreshing are located to the right(4).
</p>
<table class="help-definition-table">
    <tr>
        <td>Damage Report</td>          <td>A component of a kit has been reported damaged.</td>
    </tr><tr>
        <td>Missing Report</td>         <td>A component of a kit has been reported missing.</td>
    </tr><tr>
        <td>Note</td>                   <td>A note has been left on a kit.</td>
    </tr><tr>
        <td>Kit Created</td>            <td>A new kit was created.</td>
    </tr><tr>
        <td>Kit Edit</td>               <td>An attribute of a kit was chnaged.</td>
    </tr><tr>
        <td>Kit Deleted</td>            <td>A kit was deleted.</td>
    </tr><tr>
        <td>Kit Type Created</td>       <td>A new kit type was created.</td>
    </tr><tr>
        <td>Kit Type Edited</td>        <td>An attribute of a kit type was changed. </td>
    </tr><tr>
        <td>Kit Type Deleted</td>       <td>A kit type and all kits of that type was deleted. </td>
    </tr><tr>
        <td>Kit Contents added</td>     <td>An item was added to a kit. </td>
    </tr><tr>
        <td>Kit Contents Editied</td>   <td>An item of a kit was changed.</td>
    </tr><tr>
        <td>Kit Contents Removed</td>   <td>An item was removed from a kit. </td>
    </tr><tr>
        <td>Booking Request</td>        <td>A new booking was created for a kit. </td>
    </tr><tr>
        <td>Booking Canceled</td>       <td>A booking for a kit was cancled. </td>
    </tr><tr>
        <td>Booking Edited</td>         <td>An attribute of a booking was changed. </td>
    </tr><tr>
        <td>Kit Transfer Shipped</td>   <td>A kit was shipped from a branch. </td>
    </tr><tr>
        <td>Kit Transfer Received</td>  <td>A kit was recieved at a branch. </td>
    </tr><tr>
        <td>Booking detail added</td>   <td>A detail was added to a booking.</td>
    </tr><tr>
        <td>Booking detail edit</td>    <td>A detail of a booking was changed. </td>
    </tr><tr>
        <td>Booking detail deleted</td> <td>A booking detail was deleted.</td>
</tr>
</table>
<p>
</p>


@stop
