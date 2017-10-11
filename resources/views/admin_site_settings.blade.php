@extends('layout')

@section('title',"SITE SETTINGS")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">
 
<div class="panel panel-transparent">
<div class="panel-heading">
<div class="panel-title">Site Messages
</div>
<div class="pull-right">
<div class="col-xs-12">
<input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<a class="btn btn-primary btn-cons m-t-10" href="{{url('admin/asm')}}">Add New Site Message</a>
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>SN</th>
<th>Message</th>
<th>Position</th>
<th>Date</th>
<th>Actions</th>    
</tr>
</thead>
<tbody>
@foreach($ret as $r)
  <tr>
<td>{{$r['id']}}</td>              
<td>{{$r['message']}}</td>
<td>{{$r['in_use']}}</td>
<td>{{$r['date']}}</td>     

<?php
  $id = $r['id'];
  if($r["in_use"] == "header")
  {
  	$url = array("footer" => "Change to footer","none" => "Remove from header");
   }         
  else if($r["in_use"] == "footer")
  {
  	$url = array("header" => "Change to header","none" => "Remove from footer");
   }      
  else
  {
  	$url = array("header" => "Change to header","footer" => "Change to footer");
   }       
                       
 ?>
  
<td>
  <div class="btn-group" role="group" aria-label="...">
    @foreach($url as $key => $value)
       <?php $pu = url("admin/ssm/".$key."/".$id); ?>
        <a href="{{$pu}}" class="btn btn-default" role="button">{{$value}}</button>
    @endforeach
</td>   
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
 
</div>
 
 
</div>
 
</div>

<?php
$txt = "";
if(Session::has('site-settings-status') && Session::get('site-settings-status') == "success") $txt = "Site settings have been UPDATED";
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