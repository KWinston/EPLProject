@extends('layouts.adminMaster')
@section('head')
<script type="text/javascript">
    var gKitTypeID;
    var gKitID;
    var foo;
    function InputChanged()
    {
        console.log("tr label[for='"+this.id+"']");
        // Add the form changed for the table row.
        $("tr label[for='"+this.id+"']").parent().parent().addClass("form-input-changed");
        // $(this).addClass("form-input-changed");
        $(".kit-form .form-apply").prop("disabled",false).removeClass("ui-state-disabled");
    }
    function DestroyKit(kitID)
    {
        url = "{{ route('kits.destroy', array(':KITID')) }}";
        url = url.replace(':KITID',kitID);
        treeMenu.jstree().select_node(treeMenu.jstree().get_node("#"));
        treeMenu.jstree().delete_node(treeMenu.jstree().get_node("kit_" + kitID));
        $("#kit-table-area").html('');
        $("#kit-components-area").html('');
        $.ajax({type: "DELETE",url: url});
        return false;
    }
    function CreateNewKit()
    {
        url = "{{ route('kits.create') }}";
        $.ajax(
        {
            type: "GET",
            url: url,
            dataType: "json",
            success: function(data)
            {
                treeMenu.jstree().create_node(data.parent, data);
                treeMenu.jstree().select_node(treeMenu.jstree().get_node(data.id));

                LoadKit(data.KitID);
                // console.log("Create " + data + "  " + data.parent);
            }
        });
    }
    function LoadKit(kitID)
    {
        var url = "";
        // Build the url based on what was selected in the tree
        //     $(".kit-buttons").removeClass('hidden');
        url = "{{ route('kits.edit', array(':KITID')) }}";
        url = url.replace(':KITID', kitID);
        // console.log("Loading Kit Details " + url);
        $("#kit-table-area").load(url, function()
        {
            // after loading elements, wire up the UI functionality.
            $(".kit-form .form-apply").prop("disabled",true);
            $(".kit-form input").change(InputChanged);
            $(".kit-form select").change(InputChanged);
            $(".kit-form checkbox").change(InputChanged);
            $(".kit-form textarea").change(InputChanged);
            // If the element is ui-disabled, then make sure it has the property also
            $(".ui-state-disabled").prop("disabled",true);
            $(".kit-form .form-apply").click(function()
            {
                $.post( $(".kit-form").prop("action"), $('.kit-form').serialize(), function(data)
                    {
                        console.log(data)
                        var node = treeMenu.jstree().get_node(data.id);
                        node.text = data.text;
                    }, 'json');
                return false;
            });
            $(".form-checkbox").change(function()
            {
                if ($(this).prop('checked'))
                {
                    $(this).siblings('input').prop("disabled",false).removeClass("ui-state-disabled");
                }
                else
                {
                    $(this).siblings('input').prop("disabled",true).addClass("ui-state-disabled");
                }
            });
            $(".destroy-kit").button().click(function()
            {
                if (confirm("Are you sure you which to destroy " + $(".kit-form input#Name").val()) === true)
                {
                    DestroyKit(kitID);
                }
                return false;
            });
        });

    }

    function KitSelected(kitID, kitText, kitType, value)
    {
        // If we get passed a null value or false(which the treedoes some times on delete of node) we return
        if (kitID == null) return;
        if (kitType == "KIT")
        {
            LoadKit(value.KitID);
        }
        else
        {
            $("#kit-details").html('');
        }
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
            <button id="new-kit-btn"> Create new kit </button>
        </td>
        <td id="kit-table-area" class="kit-table-area content">
        </td>
        <td id="kit-components-area" class="kit-components-area">
        </td>

    </tr>
</table>
<script type="text/javascript">
    $("#new-kit-btn").button().click(CreateNewKit);
</script>

@stop
