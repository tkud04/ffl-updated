@extends('layout')

@section('title',"REGISTER")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">REGISTER</h2>
                <p class="text-center wow fadeInDown">FundsForLife makes it easy to enjoy what matters most in your life! <br>
                	Already have an account?  <a class="btn btn-primary" href="{{url('login')}}">LOGIN</a>
                </p>
                
            </div>
            
<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ["errors" => $errors])
                     @endif

                    @if (Session::has('signup-status') && Session::get('signup-status') == "success")
					    <div class="alert alert-success" role="alert">
							<p><strong>Signup complete!</strong> Please check your email to verify your account.</p><br><br>
						</div>
					@endif
            	
             <form action="{{url('register')}}" method="post" name="login-form" id="login-form">
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
               <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>Email address</label>
                       <input type="email" required placeholder="you@example.org" class="form-control" name="email" value ="{{old('email')}}">
                  </div>
               </div>
                <div class="col-sm-6">      
                  <div class="form-group">
                  	<label>Phone Number</label>
                       <input type="text" required placeholder="Your phone number" class="form-control" name="phone" value ="{{old('phone')}}">
                  </div>
               </div>             
            </div><hr>   

            <div class="row">          
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Bank Name</label>
                       <input type="text" required placeholder="Name your bank" class="form-control" name="bname" value ="{{old('bname')}}">
                  </div>
               </div>
               <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Account Name</label>
                       <input type="text" required placeholder="Bank account name" class="form-control" name="acname" value ="{{old('acname')}}">
                  </div>
               </div>               
                <div class="col-sm-4">      
                  <div class="form-group">
                  	<label>Account Number</label>
                       <input type="text" required placeholder="10-digit NUBAN" class="form-control" name="acno" value ="{{old('acno')}}">
                  </div>
               </div>             
            </div><hr>      
           
           <?php 
              $pid = ""; if(Session::has("pid")) $pid = Session::get("pid");
            ?>
           <div class="row">          
               <div class="col-sm-12">      
                  <div class="form-group">
                  	<label>How much are you willing to donate today? </label>
                       <select value="{{$pid}}" required class="form-control" id="plan" name="plan">
                       	@foreach($availablePackages as $ap)
                               @if($ap["enabled"] == "yes")
                                  @if($ap["id"] == $pid)
                                   <option value="{{$ap['id']}}" selected>{{$ap['name']}} - &#8358;{{$ap['price']}}</option>
                                  @else
                                   <option value="{{$ap['id']}}">{{$ap['name']}} - &#8358;{{$ap['price']}}</option>
                                  @endif
                               @endif
                            @endforeach
                       </select>
                  </div>
               </div>
            </div><hr>     

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
            <button class="btn btn-primary" type="submit">Create A New Account</button>
            </form>
           <br><br>                          
            
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop