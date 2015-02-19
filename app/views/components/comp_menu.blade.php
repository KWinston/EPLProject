{{ HTML::style("plugins/jstree_2_2_0_treeview/themes/default/style.css") }}
{{ HTML::style('css/comp-menu.css') }}

<div class="side-menu {{$side_menu_class}}">
    <div class="search-menu">
        <p>Search for Kit</p>
        <input type="text" id="tree-menu-search"/>
    </div>
    <div id="tree-menu">
    </div>
</div>

{{ HTML::script('plugins/jstree_2_2_0_treeview/jstree.min.js',
    array('type' => 'text/javascript')) }}
<script type="text/javascript">
    var time_out = false;
    var selected_node_value = null;
    var setSelectedNode = function(id){ $('#tree-menu').jstree().select_node(id); }
    var getSelectedNode = function() { return selected_node_value; }
    $('#tree-menu').jstree({
        "core" : {
            "animation" : 250,
            "check_callback" : true,
            "themes" : {
                "name" : "default",
                "icons" : false
             },
            'data' : {{ GetKitTypeTreeData() }},
        },
        "plugins" : [
            "themes",
            "search",
            "wholerow"
        ]
    });

	$('#tree-menu').on("changed.jstree", function (e, data) {
		console.log('change');
		selected_node_value = data.instance.get_node(data.selected[0]);
		var target = "{{ $function }}";
		var fn = window[target];

    $('#tree-menu-search').keyup(function () {
        if(time_out) {
            clearTimeout(time_out);
        }
        time_out = setTimeout(function () {
            var value = $('#tree-menu-search').val();
            $('#tree-menu').jstree().search(value);
            console.log(value);
        }, 250);
    });
</script>
