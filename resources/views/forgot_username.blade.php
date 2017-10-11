@extends('layout')

@section('title',"FORGOT USERNAME")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">FORGOT USERNAME? </h2>
                <p class="text-center wow fadeInDown">We will send your username to your email address.<br>
                	Forgot password?  <a class="btn btn-primary" href="{{ url('/password/email') }}">RESET PASSWORD</a>
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
							<p><strong>Your username has been sent to your email address</strong>.</p><br><br>
						</div></center>                
@endif
            
            <form action="{{ url('/forgot-username') }}" method="post" name="forgot-username-form" id="forgot-username-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <input type="email" required placeholder="Email address" class="form-control" name="email" value="{{ old('email') }}" >
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                            <br><br>
            </div>
            
            
            </div>
            
            <div class="row"><div class="col-md-12" id="working"></div></div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop