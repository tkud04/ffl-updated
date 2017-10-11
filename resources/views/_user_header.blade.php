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
                    <a class="navbar-brand" href="#"><img src="{{asset('fundsforlife/images/logo.png')}}" alt="logo" style="z-index: 120;"></a>                                   
                    <ul class="nav navbar-nav" style="z-index: -120; !important;">
                        <li class="scroll active"><a id="menu-toggle" href="#"><span id="sidebar-icon" class="badge badge-pill badge-primary">Open menu</span></a></li>
                    </ul>     
                </div>
				
                <div class="collapse navbar-collapse navbar-right" style="z-index: 120;">
                    <ul class="nav navbar-nav">
                        <li class="scroll active"><a href="{{url('/')}}">Home</a></li>
                        <li class="scroll"><a href="{{url('dashboard')}}">Dashboard</a></li>                        
                        <li class="scroll"><a href="{{url('terms')}}">Terms of Use</a></li>
                        <li class="scroll"><a href="{{url('warning')}}">WARNING</a></li>
                        <li class="scroll"><a href="{{url('privacy-policy')}}">Privacy</a></li>
                       <li class="scroll"><a href="{{url('/')}}#get-in-touch">Contact</a></li>                 
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->
    <script>
    //Toggle sidebar Icon
	function toggleSidebarIcon(){
		s_i = $('#sidebar-icon');
		if(s_i.html() == "Close menu"){ s_i.html("Open menu"); }
		else if(s_i.html() == "Open menu" ){ s_i.html("Close menu"); }
    }
   </script>