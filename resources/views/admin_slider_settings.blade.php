@extends('layout')

@section('title',"DONATIONS")

@section('content')

<div class="container-fluid container-fixed-lg bg-white">

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">Slider Images/div>
<div class="pull-right"><div class="col-xs-12"><input type="text" id="search-table" class="form-control pull-right" placeholder="Search"></div></div>
<div class="clearfix"></div>
</div>
<div class="panel-body">
<a class="btn btn-primary btn-cons m-t-10" href="{{url('admin/asi')}}">Upload New Slider Image</a>
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>Image #</th>
<th>Image</th>
<th>First Image?</th>
<th>Date uploaded</th>
<th>Actions</th>   
</tr>
</thead>
<tbody>
@foreach($ret as $r)
<tr>
 <td>{{$r['id']}}</td>              
 <td><img src="{{asset('slider/'.$r['image'])}}" alt="Slider Image" class="img img-responsive"></td>
 <td>{{$r['position']}}</td>
 <td>{{$r['uploaded_at']}}</td>     

   <?php
   $id = $r['id'];
   if($r["position"] == "random")
   {
       $url = array("first" => "Change to first","delete" => "Delete image");
    }         
   else if($r["position"] == "first")
   {
       $url = array("none" => "Remove from first","delete" => "Delete image");
    }              
                       
  ?>

 <td>
   <div class="btn-group" role="group" aria-label="...">
     @foreach($url as $key => $value)
        <?php $pu = url("admin/ssi/".$key."/".$id); ?>
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

<?php
$txt = "";
if(Session::has('slider-settings-status') && Session::get('slider-settings-status') == "success") $txt = "Slider Image settings have been UPDATED";
else if(Session::has('delete-slider-status') && Session::get('delete-slider-status') == "success") $txt = "Slider Image has been DELETED";
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