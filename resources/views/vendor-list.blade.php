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
<th>Phone</th>
<th>Contact</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>Vera</td>
<td>0806 982 7824</td>
<td><a class="btn btn-success" href="tel:+2348069827824">Contact Vendor</a></td>
</tr>
<tr>
<td>2</td>
<td>Olamide</td>
<td>0812 763 5294</td>
<td><a class="btn btn-success" href="tel:+2348127635294">Contact Vendor</a></td>
</tr>
<tr>
<td>3</td>
<td>Teni</td>
<td>0815 591 5820</td>
<td><a class="btn btn-success" href="tel:+23408155915820">Contact Vendor</a></td>
</tr>
</tbody>
</table>
</div>
</div>
 
</div>
 
 
</div>
 
</div>

@stop