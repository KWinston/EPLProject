@extends('layouts.adminMaster')
@section('head')
<script type="text/javascript">
    var kitData;
    var gKitTypeID;
    var gKitID;
    var foo;
    function KitChanged()
    {
        // Add the form changed for the table row.
        $(this).parent().parent().addClass("form-input-changed");
        var changeName = $(this).attr('name');
        var oldKitType = kitData.KitType;
        if ($(this).hasClass("checkbox"))
        {
            kitData[changeName] = ($(this).prop('checked') ? "1" : "0");
        }
        else
        {
            kitData[changeName] = $(this).val();
        }

        // update the tree name, doing it all the time instead of detecting the
        // change as it is trivial update.
        var nm = kitData.Name;
        if (kitData.Specialized == "1")
        {
            nm = nm + " + " + kitData.SpecializedName;
        }
        treeMenu.jstree().set_text("kit_" + kitData.ID, nm);

        // We changed the parent, move the tree node. This is non trivial as it
        // changes the tree selection and ordering of nodes.
        // if we did it every time then a edited node would move to the last node under
        // it's parent.
        if (kitData.KitType != oldKitType)
        {
            // if it is undefined, then it hangs off the root node.
            var newType = (kitData.KitType != 0) ? "type_" + kitData.KitType : "#";
            treeMenu.jstree().move_node("kit_" + kitData.ID, newType , "last");
        }

        $(".form-apply").button( "option", "disabled", false ).removeClass("ui-state-disabled");
    }

    function ContentsChanged()
    {
        var contentIndex = $(this).parent().attr('ID');
        // Add the form changed for the table row.
        $(this).parent().parent().addClass("form-input-changed");
        // if we are changing a kit contents and we are changing the status from none to update
        if (kitData.contents[contentIndex].status == 0)
        {
            // this check prevents us from marking a new recored as a edit as it will lack a ID for the update.
            kitData.contents[contentIndex].status = 3; // CRUD, 3 == update
        }

        if ($(this).hasClass("checkbox"))
        {
            kitData.contents[contentIndex][$(this).attr('name')] = ($(this).prop('checked') ? "1" : "0");
        }
        else
        {
            kitData.contents[contentIndex][$(this).attr('name')] = $(this).val();
        }

        $(".form-apply").button( "option", "disabled", false ).removeClass("ui-state-disabled");
    }

    function DestroyKit(kitID)
    {
        url = "{{ route('kits.destroy', array(':KITID')) }}";
        url = url.replace(':KITID',kitID);
        treeMenu.jstree().select_node(treeMenu.jstree().get_node("#"));
        treeMenu.jstree().delete_node(treeMenu.jstree().get_node("kit_" + kitID));
        $(".kit-area").hide().addClass("hidden");

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
                // Remove the hidden from the form display.
                $(".kit-area").show().removeClass("hidden");

                treeMenu.jstree().create_node(data.parent, data);
                treeMenu.jstree().select_node(treeMenu.jstree().get_node(data.id));

                LoadKit(data.KitID);
            }
        });
    }
    function DestroyKitContentItem()
    {

        $(this).parent().parent().hide();
        kitData.contents[$(this).parent().attr('ID')].status = 4; // CRUD, 4 == delete

    }
    function ConnectFunctions()
    {
        $(".kit-data").unbind().change(KitChanged);
        $(".kit-contents").unbind().change(ContentsChanged);
        // If the element is ui-disabled, then make sure it has the property also
        $(".ui-state-disabled").prop("disabled",true);
        $(".form-apply").unbind().button( {disabled: true} ).click(function()
        {
            url = "{{ route('kits.store') }}";
            $.post(url, kitData, function( data )
            {
                LoadKit(kitData.ID);
            });
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
        $(".destroy-kit").unbind().button().click(function()
        {
            if (confirm("Are you sure you which to destroy " + $(".kit-form input#Name").val()) === true)
            {
                DestroyKit(kitData.ID);
            }
            return false;
        });
        $(".destroy-kit-content").unbind().button().click(DestroyKitContentItem);
        $(".kit-contents-add-new").unbind().button().click(function()
        {
            // Add new kit
            var nk = {  "Damaged": "0",
                        "ID": "***NEW***",
                        "KitID": kitData.ID,
                        "Missing": "0",
                        "Name": "new item",
                        "SerialNumber": "new asset number",
                        "status": 1} // CRUD, 1 = create
            var key = kitData.contents.length;
            kitData.contents.push(nk);
            var contents = kitData.contents;
            $("#kit-components-area table tbody").append(
                '<tr class="kit-content-row" ID="___' + key + '___">'+
                    '<td class="kit-content-form-name" ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-name text-singleline" name="Name" type="text" value="'+contents[key].Name+'" id="Name"></td>'+
                    '<td class="kit-content-form-serial-number"ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-serial-number text-singleline" name="SerialNumber" type="text" value="'+contents[key].SerialNumber+'" id="SerialNumber"></td>'+
                    '<td class="kit-content-form-damaged" ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-damaged checkbox" name="Damaged" type="checkbox" value="1" id="Damaged"></td>'+
                    '<td class="kit-content-form-missing" ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-missing checkbox" name="Missing" type="checkbox" value="1" id="Missing"></td>'+
                    '<td class="kit-content-form-remove" ID="'+key+'"> <button class="kit-contents destroy-kit-content kit-content-form-remove tiny-buttons" ID="'+key+'"> X </button></td>'+
                '</tr>'
            );
            // bind events to newly created records.
            var elementKey = ".kit-content-row#___" + key + "___ ";
            $(elementKey + ".destroy-kit-content").unbind().button().click(DestroyKitContentItem);
            $(elementKey + ".kit-contents").unbind().change(ContentsChanged);
        });
    }
    function LoadKit(kitID)
    {

        // Build the url based on what was selected in the tree
        var url = "";
        url = "{{ route('kits.show', array(':KITID')) }}";
        url = url.replace(':KITID', kitID);
        $.get(url, "", function(data)
        {
            // Any changed records are now clean again
            $(".form-input-changed").removeClass("form-input-changed");

            // Remove the hidden from the form display.
            $(".kit-area").show().removeClass("hidden");

            kitData = data;
            // Clear the list of contents
            $("#kit-components-area table").html("<tr><th>Name</th><th>Asset #</th><th>Damaged</th><th>Missing</th><th></th></tr>");
            // Load the edit form!
            for(var key in data)
            {
                if (data.hasOwnProperty(key))
                {
                    if ($(".kit-data#"+key).hasClass("checkbox"))
                    {
                        $(".kit-data#"+key).prop("checked", (data[key] == "1"));
                    }
                    else
                    {
                        $(".kit-data#"+key).val(data[key]);

                    }
                }
            }
            var contents = data["contents"];
            for (var key in contents)
            {
                var missing = "";
                var damaged = "";
                if (contents[key].Missing == 1) missing = "checked";
                if (contents[key].Damaged == 1) damaged = "checked";
                $("#kit-components-area table tbody").append(
                    '<tr class="kit-content-row" ID="'+contents[key].ID+'">'+
                        '<td class="kit-content-form-name" ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-name text-singleline" name="Name" type="text" value="'+contents[key].Name+'" id="Name"></td>'+
                        '<td class="kit-content-form-serial-number"ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-serial-number text-singleline" name="SerialNumber" type="text" value="'+contents[key].SerialNumber+'" id="SerialNumber"></td>'+
                        '<td class="kit-content-form-damaged" ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-damaged checkbox" ' + damaged + ' name="Damaged" type="checkbox" value="1" id="Damaged"></td>'+
                        '<td class="kit-content-form-missing" ID="'+key+'"> <input class="kit-contents kit-content-element kit-content-form-missing checkbox" ' + missing + ' name="Missing" type="checkbox" value="1" id="Missing"></td>'+
                        '<td class="kit-content-form-remove" ID="'+key+'"> <button class="kit-contents destroy-kit-content kit-content-form-remove tiny-buttons" ID="'+key+'"> X </button></td>'+
                    '</tr>'
                );
            }
            ConnectFunctions();

        }, "json");
    }

    function KitSelected(value)
    {
        // If we get passed a null value or false(which the treedoes some times on delete of node) we return
        if (value.KitID == null) return;
        if (value.type == "KIT")
        {
            LoadKit(value.KitID);
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
            <button id="new-kit-btn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"> Create new kit </button>
        </td>
        <td id="kit-table-area" class="kit-table-area content">
            <div class="kit-detail-form kit-area hidden">
                <table cellpadding="0" style="width:100%;" >
                    <tr>
                        <td> <label for="Name">Kit Name:</label> </td>
                        <td> <input class="kit-data form-singleline-text" name="Name" type="text" value="" id="Name"> </td>
                    </tr>
                    <tr>
                        <td> <label for="Specialized">Specialized kit:</label> </td>
                        <td>
                            <input class="kit-data form-checkbox checkbox" checked="checked" name="Specialized" type="checkbox" value="1" id="Specialized">
                            <input class="kit-data form-checkbox-text" ID="SpecializedName" name="SpecializedName" type="text" value="ESL Tutor">
                        </td>
                    </tr>
                    <tr>
                        <td> <label for="BarcodeNumber">Bar Code:</label> </td>
                        <td> <input class="kit-data form-singleline-text" name="BarcodeNumber" type="text" value="" id="BarcodeNumber"> </td>
                    </tr>

                    <tr>
                        <td> <label for="KitType">Kit Type:</label> </td>
                        <td> <select class="kit-data form-select" id="KitType" name="KitType">
                            @foreach($kitTypes as $kt)
                                <option value="{{$kt->ID}}">{{$kt->Name}}</option>
                            @endforeach
                        </select> </td>
                    </tr>
                    <tr>
                        <td> <label for="AtBranch">At Branch:</label> </td>
                        <td> <select class="kit-data form-select" id="AtBranch" name="AtBranch">
                            @foreach($branches as $b)
                                <option value="{{$b->ID}}">{{$b->BranchID}} - {{$b->Name}}</option>
                            @endforeach
                        </select> </td>
                    </tr>
                    <tr>
                        <td> <label for="Available">Available for use:</label> </td>
                        <td> <input class="kit-data form-checkbox" checked="checked" name="Available" type="checkbox" value="" id="Available"> </td>
                    </tr>
                    <tr>
                        <td> <label for="KitState">Kit State:</label> </td>
                        <td> <select class="kit-data form-select" id="KitState" name="KitState">
                            @foreach($kitStates as $ks)
                                <option value="{{$ks->ID}}">{{$ks->StateName}}</option>
                            @endforeach
                        </select> </td>
                    </tr>
                    <tr>
                        <td> <label for="KitDesc">Description:</label> </td>
                        <td> <textarea class="kit-data form-multiline-text" name="KitDesc" cols="50" rows="10" id="KitDesc"></textarea> </td>
                    </tr>
                    <tr>
                    </tr>

                </table>
                <button class="form-apply ui-button ui-widget ui-state-default ui-state-disabled ui-corner-all " type="submit" value="">Save Changes</button>
                <button class="destroy-kit ui-button ui-widget ui-state-default ui-corner-all "> Destroy Kit </button>
            </div>
        </td>
        <td id="kit-components-area" class="kit-components-area">
            <div style="height:100%; width:100% display: block;" class="kit-area hidden">
                <table cellpadding="0" style="width:100%; display: block;" >
                </table>

                 <button class="kit-contents-add-new ">New Content Item</button>
            </div>
        </td>

    </tr>
</table>
<script type="text/javascript">
    $(function()
    {
        $("#new-kit-btn").unbind().button().click(CreateNewKit);

    })
</script>

@stop
