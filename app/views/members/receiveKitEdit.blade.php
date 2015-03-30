@if ($mode == 'receive')
    {{Form::open(array('route' => 'recieve_kit.store', 'class' => 'receive-kit-edit-form'));}}
@else
    {{Form::open(array('route' => 'ship_kit.store', 'class' => 'send-kit-edit-form'));}}
@endif
{{Form::hidden('ID', $booking->KitID)}}

{{Form::hidden('BookingID', $booking->ID)}}

<script>
$( '.send-kit-edit-form' ).on('submit', function() {
            var ok;
    if (confirm("Are you sure you want to ship kit?") == true)
        {
            return true;
        }
        else
        {
            return false;
        }
        return false;
    });
$( '.receive-kit-edit-form' ).on('submit', function() {
            var ok;
    if (confirm("Are you sure you want to receive kit?") == true)
        {
            return true;
        }
        else
        {
            return false;
        }
        return false;
    });
</script>

<table style ="width:100%">
    <tr>
        <th colspan="3">
            <div class="kit-transfer-heading">
            Booking Name: {{ $booking->Purpose }}
            </div>
        </th>
    </tr>
    <tr>
    <tr>
        <th colspan="3">
            <div class="kit-transfer-heading">
            @foreach($booking->details as $bookdetail)
            @if($bookdetail->Booker == '1')
            Booker's Email: {{ $bookdetail->Email }}
            @endif
            @endforeach
            </div>
        </th>
    </tr>
    <tr>
        <th colspan="3">
        @if ($mode == 'receive')
            <button onclick="$('.receive-kit-edit-form').submit(); return false;" id="formSubmit" class="kit-submit">Receive Kit</button>
            Click to confirm reception of kit
        @else
            <button onclick="$('.send-kit-edit-form').submit(); return false;" id="formSubmit" class="kit-submit">Ship Kit</button>
            Click to set kit into 'In Transit'
        @endif
        </th>

    </tr>
    <tr>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
            <div class="kit-transfer-heading">
            Kit Name: {{ $booking->kit->Name }}
            </div>
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
            <div class="kit-transfer-heading">
            Kit Description: {{ $booking->kit->KitDesc }}
            </div>
        </td>
    </tr>
    <tr>
        <td class="kit-transfer-barcode">
            <div class="kit-transfer-heading">
            Kit Barcode #: {{ $booking->kit->BarcodeNumber }}
            </div>
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
            <div class="kit-transfer-heading">
            Kit Status: {{ $booking->kit->state->StateName }}
            </div>
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
            <div class="kit-transfer-heading">
            Destination: {{ $booking->branch->Name }}
            </div>
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
            <div class="kit-transfer-heading">
            Current Kit Location: {{ $booking->kit->atBranch->Name }}
            </div>
        </td>
    </tr>
    <tr>
        <td class="receive-kit-form-label">
            <div class="kit-transfer-heading">
            @foreach($booking->details as $bookdetail)
            @if($bookdetail->Booker == '1')
            Last Booker: {{ $bookdetail->Email }}
            @endif
            @endforeach
            </div>
        </td>
    </tr>
</table>


<div class="receive-kit-contents">
<table border="1"  class="kit-contents-list">
    <tr>
        <th class="kit-contents-list-name"> Content Name</th>
        <th class="kit-contents-list-serial"> Asset Tag</th>
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
                @if ($content->MissingLogID == 0 || null)
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
                @if ($content->DamagedLogID == 0 || null)
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

{{Form::close();}}
