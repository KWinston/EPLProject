@extends('layouts.adminMaster')
@section('head')
<script type="text/javascript">
    function LoadSelectedLog( itemType, KitTypeID, KitID, allChecked )
    {
        var url = "";
        // Build the url based on what was selected in the tree
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
        console.log("Loading Loggs " + url+filters);
        $("#logs-display").load(url+filters, function()
        {
            $("#log-filter-refresh").button().click(function()
            {
                $(".kit-selected").removeClass("kit-selected");
                $(this).addClass("kit-selected");
                LoadSelectedLog(itemType, KitTypeID, KitID, false);

            });
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
            // $(".kit-return-depot").button().click(function() {console.log("Return kit to depot");});
            // $(".bookable-kit").click(function() {console.log("Kit is Bookable " + $(".bookable-kit").prop("checked"));});
        });

    }
    function KitSelected(value)
    {
        $(".button-bar").addClass('hidden');
        LoadSelectedLog(value.type, value.KitTypeID, value.KitID, true);
    }
</script>

@stop

@section('Content')
<table cellpadding="0" style="height: 100%;" >
    <tr>
        <td style="vertical-align: top;">
            @include('components.comp_menu', array(
                'function' => 'KitSelected',
                'side_menu_class' => ''
            ))
        </td>
        <td class="logs-table-area">
            <div id="logs-display">
                <h1 class="click-select-logs-msg"> Select a Kit or type to view logs for it. </h1>
            </div>
        </td>

    </tr>
</table>
@stop
