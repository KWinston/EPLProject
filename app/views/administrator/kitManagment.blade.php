@extends('layouts.adminMaster')
@section('head')
<script type="text/javascript">
    var gKitTypeID;
    var gKitID;
    function ManageSelected(KitType, KitTypeID, KitID)
    {
        if (KitType == "KIT")
        {
            var url = "";
            // Build the url based on what was selected in the tree
            //     $(".kit-buttons").removeClass('hidden');
            url = "{{ route('kits.edit', array(':KITID')) }}";
            url = url.replace(':KITID',KitID);
            console.log("Loading Kit Details " + url);
            $("#kit-details").load(url, function()
            {
            });
        }
        else
        {
            $("#kit-details").html('');
        }
    }
    function KitSelected(value)
    {
        $(".button-bar").addClass('hidden');
        gKitTypeID = value.original.KitTypeID;
        gKitID = value.original.KitID;
        if (gKitID)
        {
            $(".kit-options").show();
        }
        else
        {
            $(".kit-options").hide();
        }
        ManageSelected(value.original.type, value.original.KitTypeID, value.original.KitID);
    }
</script>
@stop
@section('Content')
<table cellpadding="0" style="height: 100%;" >
    <tr>
        <td style="vertical-align: top;">
            @include('components.comp_menu', array(
                'function' => 'KitSelected',
                'side_menu_class' => 'button-bar-visible'
            ))
        </td>
        <td class="kit-table-area">
            <div id="kit-details">

            </div>
        </td>

    </tr>
</table>
@stop
