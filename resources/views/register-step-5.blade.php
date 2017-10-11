@extends('layout')

@section('title',"Registration Step 5")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Step 5 - Choose your username and password</h2>
                <p class="text-center wow fadeInDown">Choose your username and password to complete your registration.<br>
                	Already have an account?  <a class="btn btn-primary" href="{{url('login')}}">LOGIN</a>
                </p>
                
            </div>
            
<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ["errors" => $errors])
                     @endif                                    

                    @if (Session::has('step-5-status') && Session::get('step-5-status') == "success")
                       <?php $u = "/"; ?>
					    <div class="alert alert-success" role="alert">
							<p><strong>Registration was successful!</strong> You can now login..</p><br><br>
							<script>setTimeout(' window.location.href = "{{url($u)}}"; ',3000);</script>
						</div>
					@endif
            	
             <form action="{{url('register-step-5')}}" method="post" name="login-form" id="form-1-submit">
             	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
             	<input type="hidden" id = "grepo" name="grepo" value="{{ $grepo }}">
                 

            <div class="row">          
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Choose a Username</label>
                       <input type="text" required placeholder="your username (this cannot be changed later)" class="form-control" id="username" name="username" value ="{{old('username')}}">
                  </div>
               </div>
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Choose a Password</label>
                       <input type="password" required placeholder="Minimum of 6 Characters" class="form-control" id="pass" name="pass">
                  </div>
               </div>               
                <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Re-enter password</label>
                       <input type="password" required placeholder="Minimum of 6 Characters" class="form-control" id="pass_confirmation" name="pass_confirmation">
                  </div>
               </div>             
            </div><hr>      
            	
           <div class="row">
<div class="col-sm-12">
<div class="form-group form-group-default">
<label>Verify that you're human</label>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="g-recaptcha" data-sitekey="6LdG-ywUAAAAAOnX_4I0ZXN_qcfunVOOejGjuU8m"></div>
</div>
</div>
</div><hr>


            <div class="row">          
               <div class="col-sm-12">      
                   <p>By signing up you verify that you have read the <a href="{{url('warning')}}">WARNING</a> and also agree to the <a href="{{url('terms')}}" class="text-info small">Terms and Conditions</a> and <a href="{{url('privacy-policy')}}" class="text-info small">Privacy Policy</a>.</p>
               </div>
            </div><hr>     	   
	   	
            <button class="btn btn-primary" type="submit">Submit</button>
            </form>
           <br><br>                          
            <div class="row">          
               <div class="col-sm-12">      
               <div class="jumbotron">
                  <h2 class="display-3">Next Steps</h2>
  <p class="lead"><span aria-hidden="true" class="fa fa-lock" style="margin-right: 4px;"></span>Wait for confirmation.</p>
  <hr class="my-4">
  <p><span aria-hidden="true" class="fa fa-rocket" style="margin-right: 4px;"></span>Start donating!</p>
</div>
               </div>      
            </div><hr>   
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop