    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top top-nav-collapse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="{{asset('fundsforlife/images/logo.png')}}" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="scroll active"><a href="{{url('/')}}">Home</a></li>
                        <li class="scroll"><a href="{{url('login')}}">Login</a></li>
                        <li class="scroll"><a href="{{url('register-step-0')}}">Register</a></li>
                        <li class="scroll"><a href="{{url('terms')}}">Terms of Use</a></li>
                        <li class="scroll"><a href="{{url('warning')}}">WARNING</a></li>
                        <li class="scroll"><a href="{{url('privacy-policy')}}">Privacy</a></li>
                       <li class="scroll"><a href="{{url('/')}}#get-in-touch">Contact</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->