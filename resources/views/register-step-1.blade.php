@extends('layout')

@section('title',"Registration Step 1")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Step 1 - Activate Your Account</h2>
                <p class="text-center wow fadeInDown">To activate your account, please provide your activation PIN below. <a href="{{url('vendors')}}">Click here to purchase activation PINs from our accredited vendors if you don't have one</a>.<br>
                	Already have an account?  <a class="btn btn-primary" href="{{url('login')}}">LOGIN</a>
                </p>
                
            </div>
            
<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ["errors" => $errors])
                     @endif

                    @if (Session::has('step-1-status') && Session::get('step-1-status') == "success")                                    
                        <?php $u = "register-step-2/?grepo=".$grepo; ?>
					    <div class="alert alert-success" role="alert">
							<p><strong>Success!</strong> Proceeding to Step 2..</p><br><br>
							<script>setTimeout(' window.location.href = "{{url($u)}}"; ',3000);</script>
						</div>
						
					@elseif(Session::has('verify-status') && Session::get('verify-status') == "success")
					   <div class="alert alert-success" role="alert">
							<p><strong>Email address verified!</strong></p><br><br>
						</div>
					@endif
					
			       @if (Session::has('grepo'))
                    <?php $grepo = Session::get('grepo');?>               
                    @endif
            	
             <form action="{{url('register-step-1')}}" method="post" name="login-form" id="form-1-submit">
             	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
             	<input type="hidden" id = "grepo" name="grepo" value="{{ $grepo }}">   

            <div class="row">          
               <div class="col-sm-12">      
                  <div class="form-group">
                  	<label>Enter your activation PIN.</label>
                       <input type="password" required class="form-control" name="number" id="number" placeholder="Your Activation PIN" data-rule="number" data-msg="Please enter a valid Activation PIN" />
                  </div>
               </div>      
            </div><hr>   
	   	
            <button class="btn btn-primary" type="submit">Activate</button>
            </form>
           <br><br>                          
            <div class="row">          
               <div class="col-sm-12">      
               <div class="jumbotron">
                  <h2 class="display-3">Next Steps</h2>
  <p class="lead"><span aria-hidden="true" class="fa fa-lock" style="margin-right: 4px;"></span>Use activation PIN to activate your account.</p>
  <hr class="my-4">
  <p><span aria-hidden="true" class="fa fa-rocket" style="margin-right: 4px;"></span>Proceed to Step 2</p>
</div>
               </div>      
            </div><hr>   
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop