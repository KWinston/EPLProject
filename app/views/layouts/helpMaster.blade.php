<table class="help-table">
    <tr>
        <td class="help-index-cell">@include('help.masterIndex', array(
                'function' => 'KitSelected',
                'side_menu_class' => 'button-bar-visible'
            ))</td>
        <td class="help-topic-cell">
            <!-- {{$selected_topic}} --> 
            @yield('topic')
        </td>
    </tr>
</table>
