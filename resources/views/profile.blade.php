@extends('layout')

@section('title',"DONATIONS")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">PROFILE</h2>
                <p class="text-center wow fadeInDown">View and edit your profile information</p>
                
            </div>
            
            <!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
            	
             <form action="{{url('profile')}}" method="post" name="login-form" id="login-form">
             	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
            <div class="row">          
               <div class="col-sm-12">      
                  <div class="form-group">
                  	<label>Username</label>
                       <input type="text" required placeholder="your username (this cannot be changed later)" value="{{$user->username}}" class="form-control" id="username" name="username" disabled>
                  </div>
               </div>
            </div><hr>                   	
            <div class="row">          
               <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>First Name</label>
                       <input type="text" required placeholder="James" value="{{$user->first_name}}" class="form-control" name="fname">
                  </div>
               </div>
                <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>Last Name</label>
                       <input type="text" required placeholder="Bond" value="{{$user->last_name}}" class="form-control" name="lname">
                  </div>
               </div>             
            </div><hr>

            <div class="row">          
               <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>Email address</label>
                       <input type="email" required placeholder="you@example.org" value="{{$user->email}}" class="form-control" name="email">
                  </div>
               </div>
                <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>Phone Number</label>
                       <input type="text" required placeholder="Your phone number" value="{{$user->phone}}" class="form-control" name="phone" disabled>
                  </div>
               </div>             
            </div><hr>   

            <div class="row">          
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Bank Name</label>
                       <input type="text" required placeholder="Name your bank" value="{{$bank->bank_name}}" class="form-control" name="bname">
                  </div>
               </div>
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Account Name</label>
                       <input type="text" required placeholder="Bank account name" value="{{$bank->acc_name}}" class="form-control" name="acname">
                  </div>
               </div>               
                <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Account Number</label>
                       <input type="text" required placeholder="10-digit NUBAN" class="form-control" value="{{$bank->acc_num}}" name="acno" disabled>
                  </div>
               </div>             
            </div><hr>      


            <div class="row">          
               <div class="col-sm-12">      
                   <p>By clicking SUBMIT below you verify that you have read the <a href="{{url('warning')}}">WARNING</a> and also agree to the <a href="{{url('terms')}}" class="text-info small">Terms and Conditions</a> and <a href="{{url('privacy-policy')}}" class="text-info small">Privacy Policy</a>.</p>
               </div>
            </div><hr>     	   	
            <button class="btn btn-primary" type="submit">SUBMIT</button>
            </form>
           <br><br>                          
            
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>       
    </section><!--/#get-in-touch-->
    
    <?php
$txt = "";
if(Session::has('update-profile-status') && Session::get('update-profile-status') == "success") $txt = "Profile update COMPLETE";
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