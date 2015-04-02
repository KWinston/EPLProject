@extends('layouts.master')
@section('head')
@stop


@section('content')

@foreach ($kits as $kit)
<style>
.ui-tooltip
{
	width:500px;
	min-width:500px;
}
.ui-tooltip-content
{
}

</style>

    <div class=browse-kit-block>
        {{ $kit->Name }}
    </div>
    <script>
// function makeKitToolTip("$kit")
// {
//     str = "<table class='tooltip-branch'>";
//     str += "<tr>";
//     str += "<td class='tooltip-header'>Name</td>";
//     str += "<td class='tooltip-value'>" + branches[branchID].Name + "</td>";
//     str += "</tr>";
//     str += "<tr>";
//     str += "<td class='tooltip-header'>Address</td>";
//     str += "<td class='tooltip-value'>" + branches[branchID].Address + "</td>";
//     str += "</tr>";
//     str += "<tr>";
//     str += "<td class='tooltip-header'>Phone</td>";
//     str += "<td class='tooltip-value'>" + branches[branchID].PhoneNumber + "</td>";
//     str += "</tr>";
//     str += "</table>";
//     return str;
// }
    </script>
@endforeach


@stop
