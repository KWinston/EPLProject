@extends('layouts.master')

@section('head')
{{ HTML::style('css/comp-menu.css') }}
<script type="text/javascript">
    function SelectKitType(kitTypeID)
    {
        $(".kit-type-name.selected").removeClass("selected");
        $(this).addClass("selected");
        url = "{{ route('recieve_kit.edit', array(':KITTYPEID')) }}";
        url = url.replace(':KITTYPEID', kitTypeID);

        $("#kit-type-edit").load(url, function()
        {
            $(".kit-type-submit").unbind().button({'disable': true}).click(function()
            {
                $.post("{{ route('recieve_kit.store') }}", $('.kit-type-edit-form').serialize(), function( data )
                {
                    typeID = $('.kit-type-edit-form [name="ID"]').val();
                    $(".kit-type-name#" + typeID).html($('.kit-type-edit-form [name="Name"]').val());
                });
                return false;
            });
            $(".kit-type-destroy").unbind().button().click(function()
            {
                typeID = $('.kit-type-edit-form [name="ID"]').val();
                url = "{{ route('recieve_kit.destroy', array(':KITTYPEID')) }}";
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
</script>
@stop
@section('content')
<h3> {{ $branch->Name }} Kits Awaiting Reception </h3>
<table cellpadding="0" style="height: 100%; width:100%" >
    <tr>
        <td style="vertical-align: top; width:15%">
            <div class="recv-no-button-bar-visible content" style="display: table;">
                <ul> <u><b>Select Kit</b></u>
                </ul>
                <ul ID="kit-type-list">
                    @foreach($receiveKits as $rk)
                        @if($rk->KitID != 0)
                            <li class="kit-type-name" ID="{{$rk->BookingID}}">{{$rk->KitName}}</li>
                        @endif
                    @endforeach
                </ul>
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
    })

    $(function()
    {
        $.getJSON( "{{ route('recieve_kit.index') }}", function( data )
        {
            branchID = data.branch_ID;
            branches = data.branches;
            console.log(data);
            inventory = data.data;
            loadInventory();
            $("div.kit-block-activity.kit-shipping").button();
            $("div.kit-block-activity.kit-receiving").button();
            $("div.kit-block-activity.kit-booking").button();
            $("div.kit-shipping").click(doShipping);
            $("div.kit-receiving").click(doReceiving);
            $("div.kit-booking").click(doBooking);

            $(".content.pulse").pulse({
                'background-color':'rgb(252, 133, 133)',
            },
            {
                duration : 3250,
                pulses   : -1,
                interval : 1500
            });
        });

    });
</script>
@stop
