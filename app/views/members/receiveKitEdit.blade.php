{{Form::open(array('route' => 'recieve_kit.store', 'class' => 'receive-kit-edit-form'));}}
{{Form::hidden('ID', $booking->KitID)}}

{{Form::hidden('BookingID', $booking->ID)}}

<table style ="width:80%">
    <tr>
        <td class="receive-kit-form-label">
        Name: {{ $booking->kit->Name }}
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
        Description: {{ $booking->kit->KitDesc }}
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
        Destination: {{ $booking->branch->Name }}
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
        Last Kit Location: {{ $booking->kit->atBranch->Name }}
        </td>
    </tr>
</table>

<div class="receive-kit-contents">
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
                <td class="receive-kit-form-label">
                {{$content->Name}}
                </td>
            </tr>
            <tr>
                <td class="receive-kit-form-label">
                {{ Form::label('Name', 'Missing: ', array('class' => 'receive-kit'));}}
                </td>
                <td class="receive-kit-form-value">
                @if (($content->MissingLogID) == null)
                {{ Form::checkbox('isMissing_'.$content->ID, '1', false, array('ID' => 'isMissing_'.$content->ID)); }}
                {{ Form::textarea('MissingID_'.$content->ID, '', array('ID' => 'MissingID_'.$content->ID, 'style' => 'width: 300px; height: 30px;', 'class' => 'receive-kit form-multline-text'));}}
                @else
                {{ Form::checkbox('isMissing_'.$content->ID, '1', true, array('ID' => 'isMissing_'.$content->ID)); }}
                {{ Form::label('Missing', $content->missingMessage->LogMessage, array('class' => 'receive-kit'));}}
                @endif
                </td>
            </tr>
            <tr>
                <td class="receive-kit-form-label">
                {{ Form::label('Name', 'Damaged: ', array('class' => 'receive-kit'));}}
                </td>
                <td class="receive-kit-form-value">
                @if (($content->DamagedLogID) == null)
                {{ Form::checkbox('isDamaged_'.$content->ID, '1', false, array('ID' => 'isDamaged_'.$content->ID)); }}
                {{ Form::textarea('DamagedID_'.$content->ID, '', array('ID' => 'DamagedID_'.$content->ID, 'style' => 'width: 300px; height: 30px;', 'class' => 'receive-kit form-multiline-text'));}}
                @else
                {{ Form::checkbox('isDamaged_'.$content->ID, '1', true, array('ID' => 'isDamaged_'.$content->ID)); }}
                {{ Form::label('Damaged', $content->damagedMessage->LogMessage, array('class' => 'receive-kit'));}}
                @endif
                </td>
            </tr>
        </table>
        <td class="receive-kit-form-label">
        <div class="receive-kit-serialnumber">
        {{$content->SerialNumber}}
        </div>
        </td>
    </tr>
    @endforeach
</div>
<table style="width:80%;">
    <tr>
        <td class="receive-kit-form-value">
        <div class="receive-kit-logmessage">
        <br>Notes: {{ Form::textarea('LogMessage', '', array('style' => 'width: 100%; height: 40px;', 'class' => 'receive-kit form-multiline-text')); }}<br>
        </div>
        </td>
    </tr>
</table>
{{Form::submit('Confirm Kit', array('class' => 'receive-kit-submit'))}}
{{Form::close();}}