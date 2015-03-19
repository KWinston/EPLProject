@extends('layouts.helpMaster')
@section('topic')
<h2> Overview</h2>
<p> This page is a general overview page of where kits are and what they contain.
    Each line lists a individual kit grouped by the type and which branch the kit is located at.
    The next booking along with the total future bookings are listed.
</p>
<h2>Tool-tips</h2>
<p>
    There are tool-tips that appear when you hover the mouse over the kit types, kit names, and branches.
    The tool-tip for a kit type displays the description of what that type of kit contains.
    While the tool-tip for a kit name will display a more detailed description of that kit.
    The tool-tip for a branch will display the contact information for that branch.
    The tool-tip for the booking informations is basic information about who booked it. 
</p>
@stop
