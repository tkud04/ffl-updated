@extends('layout')

@section('title',"FIND USER")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Make User Eligible</h2>
                <p class="text-center wow fadeInDown">Find a member of FundsForLife. </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
            
            <form action="{{url('admin/find-eligible')}}" method="post" name="contact-form">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">                
                                <div class="form-group">
                                       	<input type="text" name="username" placeholder="Enter username here" class="form-control" value ="{{old('username')}}" required>
                                </div>
                                <button class="btn btn-primary" type="submit">SUBMIT </button>
                            </form><br>
                            	
  @if(Session::has("find-user-status") && Session::get("find-user-status") == "success")
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-body">
@if(!isset($ret))
<div class="alert alert-danger alert-dismissable" role="alert"><strong>Oops! An error occured. Please reload this page.</strong></div>
@elseif(count($ret) < 1)
<div class="alert alert-danger alert-dismissable" role="alert"><strong>No user was found with that username</strong></div>
@else
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>User #</th>
<th>Name</th>
<th>Username</th>
<th>Email</th>
<th>Package</th>
<th>Bank name</th>
<th>Acct name</th>
<th>Acct number</th>
<th>Status</th>
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
<td>{{$r['bank_name']}}</td>
<td>{{$r['acc_name']}}</td>
<td>{{$r['acc_num']}}</td>
<td>{{$r['status']}}</td>
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
 ?>
                                            
<td>
<div class="btn-group" role="group">
  <a href="{{$url}}" class="{{$class}}" data-grepo="" role="button">{{$txt}}</a>
</td>           
</tr>
@endforeach
</tbody>
</table>

             <form action="{{url('admin/make-eligible')}}" method="post" name="contact-form">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">                
                              <?php 
                             $grepo = null;
                              if(Session::has("grepo"))
                              {
                              	$g = Session::get("grepo");
                              }   
                             ?>
                      	<input type="hidden" name="grepo" value="{{$g}}">           
                                <div class="form-group">
    	  <select class="cs-select cs-skin-slide form-control" name="plan" data-init-plugin="">
           @foreach($packages as $p)
              <option value = "{{$p->id}}">{{$p->price}}</option>
           @endforeach
          </select>                               	
                                </div>
                                
                                  <div class="form-group">
<ul class="list-inline">
<li>
<label>Make User Eligible:</label>
 <input type="checkbox" class="form-control" data-init-plugin="switchery" data-size="large" data-color="primary" name="mu"/>
</li>
<li>
<label>Take to the front of queue:</label>
 <input type="checkbox" class="form-control" data-init-plugin="switchery" data-size="large" data-color="primary" name="fq"/>
</li>
<li>
<label>Remain:</label>
<input type="checkbox" class="form-control" data-init-plugin="switchery" data-size="large" data-color="primary" name="rfq"/>
</li>
</ul>
                                  </div>
                                <button class="btn btn-primary" type="submit">SUBMIT </button>
                            </form><br>                      
@endif
</div>
</div>       
</div>
</div>         	
@endif         
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->

<?php
$txt = "";
if(Session::has('make-eligible-status') && Session::get('make-eligible-status') == "success") $txt = "User has been made ELIGIBLE";
else if(Session::has('make-eligible-status') && Session::get('make-eligible-status') == "error") $txt = "User could not be made ELIGIBLE";
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