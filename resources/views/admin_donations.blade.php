@extends('layout')

@section('title',"DONATIONS")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">Donations</div>
<div class="pull-right"><div class="col-xs-12"><input type="text" id="search-table" class="form-control pull-right" placeholder="Search"></div></div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>SN</th>
<th>Giver</th>
<th>Receiver</th>
<th>Amount</th>
<th>Valid?</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>
<tbody>
@if(isset($donations) && count($donations) > 0)
@foreach($donations as $r)
<tr>
<td>{{$r['id']}}</td>
<td>{{$r['giver']}}</td>
<td>{{$r['receiver']}}</td>
<td>{{$r['amount']}}</td>
<td>{{$r['valid']}}</td>
<td>{{$r['status']}}</td>
<td>{{$r['date']}}</td>
</tr>
@endforeach
@endif
</tbody>
</table>
</div>
</div>
 

</div>

@stop