@extends('layout')

@section('title',"Vendors")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">
 
<div class="panel panel-transparent">
<div class="panel-heading">
<div class="panel-title">Vendors
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
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Contact</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>Joshua F.</td>
<td>faiboi@gmail.com</td>
<td>08086791398</td>
<td><a class="btn btn-success" href="mailto:faiboi@gmail.com">Contact Vendor</a></td>
</tr>
<tr>
<td>2</td>
<td>Hammed O.</td>
<td>hammedolabode@gnail.com</td>
<td>08085901051</td>
<td><a class="btn btn-success" href="mailto:hammedolabode@gnail.com">Contact Vendor</a></td>
</tr>
</tbody>
</table>
</div>
</div>
 
</div>
 
 
</div>
 
</div>

@stop