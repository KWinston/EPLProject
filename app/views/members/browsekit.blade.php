@extends('layouts.master')

@section('head')

@stop

@section('content')

@foreach ($kits as $kit)

<div class=browse-kit-block id="tooltip">
	{{ $kit->Name }}
</div>

@endforeach

@stop
