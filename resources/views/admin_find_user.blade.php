@extends('layout')

@section('title',"FIND USER")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Find User</h2>
                <p class="text-center wow fadeInDown">Find a member of FundsForLife. </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif           
            
            <form action="{{url('admin/find-user')}}" method="post" name="contact-form" id="main-contact-form">
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