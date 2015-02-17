<link rel="stylesheet" href="plugins/jstree_2_2_0_treeview/themes/default/style.css" />
{{ HTML::style('css/menu-treeview.css') }}

<div class="side-menu">
	<div class="search-menu">
		<p>Search for Kit</p>
		<input type="text" id="tree-menu-search"/>
	</div>
	<div id="tree-menu">
	</div>
</div>

<script src="plugins/jstree_2_2_0_treeview/jstree.min.js"></script>
<script type="text/javascript">
	var to = false;

	$('#tree-menu').jstree({
	  	"core" : {
	    	"animation" : 250,
	    	"check_callback" : true,
	    	"themes" : {
	    		"name" : "default",
	    		"icons" : false
	    	 },
	    	'data' : {{ $json }},
		},
	  	"plugins" : [
	  		"themes", 
	  		"search",
	  		"wholerow"
	    ]
	});

	$('#tree-menu').on("changed.jstree", function (e, data) {
		var value = "";
		if("{{ $field }}" === "id")
			value = data.instance.get_node(data.selected[0]).id;
		else
			value = data.instance.get_node(data.selected[0]).text;

		var target = "{{ $function }}";
		var fn = window[target];
		if(typeof fn === 'function') {
    		fn(value);
		}
		else
			console.log("function not defined: " + target);
	});

	$('#tree-menu-search').keyup(function () {
    	if(to) { 
    		clearTimeout(to); 
    	}
	    to = setTimeout(function () {
	      	var value = $('#tree-menu-search').val();
	      	$('#tree-menu').jstree().search(value);
	      	console.log(value);
	    }, 250);
	});
</script>

