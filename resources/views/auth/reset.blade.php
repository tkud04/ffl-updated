@extends('layout')

@section('title',"RESET PASSWORD")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">RESET PASSWORD </h2>
                <p class="text-center wow fadeInDown">Enter your new password.
                </p>
            </div>
            
            <!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
                     
    @if(Session::has('reset-status') && Session::get('reset-status') == "success")
						<center><div class="alert alert-success" role="alert">
							<p><strong>A reset link has been sent to your email address</strong>.</p><br><br>
						</div></center>                
@endif
            
            <div class="row">
            <div class="col-sm-6">
               <img src="{{asset('fundsforlife/images/bird.jpg')}}" alt="Login" class="img img-responsive">
            </div>
            
            <div class="col-sm-6">
            	
            
            
            <form action="{{ url('/password/reset') }}" method="post" name="reset-form" id="reset-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="token" value="{{ $token }}">

            <div class="row">          
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Email address</label>
                       <input type="email" required placeholder="your email address" class="form-control" name="email">
                  </div>
               </div>
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Choose New Password</label>
                       <input type="password" required placeholder="Minimum of 6 Characters" class="form-control" id="pass" name="pass">
                  </div>
               </div>               
                <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Confirm New Password</label>
                       <input type="password" required placeholder="Minimum of 6 Characters" class="form-control" id="pass_confirmation" name="pass_confirmation">
                  </div>
               </div>             
            </div><hr>      
	   	
            <button class="btn btn-primary" type="submit">RESET PASSWORD</button>
            </form>
           <br><br>      
            </div>
            
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop