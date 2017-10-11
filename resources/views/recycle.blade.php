@extends('layout')

@section('title', "RECYCLE NOW")

@section('content')
        <link rel="stylesheet" href="{{asset('fundsforlife/lib/countdown/css/jquery.countdown.css')}}" type="text/css" />
    <div align="center">
    	@if (Session::has('recycle-status') && Session::get('recycle-status') == "success")
    	<h2 class = "text-success">YOUR CYCLE OF DONATION IS COMPLETE</h2><br>
    	<p class = "text-center">You Can Recycle Now!</p><br><br><br>
    	@endif
    
    	<h2 class = "text-danger">YOUR ACCOUNT WILL BE BLOCKED IN</h2><br>
    	       <input type="hidden" id="d" value="{{$counter['d']}}">
      <input type="hidden" id="h" value="{{$counter['h']}}">
      <input type="hidden" id="m" value="{{$counter['m']}}">
       <h2 id="countdown"></h2><br>
   	<div id="note" class = "text-primary"></div><br>
       <h2 class="text-danger">RECYCLE NOW TO ENJOY DONATIONS</h2><br>
    </div><br><br><br>
    	
@if(isset($availablePackages) && count($availablePackages) > 0) 
   <section id="pricing">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">WHAT ARE YOU WAITING FOR?</h2>
                <p class="text-center wow fadeInDown">SELECT A PACKAGE BELOW</p>
            </div>

            <div class="row">
 @foreach($availablePackages as $package)
@if($package['enabled'] == "yes")           	
                <div class="col-sm-4">
                    <div class="wow zoomIn" data-wow-duration="400ms" data-wow-delay="0ms">
                        <ul class="pricing">
                            <li class="plan-header">
                                <div class="plan-name">
                                    {{$package['name']}} Pack
                                </div>
                                <div class="plan-price">
                                    &#8358;{{$package['price']}}  <span>one time payment</span>
                                </div>
                                
                            </li>
                            <li>2:1 MATRIX</li>
                            <li>AUTO ASSIGN</li>
                          
                            <li>&#8358;{{$package['price']  + ($package['price'] * 0.5)}} RETURN ON INVESTMENT</li>
                            <li>24/7 SUPPORT</li>
                             <?php $pid = $package['id']; $url = url('rc')."/".$pid;?>
                            <li class="plan-purchase"><a class="btn btn-primary" href="{{$url}}">RECYCLE NOW </a></li>
                        </ul>
                    </div>
                </div>          
@endif
@endforeach                
                
                
                
            </div>
        </div>
    </section><!--/#pricing-->
    
   @endif
   
<?php
$txt = "";

if(Session::has('cannotpay-status') && Session::get('cannotpay-status') == "success") $txt = "Donation has been CANCELED";

?>
<input id="notif" value="<?php echo $txt; ?>" type="hidden">
 
@stop


@section('custom-scripts')
<script>
@if ($accountStatus->awaiting_pay == "cannotpay")
var blade = "c";
@else
var blade = "r";
@endif
</script>

<script src="{{asset('fundsforlife/js/alerts.js')}}" type="text/javascript"></script>
<script>
       var blade = "r"; var notif = $('#notif').val();
       $(document).ready(function(){      
        var alertHTML = "<strong>" + notif + "</strong>.<br><br>";
        if(notif != "") showNotification('flip','Nairafunds',alertHTML,'top-right', 0,'success');
       });
    </script>
	<script type="text/javascript" src="{{asset('fundsforlife/lib/countdown/jquery.countdown.js')}}" ></script>
    <script type="text/javascript" src="{{asset('fundsforlife/lib/countdown/script.js')}}"></script>
    <script>
    	dsi = window.setInterval(function(){
           if(ds == true){window.location = "{{url('block')}}";}
        }, 3000);
   </script>
@stop
