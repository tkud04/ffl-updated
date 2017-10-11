@extends('layout')

@section('title',"SUPPORT TICKETS")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">Support Tickets</div>
<div class="pull-right"><div class="col-xs-12"><input type="text" id="search-table" class="form-control pull-right" placeholder="Search"></div></div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>Ticket #</th>
<th>Username</th>
<th>Subject</th>
<th>Message</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($ret as $r)
<tr>
 <td>{{$r['id']}}</td>
 <td>{{$r['username']}}</td>
 <td>{{$r['subject']}}</td>
 <td>{{$r['message']}}</td>
 <td>{{$r['status']}}</td>
 <td>{{$r['date']}}</td>     

<?php
   if($r["status"] == "pending")
   {
   	$url =url("st/".$r['id']); 
        $txt = "Solve";
        $class = "btn btn-primary";
    }         
    
   else
   {
   	$url ="#";
        $txt = "Solved";
        $class = "btn btn-success";
    }             
                       
  ?>

 <td><a href="{{$url}}" class="{{$class}}" data-grepo="" role="button">{{$txt}}</a></td>    
 </tr>
@endforeach
</tbody>
</table>
</div>
</div>
 

</div>

<?php
$txt = "";
if(Session::has('solve-ticket-status') && Session::get('solve-ticket-status') == "success") $txt = "Ticket has been marked as SOLVED";
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