@extends('layout')

@section('title',"DONATIONS")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">
 
<div class="panel panel-transparent">
<div class="panel-heading">
<div class="panel-title">Donations
</div>
<div class="pull-right">
<div class="col-xs-12">
<input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>SN</th>
<th>DONATION FROM</th>
<th>DONATION TO</th>
<th>AMOUNT</th>
<th>DATE</th>
</tr>
</thead>
<tbody>
@if($donations->count() > 0)
@foreach($donations as $d)
<tr>
<td>{{$d->id}}</td>
<td>{{$names[$d->giver_id]}}</td>
<td>{{$names[$d->receiver_id]}}</td>
<td>{{$d->amount}}</td>
<td>{{$d->created_at->format('d-m-Y H:i A')}}</td>
</tr>
@endforeach
@endif
</tbody>
</table>
</div>
</div>
 
</div>
 
 
</div>
 
</div>

@stop