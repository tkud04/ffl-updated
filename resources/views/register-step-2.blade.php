@extends('layout')

@section('title',"Registration Step 2")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Step 2 - Enter Your Phone Number</h2>
                <p class="text-center wow fadeInDown">To proceed with your registration, please provide your phone number below. A verification code will be sent to your phone number.<br>
                	Already have an account?  <a class="btn btn-primary" href="{{url('login')}}">LOGIN</a>
                </p>
                
            </div>
            
<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ["errors" => $errors])
                     @endif

                    @if (Session::has('step-2-status') && Session::get('step-2-status') == "success")
                    
                    @if (Session::has('grepo'))
                    <?php $grepo = Session::get('grepo');?>               
                    @endif
                    
                       <?php $u = "register-step-3/?grepo=".$grepo; ?>
					    <div class="alert alert-success" role="alert">
							<p><strong>Success!</strong> Proceeding to Step 3..</p><br><br>
							<script>setTimeout(' window.location.href = "{{url($u)}}"; ',3000);</script>
						</div>
					@endif
            	
             <form action="{{url('register-step-2')}}" method="post" name="login-form" id="form-1-submit">
             	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
             	 <input type="hidden" id = "grepo" name="grepo" value="{{ $grepo }}">

            <div class="row">          
               <div class="col-sm-12">      
                  <div class="form-group">
                  	<label>Enter your phone number.</label>
                       <input type="text" required placeholder="Your phone number" class="form-control" name="phone" value ="{{old('phone')}}">
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
  <p class="lead"><span aria-hidden="true" class="fa fa-lock" style="margin-right: 4px;"></span>Verification code will be sent to your phone number.</p>
  <hr class="my-4">
  <p><span aria-hidden="true" class="fa fa-rocket" style="margin-right: 4px;"></span>Proceed to Step 3</p>
</div>
               </div>      
            </div><hr>   
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop