@extends('layouts.master')
@section('head')
	<script type="text/javascript">
	function callback(value)
	{
		alert("value: " + value);
	}

	</script>
@stop

@section('content')
	@include('components.comp_menu', array(
		'json' => 
			'[{
				"id"    : "#",
				"text"  : "root",
				"state" : {
					"opened" : false
				},
				"children" : [
					"test 1",
					{
						"id"    : "root2",
						"text"  : "root2",
						"state" : {
							"opened" : false
						},
						"children" : [
							"test 1",
							"test 2"
						]
					}
				]

			}]',
		'field' => 'text',
		'function' => 'callback'
    ))
	<div>
		<p>This is a test for home page</p>
	</div>
@stop
