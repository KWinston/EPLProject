@if ($mode == 'receive')
    {{Form::open(array('route' => 'recieve_kit.store', 'class' => 'receive-kit-edit-form'));}}
@else
    {{Form::open(array('route' => 'ship_kit.store', 'class' => 'send-kit-edit-form'));}}
@endif
{{Form::hidden('ID', $booking->KitID)}}

{{Form::hidden('BookingID', $booking->ID)}}

<table style ="width:100%">
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
        Kit Status: {{ $booking->kit->state->StateName }}
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
    <tr>
        <td class="receive-kit-form-label">
        @foreach($booking->details as $bookdetail)
        @if($bookdetail->Booker == '1')
        Last Booker: {{ $bookdetail->Email }}
        @endif
        @endforeach
        </td>
    </tr>
</table>


<div class="receive-kit-contents">
<table border="1"  class="kit-contents-list">
    <tr>
        <th class="kit-contents-list-name"> Content Name</th>
        <th class="kit-contents-list-serial"> Serial Number</th>
    </tr>

    @foreach($booking->kit->contents as $content)
    <tr>
        <td class="kit-contents-list-name">
        <p class="kit-contents-kit-name">{{$content->Name}}</p>
        <table style="width:100%;" class ="kit-contents-table">
            <tr>
                <td class="receive-kit-form-label">
                    {{ Form::label('Name', 'Missing: ', array('class' => 'receive-kit'));}}
                </td>
                <td class="receive-kit-form-value">
                @if ($content->MissingLogID == null)
                    {{ Form::checkbox('isMissing_'.$content->ID, '1', false, array('ID' => 'isMissing_'.$content->ID, 'class' => 'receive-kit-form-value checkbox')); }}
                    {{ Form::text('MissingID_'.$content->ID, '', array('ID' => 'MissingID_'.$content->ID,  'class' => 'receive-kit receive-kit-form-value single-line-text'));}}
                @else
                    <input id="isMissing_{{$content->ID}}" class="receive-kit-form-value checkbox disabled" checked="checked" name="isMissing_{{$content->ID}}" type="checkbox" value="1">
                        {{$content->missingMessage->LogMessage}}
                    </input>
                @endif
                </td>
            </tr>
            <tr>
                <td class="receive-kit-form-label">
                    {{ Form::label('Name', 'Damaged: ', array('class' => 'receive-kit'));}}
                </td>
                <td class="receive-kit-form-value">
                @if ($content->DamagedLogID == null)
                    {{ Form::checkbox('isDamaged_'.$content->ID, '1', false, array('ID' => 'isDamaged_'.$content->ID, 'class' => 'receive-kit-form-value checkbox')); }}
                    {{ Form::text('DamagedID_'.$content->ID, '', array('ID' => 'DamagedID_'.$content->ID, 'class' => 'receive-kit receive-kit-form-value single-line-text'));}}
                @else
                    <input id="isDamaged_{{$content->ID}}" class="receive-kit-form-value checkbox disabled" checked="checked" name="isDamaged_{{$content->ID}}" type="checkbox" value="1">
                        {{$content->damagedMessage->LogMessage}}
                    </input>
                @endif
                </td>
            </tr>
        </table>
        <td class="kit-contents-list-serial">{{$content->SerialNumber}}</td>
    </tr>
    @endforeach
</div>

<table style="width:100%;">
    <tr>
        <td class="receive-kit-form-value">
        <div class="receive-kit-logmessage">
        </div>
        </td>
    </tr>
</table>
@if ($mode == 'receive')
    {{Form::submit('Receive Kit', array('class' => 'kit-submit'))}}
@else
    {{Form::submit('Ship Kit', array('class' => 'kit-submit'))}}
@endif

{{Form::close();}}
