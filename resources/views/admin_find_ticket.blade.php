@extends('layout')

@section('title',"FIND TICKET")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Find Ticket</h2>
                <p class="text-center wow fadeInDown">Find specific information about a ticket created on FundsForLife. </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
            
            <form action="{{url('admin/find-ticket')}}" method="post" name="contact-form" id="main-contact-form">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">                
                                <div class="form-group">
                                       	<input type="text" name="username" placeholder="Enter username here" class="form-control" value ="{{old('username')}}" required>
                                </div>
                                <button class="btn btn-primary" type="submit">SUBMIT </button>
                            </form><br>
                            	
@if(Session::has("find-ticket-status") && Session::get("find-ticket-status") == "success")
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default">
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
</div>         	
@endif         
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop