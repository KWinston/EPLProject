@extends('layouts.master')
@section('head')
<script type="text/javascript">
    function LoadSelectedLog( itemType, KitTypeID, KitID, allChecked )
    {
        var url = "";
        if (itemType == 'KIT')
        {
            $(".kit-buttons").removeClass('hidden');
            url = "{{ route('logs.show2', array(':KITTYPEID',':KITID')); }}";
            url = url.replace(':KITTYPEID', KitTypeID);
            if(KitID)
            {
                url = url.replace(':KITID',KitID);
            }
        }
        if (itemType == 'TYPE')
        {
            $(".type-buttons").removeClass('hidden');
            url = "{{ route('logs.show1', ':KITTYPEID'); }}";
            url = url.replace(':KITTYPEID', KitTypeID);
            console.log(url);
        }
        var filters = "?";
        console.log("AllChecked = " + allChecked );
        if (allChecked)
        {
            console.log("?FILTERS-ALL=T")
            filters = "?FILTERS-ALL=T&";
        }
        else
        {

            $.each( $("input.log-filter"), function(index, item)
            {
                filters = filters + $(item).attr("id");
                if ($(item).prop('checked'))
                {
                    filters = filters + "=T&";
                }
                else
                {
                    filters = filters + "=F&";
                }
            });
        }
        console.log(url+filters);

        $("#logs-display").load(url+filters, function()
        {
            $("#log-filter-refresh").button().click(function(){LoadSelectedLog(itemType, KitTypeID, KitID, false)});
            $("#log-filter-select-all").button().click(function()
            {
                $.each($("input.log-filter"), function( index, value )
                {
                    $(value).prop('checked', true);
                })
            });
            $("#log-filter-select-none").button().click(function()
            {
                $.each($("input.log-filter"), function( index, value )
                {
                    $(value).prop('checked', false);
                })
            });
        });

    }
    function KitSelected(value)
    {
        $(".button-bar").addClass('hidden');
        LoadSelectedLog(value.original.type, value.original.KitTypeID, value.original.KitID, true);
    }
</script>

@stop

@section('content')
<table cellpadding="0" style="height: 100%;" >
    <tr>
        <td style="vertical-align: top;">
            @include('components.comp_menu', array(
                'function' => 'KitSelected',
                'side_menu_class' => 'button-bar-visible'
            ))
            <div class="side-menu-button-bar" >
                <button id="manage-kit-types-button" class="tiny-buttons"> Manage Kit Types</button>
                <button id="manage-branches-button" class="tiny-buttons"> Manage Branches</button>

                <div style="vertical-align: bottom;" class="button-bar type-buttons hidden">
                    <button id="add-kit-btn" class="tiny-buttons"> Add Kit </button>
                </div>
                <div style="vertical-align: bottom;" class="button-bar kit-buttons hidden">
                    <button id="edit-kit-btn" class="tiny-buttons"> Edit Kit </button>
                    <button id="del-kit-btn" class="tiny-buttons"> Remove Kit </button>
                    <button id="add-kit-note-btn" class="tiny-buttons"> Add Note on Kit </button>
                </div>
            </div>
        </td>
        <td id="logs-display" class="logs-table-area">
        </td>

    </tr>
</table>
<script type="text/javascript">
    $(function()
    {
        $("#manage-kit-types-button").button().click(function()
        {
            console.log("Manage Kit Types");
        });
        $("#manage-branches-button").button().click(function()
        {
            console.log("Manage Branches");
        });
        $("#add-kit-btn").button();
        $("#edit-kit-btn").button();
        $("#del-kit-btn").button();
        $("#add-kit-note-btn").button();
    });
</script>
@stop
