{{Form::open(array('route' => 'kitTypes.store', 'class' => 'kit-type-edit-form'));}}
{{Form::hidden('ID', $kitType->ID)}}
<table cellpadding="0" style="width:99%;" >
    <tr>
        <td class="form-label">
            {{Form::label('Name', 'Type Name:', array('class' => 'kit-type'))}}
        </td>
        <td class="form-value">
            {{Form::text('Name', $kitType->Name, array('class' => 'kit-type form-singleline-text'))}}
        </td>
    </tr>
    <tr>
        <td class="form-label">
            {{Form::label('TypeDescription', 'Description:', array('class' => 'kit-type'))}}
        </td>
        <td class="form-value">
            {{Form::textarea('TypeDescription', $kitType->TypeDescription, array('class' => 'kit-type form-multiline-text'));}}
        </td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td class="form-label"> {{Form::submit('Submit', array('class' => 'kit-type-submit'))}}</td>
        <td class="form-value"> {{Form::button('Delete Type & all kits of type', array('class' => 'kit-type-destroy'))}} </td>
    </tr>
</table>
<p class="kit-type-kit-stat">Number of kits for type: {{count($kitType->kits)}}</p>
<p class="kit-type-kit-stat">Number of log entries for type: {{Logs::where('LogKey1', '=', $kitType->ID)->count()}}</p>
