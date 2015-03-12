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
    var treeMenu;

	var time_out = false;
	var selected_node_value = null;

	function setSelectedNode(id) {
		$('#tree-menu').jstree().select_node(id);
	}

	function getSelectedNode() {
		return selected_node_value;
	}

    function setKitID() {

    }

    $(document).ready(function() {
    	treeMenu = $('#tree-menu').jstree({
    	  	"core" : {
    	    	"animation" : 250,
    	    	"check_callback" : function() {
                    console.log('asdad');
                    return true;
                },
    	    	"themes" : {
    	    		"name" : "default",
    	    		"icons" : false
    	    	 },
    	    	'data' : {{  GetKitTypeTreeData() }},
    		},
    	  	"plugins" : [
    	  		"themes",
    	  		"search",
    	  		"wholerow",
                'dnd'
    	    ]
    	});

        /*
        $(document).on('dnd_start.vakata', function(e, data) {
            console.log('Started dragging node from jstree');
        });
        $(document).on('dnd_move.vakata', function(e, data) {
            console.log('Moving node from jstree to div');
        });
        $(document).on('dnd_stop.vakata', function(e, data) {
            console.log(e);
            console.log(data);
            if (data.event.target.id === 'calendar') {
                console.log('drop on cal');
            }
        });
        */

    	$('#tree-menu').on("changed.jstree", function (e, data) {
    		selected_node_value = data.instance.get_node(data.selected[0]);
    		var target = "{{ $function }}";
    		var fn = window[target];
            if(typeof fn === 'function')
            {
                if (!selected_node_value)
                {
                    fn(null, null, null, null);
                }
                else
                {
                    var val = selected_node_value.original;
                    if (val.type === "TYPE")
                        fn(val.KitTypeID, selected_node_value.text, val.type, val);
                    else
                       fn(val.KitID, selected_node_value.text, val.type, val); 
                }
            }
        else
            console.log("function not defined: " + target);
        });

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
    });
</script>
