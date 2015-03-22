{{Form::open(array('route' => 'recieve_kit.store', 'class' => 'kit-type-edit-form'));}}
{{Form::hidden('ID', $booking->KitID)}}

{{Form::hidden('BookingID', $booking->ID)}}

<table style ="width:80%">
<tr><td>Name: {{ $booking->kit->Name }}</td></tr>
<tr><td> Description: {{ $booking->kit->KitDesc }}</td></tr>
<tr><td> Destination: {{ $booking->branch->Name }}</td></tr>
<tr><td> Last Kit Location: {{ $booking->kit->atBranch->Name }}</td></tr>
</table>

<div id="receive-contents">
<table border="1" style="width:80%">
<colgroup>
<col style="width: 70%">
<col style="width: 30%">
</colgroup>
    <tr>
        <th> Content Name</th>
        <th> Serial Number</th>
    </tr>
    @foreach($booking->kit->contents as $content)
    <tr>
        <td>
        <table>
            <tr>
                <td>
                {{$content->Name}}
                </td>
            </tr>
            <tr>
                <td>
                {{ Form::label('Name', 'Missing: ', array('class' => 'kit-type'));}}
                </td>
                <td>
                @if (($content->Missing) == false)
                {{ Form::checkbox('name', 'isMissing') }}
                {{ Form::textarea('Missing', $booking->ID, array('style' => 'width: 200px; height: 30px;', 'class' => 'form-control-textbox'));}}
                @else
                {{ Form::checkbox('name', 'isMissing', true) }}
                {{ Form::label('Missing', $booking->ID, array('class' => 'kit-type'));}}
                @endif
                </td>
            </tr>
            <tr>
                <td>
                {{ Form::label('Name', 'Damaged: ', array('class' => 'kit-type'));}}
                </td>
                <td>
                @if (($content->Damaged) == false)
                {{ Form::checkbox('name', 'isDamaged') }}
                {{ Form::textarea('Damaged', $booking->ID, array('style' => 'width: 200px; height: 30px;', 'class' => 'form-control-textbox'));}}
                @else
                {{ Form::checkbox('name', 'isDamaged') }}
                {{ Form::label('Damaged', $booking->ID, array('class' => 'kit-type'));}}
                @endif
                </td>
            </tr>
        </table>
        <td> {{$content->SerialNumber}} </td>
    </tr>
    @endforeach
</div>

<div id="log-message">
<table style="width:80%;">
    <tr> <td><br>Log Message: {{ Form::textarea('LogMessage', $booking->ID, array('style' => 'width: 100%; height: 40px;', 'class' => 'kit-type form-multiline-text')); }}<br></td></tr>
</table>
</div>
<div> {{Form::submit('Confirm Kit', array('class' => 'kit-type-submit'))}}
</div>
{{Form::close();}}