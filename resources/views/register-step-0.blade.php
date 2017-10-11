@extends('layout')

@section('title',"Registration Step 0")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Registration - Step 0</h2>
                <p class="text-center wow fadeInDown">To begin your registration, please provide your full name and email address below. A verification email will be sent to you.<br>
                	Already have an account?  <a class="btn btn-primary" href="{{url('login')}}">LOGIN</a>
                </p>
                
            </div>
            
<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ["errors" => $errors])
                     @endif

                    @if (Session::has('step-0-status') && Session::get('step-0-status') == "success")
                    
                    @if (Session::has('grepo'))
                    <?php $grepo = Session::get('grepo');?>                
                   @endif
                   
                        <?php $u = "register-step-1/?grepo=".$grepo; ?>
					    <div class="alert alert-success" role="alert">
							<p><strong>Success!</strong> Click the verification link sent to your email to proceed. </p><br><br>
						</div>
					@endif
            	
             <form action="{{url('register-step-0')}}" method="post" name="login-form" id="form-0-submit">
             	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
             	
             <div class="row">          
               <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>First Name</label>
                       <input type="text" required placeholder="James" class="form-control" name="fname" value ="{{old('fname')}}">
                  </div>
               </div>
                <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>Last Name</label>
                       <input type="text" required placeholder="Bond" class="form-control" name="lname" value ="{{old('lname')}}">
                  </div>
               </div>             
            </div><hr>

            <div class="row">          
               <div class="col-sm-12">      
                  <div class="form-group">
                  	<label>Email address</label>
                       <input type="email" required placeholder="you@example.org" class="form-control" name="email" value ="{{old('email')}}">
                  </div>
               </div>      
            </div><hr>   
	   	
            <button class="btn btn-primary" type="submit">Submit</button>
            </form>
           <br><br>                          
            <div class="row">          
               <div class="col-sm-12">      
               <div class="jumbotron">
                  <h2 class="display-3">Next Steps</h2>
  <p class="lead"><span aria-hidden="true" class="fa fa-link" style="margin-right: 4px;"></span>Click the verification link in your email. </p>
  <hr class="my-4">
  <p><span aria-hidden="true" class="fa fa-lock" style="margin-right: 4px;"></span><a href="{{url('vendors')}}" target="_blank">Click here to buy activation PIN from our accredited vendors.</a></p>
  <hr class="my-4">
  <p><span aria-hidden="true" class="fa fa-rocket" style="margin-right: 4px;"></span>Proceed to Step 1</p>
</div>
               </div>      
            </div><hr>   
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop