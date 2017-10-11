@extends('layout')

@section('title',"DONATIONS")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">
 
<div class="panel panel-transparent">
<div class="panel-heading">
<div class="panel-title">Referrals
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
<th>ID</th>
<th>Referral</th>
<th>Active?</th>
<th>Status</th>
<th>Date joined</th>
</tr>
</thead>
<tbody>

</tbody>
</table>
</div>
</div>
 
</div>
 
 
</div>
 
</div>

@stop