@extends('layout')

@section('title',"FIND DONATION")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Find Donation</h2>
                <p class="text-center wow fadeInDown">Find specific information about a donation made on FundsForLife. </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
             	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif           	
            
            <form action="{{url('admin/find-donation')}}" method="post" name="contact-form" id="main-contact-form">

                     <input type="hidden" name="_token" value="{{ csrf_token() }}">              
                                <div class="form-group">
                                       	<input type="text" name="username" placeholder="Enter username here" class="form-control" value ="{{old('username')}}" required>
                                </div>
                                <button class="btn btn-primary" type="submit">SUBMIT </button>
                            </form><br>
                            	
@if(Session::has("find-donation-status") && Session::get("find-donation-status") == "success")
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-body">
<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
<thead>
<tr>
<th>Donation #</th>
<th>Giver</th>
<th>Receiver</th>
<th>Amount</th>
<th>Valid?</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>
<tbody>
@if(isset($ret) && count($ret) > 0)
@foreach($ret as $r)
<tr>
<td>{{$r['id']}}</td>
<td>{{$r['giver']}}</td>
<td>{{$r['receiver']}}</td>
<td>{{$r['amount']}}</td>
<td>{{$r['valid']}}</td>
<td>{{$r['status']}}</td>
<td>{{$r['date']}}</td>
</tr>
@endforeach
@endif
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