{{Form::open(array('route' => 'kit_contents.store', 'class' => 'kit-contents-edit-form'));}}
{{Form::hidden('ID', $kitID)}}

<table class="kit-contents">
    <tr class="kit-contents header">
        <th class="kit-contents content-name">Name</th>
        <th class="kit-contents content-serial-number">Asset#</th>
        <th class="kit-contents content-damaged">Damaged</th>
        <th class="kit-contents content-missing">Missing</th>
    </tr>
    @foreach($contents as $cont)
        <tr class="kit-contents">
            <td colspan="4">
                <table class="kit-contents-row" id="{{$cont->ID}}">
                    <tr  class="kit-contents-row">
                     <!-- 'Name', 'SerialNumber', 'DamagedLogID', 'MissingLogID',  -->
                        <td class="kit-contents content-name">{{$cont->Name}}</td>
                        <td class="kit-contents content-serial-number">{{$cont->SerialNumber}}</td>
                        @if($cont->DamagedLogID != null)
                            <td class="kit-contents content-damaged" id="{{$cont->ID}}">
                                {{ Form::checkbox('isDamaged_'.$cont->ID, '1', true, array('ID' => 'isDamaged_'.$cont->ID, 'class' => 'kit-content-form-value damaged checkbox disabled')); }}
                            </td>
                        @else
                            <td class="kit-contents content-damaged" id="{{$cont->ID}}">
                                {{ Form::checkbox('isDamaged_'.$cont->ID, '1', false, array('ID' => 'isDamaged_'.$cont->ID, 'class' => 'kit-content-form-value damaged checkbox')); }}
                            </td>
                        @endif
                        @if($cont->MissingLogID != null)
                            <td class="kit-contents content-missing" id="{{$cont->ID}}">
                                {{ Form::checkbox('isMissing_'.$cont->ID, '1', true, array('ID' => 'isMissing_'.$cont->ID, 'class' => 'kit-content-form-value missing checkbox disabled')); }}
                        @else
                            <td class="kit-contents content-missing" id="{{$cont->ID}}">
                                {{ Form::checkbox('isMissing_'.$cont->ID, '1', false, array('ID' => 'isMissing_'.$cont->ID, 'class' => 'kit-content-form-value missing checkbox')); }}
                            </td>
                        @endif
                    </tr>
                    <tr class="kit-contents-damaged-msg" id="_{{$cont->ID}}">
                        @if($cont->DamagedLogID != null)
                            <td colspan="4">Damage:{{$cont->damagedMessage->LogMessage}}</td>
                        @endif
                    </tr>
                    <tr class="kit-contents-missing-msg" id="_{{$cont->ID}}">
                        @if($cont->MissingLogID != null)
                            <td colspan="4">Missing:{{$cont->missingMessage->LogMessage}}</td>
                        @endif
                    </tr>
                </table>
            </td>
        </tr>
    @endforeach
</table>
{{Form::close();}}
