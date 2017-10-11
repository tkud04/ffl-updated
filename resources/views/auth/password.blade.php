@extends('layout')

@section('title',"FORGOT PASSWORD")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">FORGOT PASSWORD? </h2>
                <p class="text-center wow fadeInDown">We will send a password reset link to your email address.<br>
                	Forgot username?  <a class="btn btn-primary" href="{{url('forgot-username')}}">RETRIEVE USERNAME</a>
                </p>
            </div>
            
            <div class="row">
            <div class="col-sm-6">
               <img src="{{asset('fundsforlife/images/bird.jpg')}}" alt="Login" class="img img-responsive">
            </div>
            
            <div class="col-sm-6">
            	
            <!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
                     
    @if(Session::has('reset-status') && Session::get('reset-status') == "success")
						<center><div class="alert alert-success" role="alert">
							<p><strong>A reset link has been sent to your email address</strong>.</p><br><br>
						</div></center>                
@endif
            
            <form action="{{ url('/password/email') }}" method="post" name="forgot-password-form" id="forgot-password-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <input type="email" required placeholder="Email address" class="form-control" name="email" value="{{ old('email') }}" >
                                </div>
                                <button class="btn btn-primary" type="submit">SEND PASSWORD RESET LINK</button>
                            </form>
                            <br><br>
            </div>
            
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop