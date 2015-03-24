@extends('layouts.master')

@section('head')
{{ HTML::style('css/comp-menu.css') }}
{{ HTML::style('css/kitTransportation.css') }}

<script type="text/javascript">
    function SelectReceiveKit(kitTypeID)
    {
        $(".receive-kit-name.selected").removeClass("selected");
        $(this).addClass("selected");
        url = "{{ route('recieve_kit.edit', array(':KITTYPEID')) }}";
        url = url.replace(':KITTYPEID', kitTypeID);

        $("#receive-kit-edit").load(url, function()
        {
            $(".kit-submit").unbind().button({'disable': true}).click(function()
            {
                $.post("{{ route('recieve_kit.store') }}", $('.receive-kit-edit-form').serialize(), function( data )
                {
                    typeID = $('.receive-kit-edit-form [name="ID"]').val();
                    $(".receive-kit-name#" + typeID).html($('.receive-kit-edit-form [name="Name"]').val());
                });
                return false;
            });
        })
    }
    function SelectShipKit(kitTypeID)
    {
        $(".send-kit-name.selected").removeClass("selected");
        $(this).addClass("selected");
        url = "{{ route('ship_kit.edit', array(':KITTYPEID')) }}";
        url = url.replace(':KITTYPEID', kitTypeID);

        $("#receive-kit-edit").load(url, function()
        {
            $(".kit-submit").unbind().button({'disable': true}).click(function()
            {
                $.post("{{ route('ship_kit.store') }}", $('.send-kit-edit-form').serialize(), function( data )
                {
                    typeID = $('.send-kit-edit-form [name="ID"]').val();
                    $(".send-kit-name#" + typeID).html($('.send-kit-edit-form [name="Name"]').val());
                });
                return false;
            });
        })
    }
</script>
@stop
@section('content')

<div class="receive-kit-branch">
{{ $branch->Name }} Operations
</div>
<table cellpadding="0" style="height: 95%; width:99%" >
    <tr>
        <td style="vertical-align: top; width:10%">
            <div class="receive-kit-side-menu content" style="display: table;">
            @if($receiveKits != null)
                <ul> <u><b>Receive Kit:</b></u>
                </ul>
                <ul ID="receive-kit-list">
                    @foreach($receiveKits as $rk)
                        @if($rk->KitID != 0)
                            <li class="receive-kit-name" ID="{{$rk->BookingID}}">{{$rk->KitName}}</li>
                        @endif
                    @endforeach
                </ul>
            @endif
            @if($sendKits != null)
                <ul> <u><b>Send Kit:</b></u>
                </ul>
                <ul ID="receive-kit-list">
                    @foreach($sendKits as $sk)
                        @if($sk->KitID != 0)
                            <li class="send-kit-name" ID="{{$sk->BookingID}}">{{$sk->KitName}}</li>
                        @endif
                    @endforeach
                </ul>
            @endif
            @if($receiveKits == null && $sendKits == null)
            <div class="no-kit-message">
            No kits to send or receive right now.
            </div>
            @endif
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
        $(".send-kit-name").unbind().click(function(){ SelectShipKit(this.id); });
        $(".receive-kit-name").unbind().click(function(){ SelectReceiveKit(this.id); });
        var loadKitID = null;
        @if(isset($findKitID))
            loadKitID = {{$findKitID}};
        @endif     
        if(loadKitID)
        {
            @if ($mode == 'receive' )
                SelectReceiveKit(loadKitID);
            @else
                SelectShipKit(loadKitID);
            @endif
        }
    })
</script>
@stop
