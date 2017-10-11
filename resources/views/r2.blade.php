@extends('layout')

@section('title',"Activate Your Account")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Activate Your Account</h2>
                <p class="text-center wow fadeInDown">Your activation pin is expired, and ypur account has been temporarily deactivated. To activate your account, please provide your activation PIN below. <a href="{{url('vendors')}}">Click here to purchase activation PINs from our accredited vendors if you don't have one</a>.<br>
                </p>
                
            </div>
            
<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ["errors" => $errors])
                     @endif

                    @if (Session::has('r2-status') && Session::get('r2-status') == "success")                                    
					    <div class="alert alert-success" role="alert">
						    <?php $u = "login"; ?>
							<p><strong>Success!</strong> Proceeding to Login.</p><br><br>
							<script>setTimeout(' window.location.href = "{{url($u)}}"; ',3000);</script>
						</div>
					@endif
            	
             <form action="{{url('r2')}}" method="post" name="login-form" id="form-1-submit">
             	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">

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
  <p><span aria-hidden="true" class="fa fa-rocket" style="margin-right: 4px;"></span>Proceed to login</p>
</div>
               </div>      
            </div><hr>   
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop