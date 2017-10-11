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
<a class="btn btn-primary btn-cons m-t-10" href="{{url('create-ticket')}}">Create new ticket</a>
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>Ticket #</th>
<th>Subject</th>
<th>Message</th>
<th>Date opened</th>
<th>Status</th>
</tr>
</thead>
<tbody>
@if(isset($tickets) && $tickets != null)
@if($tickets->count() > 0)
@foreach($tickets as $t)
<tr>
<td>{{$t->id}}</td>
<td>{{$t->subject}}</td>
<td>{{$t->message}}</td>
<td>{{$t->created_at->format('d-m-Y H:i A')}}</td>
<td>{{$t->status}}</td>
</tr>
@endforeach
@endif
@endif
</tbody>
</table>
</div>
</div>
 

</div>

<?php
$txt = "";
if(Session::has('create-ticket-status') && Session::get('create-ticket-status') == "success") $txt = "Ticket created successfully!  We will respond ASAP";
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