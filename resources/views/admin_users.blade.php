@extends('layout')

@section('title',"USERS")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">All Users</div>
<div class="pull-right"><div class="col-xs-12"><input type="text" id="search-table" class="form-control pull-right" placeholder="Search"></div></div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>User #</th>
<th>Name</th>
<th>Username</th>
<th>Email</th>
<th>Package</th>
<th>Pin count</th>
<th>Bank name</th>
<th>Acct name</th>
<th>Acct number</th>
<th>Status</th>
<th>Role</th>
<th>Blocked?</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($ret as $r)
 <tr>
<td>{{$r['id']}}</td>
<td>{{$r['name']}}</td>
<td>{{$r['username']}}</td>
<td>{{$r['email']}}</td>
<td>{{$r['package']}}</td>
@if($r['pin'] == null)
<td>No pin</td>
@else
<td>{{$r['pin']->pin_count}}</td>
@endif
<td>{{$r['bank_name']}}</td>
<td>{{$r['acc_name']}}</td>
<td>{{$r['acc_num']}}</td>
<td>{{$r['status']}}</td>
<td>{{$r['role']}}</td>
<td>{{$r['blocked']}}</td>

 <?php
if($r["blocked"] == "no")
{
$url =url("admin/disable/".$r['id']); 
     $txt = "Disable";
     $class = "btn btn-danger";
 }
else if($r["blocked"] == "yes")
{
$url =url("admin/enable/".$r['id']); 
     $txt = "Enable";
     $class = "btn btn-primary";
     
 }

if($r["merged"] == "no")
{
$url2 =url("admin/merge/".$r['id']); 
     $txt2 = "Merge";
     $class2 = "btn btn-primary";
 }
else if($r["merged"] == "yes")
{
$url2 =url("admin/unmerge/".$r['id']); 
     $txt2 = "Unmerge";
     $class2 = "btn btn-info";
     
 } 
 ?>
                                            
<td>
<div class="btn-group" role="group">
  <a href="{{$url}}" class="{{$class}}" data-grepo="" role="button">{{$txt}}</a>
  <a href="{{$url2}}" class="{{$class2}}" data-grepo="" role="button">{{$txt2}}</a>
</td>           
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
 

</div>

<?php
$txt = "";
if(Session::has('enable-status') && Session::get('enable-status') == "success") $txt = "User has been ENABLED";
else if(Session::has('disable-status') && Session::get('disable-status') == "success") $txt = "User has been DISABLED";
else if(Session::has('merge-status') && Session::get('merge-status') == "success") $txt = "User has been MERGED";
else if(Session::has('unmerge-status') && Session::get('unmerge-status') == "success") $txt = "User has been UNMERGED";
?>
<input id="notif" value="<?php echo $txt; ?>" type="hidden">

@stop

@section('custom-scripts')
<script src="{{asset('fundsforlife/js/alerts.js')}}" type="text/javascript"></script>
<script>
       var notif = $('#notif').val();
       $(document).ready(function(){      
        var alertHTML = "<strong>" + notif + "</strong>.<br><br>";
       if(notif != "") showNotification('flip','FundsForLife',alertHTML,'top-right', 0,'success');
       });
    </script>
@stop