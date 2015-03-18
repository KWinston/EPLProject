@extends('layouts.helpMaster')
@section('topic')
<h2> Overview</h2>
<table><tr>
    <td><img style="width:256px;" src="images/help/Kits1-screen.png"/></td>
    <td><ol>
        <li>Search for kit</li>
        <li>Kit Types</li>
        <li>Kits</li>
        <li>Create New Kit</li>
    </ol>
    </td>
</tr></table>
<br/>
<p>
    The left hand side of the manage kits screen consists of a tree-view of all kit types and kits.
    You can search for a existing kit either by searching by name (1) of browsing the kit types and kits (2,3).
    At the bottom of the left hand section is a button to create a new kit(4). By default new kits are added to
    the system type, and appear under the root.
</p>
<h2> Editing a kit </h2>
<p>
    When Editing a kit ther are two panes, the left pane (next) is the kits details, while th right pane (bottom)
    is for editing the contents of a kit.
</p>
<table><tr>
    <td><img style="width:512px;" src="images/help/Kits2-screen.png"/></td>
    <td><ol>
        <li value="5">Kit details</li>
        <li>Destroy Kit</li>
    </ol>
    </td>
</tr></table>
<br/>
<p>
    The kit details contain the basics like a name, and bar code, desccription, Kit type,...
    For specialized kits the specialized check box name are used to append additional information to the name.
</p>
<p>
    The 'At Branch', 'Available for use', and 'Kit state' are all live information. Changing this information will have imediate
    impact on the bookings. For instance if you change the 'At Branch' then the system will list that kit in the inventory of
    the new branch, and any bookings will notify the new branch that this kit should be shipped from there, while the branch that
    the kit is actually at will recieve no notifications.
</p>
<p>
    When the save button is clicked then the changes made to the kit details and contents will be saved. Up to this time all
    changes are local and will be lost if a new kit is selected in the tree-view.
</p>
<p>
    Destroying a kit (6) will cause the imidate removal of the kit record and deletion of all contents along with it.
    This is a non reversible operations, and a mistakenly destroyed kit will have to be recreated from scratch.
    Note: Logs will remain in place but will only be accessible to staff to query the SQL database directly.
</p>
<table><tr>
    <td><img style="width:512px;" src="images/help/Kits3-screen.png"/></td>
    <td><ol>
        <li value="7">Kit contents</li>
        <li>Delete content</li>
        <li>Add New Content</li>
    </ol>
    </td>
</tr></table>
<br/>
<p>
    The contents are added in this pane by clicking the "New Content Item" button (9)  which creates a new blank record.
    Details of the new item can be filled in within the edit area (7). The damages and missing flags can be changed here
    as needed. The missing and damaged flags are able to be unchecked here, non-admin staff are only able to check them to
    indicate new damage or missing item as part of the <a href="#" id="main-menu-ship">shipping</a>/<a href="#" id="main-menu-receive">receiving</a> process.
    The content Item can be removed by clicking the "X" button (8). 
</p>
@stop
