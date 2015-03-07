@extends('layouts.adminMaster')
@section('head')
{{ HTML::style('css/comp-menu.css') }}
<script type="text/javascript">
    function SelectKitType(kitTypeID)
    {
        $(".kit-type-name.selected").removeClass("selected");
        $(this).addClass("selected");
        url = "{{ route('kitTypes.edit', array(':KITTYPEID')) }}";
        url = url.replace(':KITTYPEID', kitTypeID);

        $("#kit-type-edit").load(url, function()
        {
            $(".kit-type-submit").unbind().button({'disable': true}).click(function()
            {
                $.post("{{ route('kitTypes.store') }}", $('.kit-type-edit-form').serialize(), function( data )
                {
                    typeID = $('.kit-type-edit-form [name="ID"]').val();
                    $(".kit-type-name#" + typeID).html($('.kit-type-edit-form [name="Name"]').val());
                });
                return false;
            });
            $(".kit-type-destroy").unbind().button().click(function()
            {
                typeID = $('.kit-type-edit-form [name="ID"]').val();
                url = "{{ route('kitTypes.destroy', array(':KITTYPEID')) }}";
                url = url.replace(':KITTYPEID', typeID);

                if (confirm("\nThis will destroy this type, and all kits of this type "
                            + "\nas well the logs for this type (and kits of this type) will no longer be accessible!"
                            + "\n\nAre you sure you which to destroy the '" + $(".kit-type-edit-form input#Name").val() + "' type and associated kits?"
                            ) === true)
                {
                    // remove the list entry
                    $.ajax(
                    {
                        url: url,
                        type: 'DELETE',
                        success: function(result)
                        {
                            $(".kit-type-name#" + typeID).remove();
                            $("#kit-type-edit").html('');
                            // Do something with the result
                            console.log("destroy");
                        }
                    });
                }

                return false;
            });

        })
    }
    function NewKitType()
    {
        console.log("new kit");
        $.ajax(
        {
            url: "{{ route('kitTypes.create') }}",
            type: 'GET',
            success: function(result)
            {
                SelectKitType(result["ID"]);
                $(".kit-type-name.selected").removeClass("selected");
                $("#kit-type-list").append('<li class="kit-type-name selected" ID="'+result["ID"]+'">'+result["Name"]+'</li>')
                console.log(result);
            }
        });
    }
</script>
@stop
@section('Content')
<table cellpadding="0" style="height: 100%; width:100%" >
    <tr>
        <td style="vertical-align: top; width:15%">
            <div class="button-bar-visible content" style="display: table;">
                <ul ID="kit-type-list">
                    @foreach($kitTypes as $kt)
                        @if($kt->ID != 0)
                            <li class="kit-type-name" ID="{{$kt->ID}}">{{$kt->Name}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class=" kit-type-buttons side-menu-button-bar" style="display:table;">
                <button id="new-kit-btn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"> Create new kit type </button>
            </div>
        </td>
        <td style="vertical-align: top; width:80%">
            <div id="kit-type-edit" class="content">
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
    $(function()
    {
        // document ready
        $(".kit-type-name").unbind().click(function(){ SelectKitType(this.id); });
        $("#new-kit-btn").unbind().button().click(NewKitType);
    })
</script>
@stop
