@extends('layout')

@section('title',"Activation Pins")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">Activation Pins</div>
<div class="pull-right"><div class="col-xs-12"><input type="text" id="search-table" class="form-control pull-right" placeholder="Search"></div></div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<a class="btn btn-primary btn-cons m-t-10" href="{{url('admin/generate-activation-pin')}}">Generate New Activation Pin</a>
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th> #</th>
<th>Pin</th>
<th>Used By</th>
<th>Valid</th>
<th>Counts left</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($pins as $r)
<tr>
 <td>{{$r['id']}}</td>
 <td>{{$r['number']}}</td>
 <td>{{$r['used_by']}}</td>
 <td>{{$r['valid']}}</td>
 <td>{{$r['pin_count']}}</td>
 <td>{{$r['date']}}</td>     

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