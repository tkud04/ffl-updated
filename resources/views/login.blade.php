@extends('layout')

@section('title',"LOGIN")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">LOGIN</h2>
                <p class="text-center wow fadeInDown">Sign into your FundsForLife account</p>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                    @if (Session::has('verify-status') && Session::get('verify-status') == "success")
					    <div class="alert alert-success" role="alert">
							<p><strong>Account verified!</strong> You can now login.</p><br><br>
						</div>
					@endif              	
               </div>
           </div>
            
            <div class="row">
            <div class="col-sm-6">
               <img src="{{asset('fundsforlife/images/bird.jpg')}}" alt="Login" class="img img-responsive">
            </div>
            
            <div class="col-sm-6">
            
            <form action="#" method="post" name="login-form" id="login-form">
            	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <input type="text" required placeholder="User Name" class="form-control" name="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" required placeholder="Password" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                	<div class="">
                                      <input type="checkbox" value="1" id="checkbox1">
                                      <label for="checkbox1">Keep Me Signed in</label>
                                    </div>
                                    <ul class="list-inline text-center">
                                    	<li><a href="{{ url('/password/email') }}" class="form-control text-info small">Forgot Password?</a></li>
                                        <li><a href="{{url('forgot-username')}}" class="form-control text-info small">Forgot Username?</a></li>
                                    </ul>
                                </div>
                                <button class="btn btn-primary" type="submit">LOGIN</button>
                            </form>
                            <br><br>
                            Don't have an account?  <a class="btn btn-primary" href="{{url('register-step-0')}}">REGISTER</a>
            </div>
            
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop

@section('custom-scripts')

<script>
    /* login submit */
    function submitForm()
    {  
   var data = $("#login-form").serialize();
    
   $.ajax({
    
   type : 'POST',
   url  : "{{url('login')}}",
   data : data,
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#working").html('<br><br><div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-2x slow-spin"></i>  Validating Your Data.... </strong></div>');
   },
   success :  function(response)
      {      
        $('#response-div').addClass("alert").addClass("alert-danger");
        $('#response-div').html(response);
  
     if(response=="ok"){
      $("#working").html('<br><br><div class="alert alert-success alert-dismissable"><strong class="block"> <i class="fa fa-check"></i> &nbsp; Success! Redirecting to Dashboard...</strong></div>');
     setTimeout(' window.location.href = "dashboard"; ',3000);
     }
     else if(response=="disabled"){
      $("#working").html('<br><br><div class="alert alert-danger alert-dismissable"><strong class="block"> <i class="fa fa-check"></i> &nbsp; Your account has been disabled.</strong></div>');
     }
     else if(response=="deactivated"){
      $("#working").html('<br><br><div class="alert alert-danger alert-dismissable"><strong class="block"> <i class="fa fa-check"></i> &nbsp; Your account has been temporarily deactivated. You need to buy activation pin to login.</strong></div>');
      setTimeout(' window.location.href = "r2"; ',3000);
     }     
     else if(response=="unverified"){
      $("#working").html('<br><br><div class="alert alert-danger alert-dismissable"><strong class="block"> <i class="fa fa-check"></i> &nbsp; Please check your email to verify your account.</strong></div>');
     }
     else if(response=="invalid"){
      $("#working").html('<br><br><div class="alert alert-danger alert-dismissable"><strong class="block"> <i class="fa fa-check"></i> &nbsp; Invalid username or password.</strong></div>');
     }
     else if(response=="admin"){
      $("#working").html('<br><br><div class="alert alert-success alert-dismissable"><strong class="block"> <i class="fa fa-check"></i> &nbsp; Welcome Admin! Redirecting to Admin panel...</strong></div>');
      setTimeout(' window.location.href = "admin/dashboard"; ',3000);
     }     
     else{
         
      $("#error").fadeIn(1000, function(){      
    $("#error").html('<br><br><div class="alert alert-danger"> '+response+'</div>');
           $("#working").html('');
         });
     }
     
     }
   });
    return false;
  }
    /* login submit */
    
    
    
   $(document).ready(function(){ 
     /* validation */
  $("#login-form").submit(function(e){
  	e.preventDefault();
     submitForm();
  });
});

</script>
@stop