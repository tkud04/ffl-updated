@extends('layout')

@section('title',"Registration Step 4")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Step 4 - Select Your Plan</h2>
                <p class="text-center wow fadeInDown">Select your desired package and enter your bank details.<br>
                	Already have an account?  <a class="btn btn-primary" href="{{url('login')}}">LOGIN</a>
                </p>
                
            </div>
            
<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ["errors" => $errors])
                     @endif
                                       

                    @if (Session::has('step-4-status') && Session::get('step-4-status') == "success")
                    
                    @if (Session::has('grepo'))
                      <?php $grepo = Session::get('grepo');?>                
                     @endif
                     
                       <?php $u = "register-step-5/?grepo=".$grepo; ?>
					    <div class="alert alert-success" role="alert">
							<p><strong>Success!</strong> Proceeding to Step 5..</p><br><br>
							<script>setTimeout(' window.location.href = "{{url($u)}}"; ',3000);</script>
						</div>
					@endif
            	
             <form action="{{url('register-step-4')}}" method="post" name="login-form" id="form-1-submit">
             	<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
             	<input type="hidden" id = "grepo" name="grepo" value="{{ $grepo }}">
                 

            <div class="row">          
               <div class="col-sm-12">      
                  <div class="form-group">
                  	<label>Select a package</label>
                       <select class="form-control" name="plan" id="plan" data-rule="number" data-msg="Please select your package.">
                            @foreach($availablePackages as $ap)
                               @if($ap["enabled"] == "yes")
                                   <option value="{{$ap['id']}}">{{$ap['name']}} - &#8358;{{$ap['price']}}</option>
                               @endif
                            @endforeach
                          </select>
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
	   	
            <button class="btn btn-primary" type="submit">Submit</button>
            </form>
           <br><br>                          
            <div class="row">          
               <div class="col-sm-12">      
               <div class="jumbotron">
                  <h2 class="display-3">Next Steps</h2>
  <p class="lead"><span aria-hidden="true" class="fa fa-lock" style="margin-right: 4px;"></span>Wait for confirmation.</p>
  <hr class="my-4">
  <p><span aria-hidden="true" class="fa fa-rocket" style="margin-right: 4px;"></span>Proceed to Step 5</p>
</div>
               </div>      
            </div><hr>   
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop