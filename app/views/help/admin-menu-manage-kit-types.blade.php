@extends('layouts.helpMaster')
@section('topic')
<h2> Overview</h2>
<table><tr>
    <td><img style="width:512px;" src="images/help/KitTypes-screen.png"/></td>
    <td><ol>
        <li>Existing kit types.</li>
        <li>Create new kit type.</li>
        <li>Kit type details.</li>
        <li>Submit changes.</li>
        <li>Destroy Kit type & all related</li>
        <li>Kit type info.</li>
    </ol>
    </td>
</tr></table>
<br/>
<h2> Existing Kit Types</h2>
<p>
    This is a list of all types existing (1), kit types that have no kits in them will not be listed for non-admin users.
    Selecting a kit type allows for the changeing of the kit type details.
</p>
<br/>
<h2>Creation/Editing a Kit Type</h2>
<p>
    Creating a new kit type is done by clicking the "Create new Kit" (2) button. To edit a kit type select the kit type from the list.
</p>
<p>
    In both cases the kit type edit form is displayed on the right hand side. The name and a detailed description of a
    kit type can be entered(3). This is displayed to the users of the system who want to know the details about a kit
    type (see tool-tips for <a href="#" id="main-menu-overview">Overview</a>).
</p>
<p>
    When clicking the submit button(4) any changes entered into the above form will be saved. If you change the selected kit type then
    edit changes that may have been made will be lost.
</p>
<br/>
<h2>Destroying a Kit Type</h2>
<p>
    The delete Kit Type button will delete a kit type, this is a very destructive operaion and will destroy all of the following:
    <ul>
        <li>Kit type</li>
        <li>All kits within this type.</li>
        <li>All kit contents of kits within this type</li>
        <li><b style="color:red;">All logs for all items under this type.</b></li>
    </ul>
</p>
    This last item is of a very serious nature! The structure of the entire system is dependent around the kit types and as a
    result the logs are dependent on kit types for referential integrity. For this reason kit types that have no kits in them
    are not presented to non-admin users. This allows for the moving and removal of kits without destroying the log history.
    If a kit type is destroyed then everything dependent on the kit type is destroyed. <b>You have been warned!</b>
</p>
<br/>
@stop
