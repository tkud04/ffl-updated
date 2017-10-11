<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield("title") | FundsForLife - Member To Member Donation Platform</title>
	<!-- core CSS -->
    <link href="{{asset('fundsforlife/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('fundsforlife/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('fundsforlife/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('fundsforlife/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('fundsforlife/css/owl.transitions.css')}}" rel="stylesheet">
    <link href="{{asset('fundsforlife/css/main.css')}}" rel="stylesheet">
     <link href="{{asset('fundsforlife/css/simple-sidebar.css')}}" rel="stylesheet">
     <link href="{{asset('fundsforlife/lib/jquery-datatable/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
     <link href="{{asset('fundsforlife/lib/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('fundsforlife/lib/datatables-responsive/css/datatables.responsive.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
 
 @yield('custom-styles')
 
</head><!--/head-->
	
<body id="home" class="homepage" style="background:#fff !important;">
	<div id="wrapper">
		@if(isset($user)) 
   @if($user->role == "admin" || $user->role == "superadmin")
        @include("_admin_sidebar")
   @else
       @include("_user_sidebar")
   @endif
   @endif 
	
	<!-- Page Content -->
        <div id="page-content-wrapper" style="background:#fff !important;">
        	
        @if(isset($user)) 
            @include("_user_header")
        @else
            @include("_guest_header")
        @endif
        
        <div class="container-fluid container-fixed-lg">