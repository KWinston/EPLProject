@extends('layouts.helpMaster')
@section('topic')
<h2> Overview</h2>
<table><tr>
    <td><img style="width:800px;" src="images/help/User1-screen.png"/></td>
    <td>User List</td>
</tr>
<tr>
    <td><img style="width:256px;" src="images/help/User2-screen.png"/></td>
    <td>User Edit Dialog</td>
</tr>
</table>
<br/>
<h2> Existing Kit Types</h2>
<p>
    This screen is temporary, it is believed that the application will be integrated with an existing LDAP authentication system.
    As a result the user management is basically the default that Laravel ships with, with very few minor changes.
    As a result the user management is rudimentary and as a result you can not delete or add users to the system. Clicking on a
    row in the table allows for the edit dialog to appear.
</p>
<p>
    From this dialog you can change the users name, real name, email address, home branch, and if they are a administrator. As this
    area of the application was not a deliverable, we have only placed a bare minimum controls for testing purposes.
</p>
@stop
