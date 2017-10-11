@extends('layout')

@section('title',"PACKAGES")

@section('content')


<div class="container-fluid container-fixed-lg bg-white">

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">Packages</div>
<div class="pull-right"><div class="col-xs-12"><input type="text" id="search-table" class="form-control pull-right" placeholder="Search"></div></div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>Package #</th>
<th>Name</th>
<th>Price</th>
<th>Enabled?</th>
<th>Date added</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($ret as $r)
<tr>
<td>{{$r['id']}}</td>              
<td>{{$r['name']}}</td>
<td>{{$r['price']}}</td>
<td>{{$r['enabled']}}</td>
<td>{{$r['date']}}</td>     
  <?php
  $id = $r['id'];
  if($r["enabled"] == "yes")
  {
  	$url = url("admin/dp/".$id); $v = "Disable";
   }         
  else if($r["enabled"] == "no")
  {
  	$url = url("admin/ep/".$id); $v = "Enable";
   }      
  else
  {
  	$url = array("header" => "Change to header","footer" => "Change to footer");
   }       
                       
 ?>
                                            
<td> <a href="{{$url}}" class="btn btn-default" role="button">{{$v}}</a></td>   
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
 

</div>

<?php
$txt = "";
if(Session::has('enable-status') && Session::get('enable-status') == "success") $txt = "Package has been ENABLED";
else if(Session::has('disable-status') && Session::get('disable-status') == "success") $txt = "Package has been DISABLED";
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