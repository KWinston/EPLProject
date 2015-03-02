<div class="kit-detail-form">
    {{ Form::open(array('route' => array('kits.store'), 'class' => 'kit-form')) }}
    {{ Form::hidden('ID', $kit->ID) }}
    <table cellpadding="0" style="height: 100%;" >
        <tr>
            <td> {{ Form::label('Name', 'Kit Name:') }} </td>
            <td> {{ Form::text('Name', $kit->Name, array('class' => 'form-singleline-text'))  }} </td>
        </tr>
        <tr>
            <td> {{ Form::label('KitType', 'Kit Type:') }} </td>
            <td> {{ Form::select('KitType', $kitTypes, $kit->KitType, array('class' => 'form-select')) }} </td>
        </tr>
        <tr>
            <td> {{ Form::label('AtBranch', 'At Branch:') }} </td>
            <td> {{ Form::select('AtBranch', $branches, $kit->AtBranch, array('class' => 'form-select')) }} </td>
        </tr>
        <tr>
            <td> {{ Form::label('Available', 'Available for use:') }} </td>
            <td> {{ Form::checkbox('Available', true, $kit->Available, array('class' => 'form-checkbox')) }} </td>
        </tr>
        <tr>
            <td> {{ Form::label('KitState', 'Kit State:') }} </td>
            <td> {{ Form::select('KitState', $kitStates, $kit->KitState, array('class' => 'form-select')); }} </td>
        </tr>
        <tr>
            <td> {{ Form::label('KitDesc', 'Description:') }} </td>
            <td> {{ Form::textarea('KitDesc', $kit->KitDesc, array('class' => 'form-multiline-text')) }} </td>
        </tr>
        <tr>
            <td> {{ Form::label('Specialized', 'Specialized kit:') }} </td>
            <td>
                {{ Form::checkbox('Specialized', true, $kit->Specialized, array('class' => 'form-checkbox'))  }}
                @if($kit->Specialized)
                    {{ Form::text('SecializedName', $kit->SecializedName, array('class' => 'form-checkbox-text')) }}
                @else
                    {{ Form::text('SecializedName', $kit->SecializedName, array('class' => 'form-checkbox-text ui-state-disabled')) }}
                @endif
            </td>
        </tr>
        <tr>
            <td> {{ Form::submit('Save Changes', array('class' => 'form-apply ui-button ui-widget ui-state-default ui-state-disabled ui-corner-all ')) }}
            </td>
        </tr>

    </table>
    {{ Form::close() }}
    <button class=" ui-button ui-widget ui-state-default ui-corner-all destroy-kit"> Destroy Kit </button>  


</div>
