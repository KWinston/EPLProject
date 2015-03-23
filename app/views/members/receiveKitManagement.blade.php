@extends('layouts.master')

@section('head')
{{ HTML::style('css/comp-menu.css') }}
<script type="text/javascript">
    function SelectReceiveKit(kitTypeID)
    {
        $(".receive-kit-name.selected").removeClass("selected");
        $(this).addClass("selected");
        url = "{{ route('recieve_kit.edit', array(':KITTYPEID')) }}";
        url = url.replace(':KITTYPEID', kitTypeID);

        $("#receive-kit-edit").load(url, function()
        {
            $(".receive-kit-submit").unbind().button({'disable': true}).click(function()
            {
                $.post("{{ route('recieve_kit.store') }}", $('.receive-kit-edit-form').serialize(), function( data )
                {
                    typeID = $('.receive-kit-edit-form [name="ID"]').val();
                    $(".receive-kit-name#" + typeID).html($('.receive-kit-edit-form [name="Name"]').val());
                });
                return false;
            });
            $(".kit-type-destroy").unbind().button().click(function()
            {
                typeID = $('.receive-kit-edit-form [name="ID"]').val();
                url = "{{ route('recieve_kit.destroy', array(':KITTYPEID')) }}";
                url = url.replace(':KITTYPEID', typeID);

                if (confirm("\nThis will destroy this type, and all kits of this type "
                            + "\nas well the logs for this type (and kits of this type) will no longer be accessible!"
                            + "\n\nAre you sure you which to destroy the '" + $(".receive-kit-edit-form input#Name").val() + "' type and associated kits?"
                            ) === true)
                {
                    // remove the list entry
                    $.ajax(
                    {
                        url: url,
                        type: 'DELETE',
                        success: function(result)
                        {
                            $(".receive-kit-name#" + typeID).remove();
                            $("#receive-kit-edit").html('');
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
<div class="receive-kit-branch">
{{ $branch->Name }} Kits Awaiting Reception
</div>
<table cellpadding="0" style="height: 95%; width:99%" >
    <tr>
        <td style="vertical-align: top; width:10%">
            <div class="receive-kit-side-menu content" style="display: table;">
                <ul> <u><b>Select Kit</b></u>
                </ul>
                <ul ID="receive-kit-list">
                    @foreach($receiveKits as $rk)
                        @if($rk->KitID != 0)
                            <li class="receive-kit-name" ID="{{$rk->BookingID}}">{{$rk->KitName}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </td>
        <td style="vertical-align: top; width:50%">
            <div id="receive-kit-edit" class="content">
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
    $(function()
    {
        $(".receive-kit-name").unbind().click(function(){ SelectReceiveKit(this.id); });
    })
</script>
@stop
