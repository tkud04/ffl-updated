@extends('layout')

@section('title',"DASHBOARD")

@section('content')

<div class="row">
<div class="col-md-12">

	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
	<script>
		var ds = false;
   </script>
    <br><br><br><br>
    	
   @if($accountStatus->status == "R2")
   <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Activate Your Account</h2>
                <p class="text-center wow fadeInDown">Your activation pin is expired, and your account has been temporarily deactivated. To activate your account, please provide your activation PIN below. <a href="{{url('vendors')}}">Click here to purchase activation PINs from our accredited vendors if you don't have one</a>.<br>
                </p>
                
            </div>
            

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
   @else
<span class="pull-left"><strong>Welcome, {{$user->first_name." ".$user->last_name}} ({{$user->email}})</strong><br>
	<?php
	  $pc = $pin->pin_count;
	  $class = "label label-success";
	
	  if($pc <= 2) $class = "label label-danger";
	?>
<span class="{{$class}}">You have {{$pin->pin_count}} counts left on your Activation Pin</span th>
</span>
<span class="pull-right"><center>You will be receive payment within<br> <strong>15 minutes - 14 days</strong> of Making Payment</center></span>
      <div align="center">
	    <br><br><br>
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
<center>
<div class="panel panel-default" id="total-paid">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="#">TOTAL PAID</a> <h2 class="semi-bold">&#8358;{{$stats['total_paid']}}</h2></div>
<div class="col-md-3"><i class="fa fa-briefcase fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
<center>
<div class="panel panel-default" id="monthly-received">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="#">MONTHLY RECEIVED</a> <h2 class="semi-bold">&#8358;{{$stats['monthly_received']}}</h2></div>
<div class="col-md-3"><i class="fa fa-calendar-check-o fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
<center>
<div class="panel panel-default" id="total-users">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="#">CYCLES COMPLETED</a> <h2 class="semi-bold">{{$stats['cycles_completed']}}</h2></div>
<div class="col-md-3"><i class="fa fa-refresh fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
        </div>
          <br><br><br>
	     @if($accountStatus->status == "PH" || $accountStatus->status == "GH-O")
	        
	     @if($accountStatus->status == "GH-O")
	        <div class="alert alert-danger">
		      <center>
		      <h3><i class ="fa fa-lock"></i>Second Payment Is Locked!!</h3><br>
			  To Unlock Second Payment You Must PH Your First Payment To Matched Participant.
			  </center>
            </div>
	      @endif

        @if($accountStatus->merged == "yes")
        @if($ret['status'] == "pending_confirmation")        
    	<h2 class = "text-primary">YOUR PAYMENT IS YET TO BE CONFIRMED</h2><br>
    	<p class = "text-danger">Please wait you will be confirmed soon</p><br><br><br>
    	@else
        <link rel="stylesheet" href="{{asset('fundsforlife/lib/countdown/css/jquery.countdown.css')}}" type="text/css" />
    <div align="center" style="background:#fff !important;">
    	<h2 class = "text-primary">You Have Been Merged To Donate</h2><br>
    	<p class = "text-danger">Please Pay the Person Below To Get Paid</p><br>
       <h3 class = "text-danger">Deadline To Make Payment: {{$ret['deadline']}}</h3><br><br>   	      
    </div><br><br>
 
   <div class="container-fluid container-fixed-lg">  
   	<div class="panel panel-transparent">
   	    <div class="panel-body">
   	        <div class="row">
   	            	<div class="col-md-12">	
                          <div class = "panel panel-default">
                          	<div class="panel-heading separator">
                                 <div class="panel-title">AWAITING PAYMENT</div>
                              </div>
                              <div class="panel-body">
                              	<br><br>
                                    <center><strong><p style="font-size:2em;">AMOUNT  <span class ="text-primary">&#8358;{{$ret['amount']}}</span></p></strong></center><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Pay To Name:  <span class ="text-primary">{{$ret['receiver-name']}}</span></p></strong><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Bank Name:  <span class ="text-primary"> {{$ret['bank-name']}}</span></p></strong><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Account Name:  <span class ="text-primary">{{$ret['acc-name']}}</span></p></strong><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Account Number:  <span class ="text-primary">{{$ret['acc-num']}}</span></p></strong><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Phone Number:  <span class ="text-primary"> {{$ret['phone']}}</span></p></strong><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Email:  <span class ="text-primary">{{$ret['email']}}</span></p></strong><br>
                                   		<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                                   	           	<input type="hidden" name="url" id="url" value="{{url('counter')}}">
                                   <div class = "btn-group btn-group-justified" aria-label="..." role="group">
                                 	<a class="btn btn-success" role="button" href="#" id="mp">I Have Made Payment</a>
                                  </div>
                              </div>
                         </div>
                      </div>             
                </div>
           </div>
       </div>
   </div>
       
    @endif 
   
 @elseif($accountStatus->merged == "no")    
            <h2 class = "text-primary">YOU ARE YET TO BE MERGED TO DONATE</h2><br>
        	<p class = "text-danger">Please wait you will be merged soon</p><br><br><br>  
@endif      

@elseif($accountStatus->status == "GH" || $accountStatus->status == "GH-E")
    
@if($accountStatus->merged == "yes")
          <div align="center">
    	<h2 class = "text-primary">YOU HAVE BEEN MERGED TO RECEIVE PAYMENT</h2><br>
    	<p class = "text-danger">The Persons Listed Below Will Pay You</p><br><br><br>
    </div><br><br><br>  	
  
   <div class="container-fluid container-fixed-lg">  
   	<div class="panel panel-transparent">
   	    <div class="panel-body">
   	        <div class="row">
   	             	<?php $c = 0; $d = 0;
             	echo "<script>";
             	echo "var dat = new Array(".count($ret).");";
                 foreach($ret as $r){
             	echo "temp".$d." = {'p': '".$r['amount']."','g': '".$r['user_id']."','pt': '".$r['payment-type']."','sn': '".$r['slip-name']."','pi': '".asset('pop/').'/'.$r['payment-image']."'};";           
                 echo "console.log(temp".$d.");";
                 ++$d;
               }
         
              echo "</script>";
            ?>   	
              @foreach($ret as $r)
                <?php $btn = "pm_".$c;  $btn2 = "cm_".$c;  $btn3 = "rm_".$c;?>
   	            	<div class="col-md-6">	
                          <div class = "panel panel-default">
                          	<div class="panel-heading separator">
                                 <div class="panel-title">AWAITING PAYMENT</div>
                              </div>
                              <div class="panel-body">
                              	<br><br>
                                    <center><strong><p style="font-size:2em;">AMOUNT  <span class ="text-primary">&#8358;{{$r['amount']}}</span></p></strong></center><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Name:  <span class ="text-primary">{{$r['giver-name']}}</span></p></strong><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Phone Number:  <span class ="text-primary">{{$r['phone']}}</span></p></strong><br>
                                   <strong><p style="font-size:1.6em;" class="text-center">Email:  <span class ="text-primary">{{$r['email']}}</span></p></strong><br>
                                   	
                                   @if($r['payment-type']  == null &&  $r['slip-name']  == null && $r['payment-image'] == null)
                                   <div class = "btn-group btn-group-justified" aria-label="..." role="group">
                                 	<a class="btn btn-default" role="button" href="#">VIEW PAYMENT INFO</a>
                                     <a class="btn btn-default" role="button" href="#">CONFIRM</a>
                                     <a class="btn btn-default" role="button" href="#">REPORT DONATION</a>
                                  </div>
                                  
                                  @else
                                  <div class = "btn-group btn-group-justified" aria-label="..." role="group">
                                 	<a class="btn btn-primary" role="button" href="#" id="{{$btn}}">VIEW PAYMENT INFO</a>
                                     <a class="btn btn-success" role="button" href="#" id="{{$btn2}}">CONFIRM</a>
                                     <a class="btn btn-danger" role="button" href="#" id="{{$btn3}}">REPORT DONATION</a>
                                  </div>
                                  @endif
                              </div>
                         </div>
                      </div>
                     <?php $c += 1;?>
                @endforeach

                </div>
           </div>
       </div>
   </div>
   
   @elseif($accountStatus->merged == "no")    
            <h2 class = "text-primary">YOU ARE YET TO BE MERGED TO RECEIVE PAYMENT</h2><br>
        	<p class = "text-danger">Please wait you will be merged soon</p><br><br><br>  
@endif 
   
@endif

<!------------ Recent Payment History ---------->
<div class="container-fluid container-fixed-lg">  
	<div class="row">
		<div class="col-xs-12">
           	<div class="panel panel-transparent">
           	   <div class="panel-title"><h3 class="text-left text-primary">Recent Payment History</h3></div>
   	           <div class="panel-body">   	               
                      <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">

<tbody>
@foreach($rph as $r)
<?php
$name = ""; $type = $r["type"]; $class = "";

if($type == "received"){
  $name = $r["receiver"]->first_name." ".$r["receiver"]->last_name;
  $class = "label-success";
} 
else if($type == "disbursed"){
  $name = $r["receiver"]->first_name." ".$r["receiver"]->last_name;
  $class = "label-info";
} 
?>
<tr>
   <td>{{$name}} &#8358;{{$r["amount"]}}</td>
   <td><span class="label {{$class}}">{{$type}}</span></td>
   <?php
     $dr=$r["receiver"]->first_name." ".$r["receiver"]->last_name;
     $dg=$r["giver"]->first_name." ".$r["giver"]->last_name;
     $da=$r["amount"]; $dd=$r["date"];
     $dt=$r["type"]; $ds=$r["status"];
   ?>
   <td><button class="btn btn-default rph" data-giver="{{$dg}}" data-receiver="{{$dr}}" data-amount="{{$da}}" data-date="{{$dd}}" data-type="{{$dt}}" data-status="{{$ds}}">details</button></td>
</tr>
@endforeach
</tbody>
</table><br>
   	           </div>
   	        </div>
       </div>
   </div>
</div>

 @if($accountStatus->status == "PH" || $accountStatus->status == "GH-O")
     @include("modals.mark-paid-modal")
     @include("modals.cannot-pay-modal")
@endif
 
 @if(($accountStatus->status == "GH" || $accountStatus->status == "GH-E") && ($accountStatus->merged == "yes")) 
     @include("modals.payment-information-modal")
      @include("modals.confirm-payment-modal")
       @include("modals.report-donation-modal") 
 @endif
 @include('modals.rph-details-modal')
 </div>
</div>

 <?php
$txt = "";

if(Session::has('confirm-pay-status') && Session::get('confirm-pay-status') == "success") $txt = "Payment has been CONFIRMED";
elseif(Session::has('report-donation-status') && Session::get('report-donation-status') == "success") $txt = "Donation has been REPORTED";
elseif(Session::has('cannotpay-status') && Session::get('cannotpay-status') == "success") $txt = "Donation has been CANCELED";

?>
<input id="notif" value="<?php echo $txt; ?>" type="hidden">

@endif
@stop

@section('custom-scripts')
<script src="{{asset('fundsforlife/js/alerts.js')}}" type="text/javascript"></script>
<script>
       var blade = "r"; var notif = $('#notif').val();
       $(document).ready(function(){      
        var alertHTML = "<strong>" + notif + "</strong>.<br><br>";
        if(notif != "") showNotification('flip','Nairafunds',alertHTML,'top-right', 0,'success');
        
        $(".rph").click(function(e){
        	e.preventDefault();
            giver = $(this).attr("data-giver");
            receiver = $(this).attr("data-receiver");
            amount = $(this).attr("data-amount");
            datex = $(this).attr("data-date");
            typex = $(this).attr("data-type");
            statux = $(this).attr("data-status");
            //alert("giver = " + giver);
            
            $("#rph-giver").html(giver);
            $("#rph-receiver").html(receiver);
            $("#rph-amount").html("&#8358;" + amount);
            $("#rph-date").html(datex);
            if(typex == "disbursed") $("#rph-type").html("<label class=' label label-info'>disbursed</label>");
            else if(typex == "received") $("#rph-type").html("<label class=' label label-success'>received</label>");
            $("#rph-status").html(statux);
            $("#RPHModal").modal("show");
         });
       });
    </script>
	<script type="text/javascript" src="{{asset('fundsforlife/lib/countdown/jquery.countdown.js')}}" ></script>
    <script type="text/javascript" src="{{asset('fundsforlife/lib/countdown/script.js')}}"></script>
    <script src="{{asset('fundsforlife/js/modals.js')}}" type="text/javascript"></script>
    <script>
    	dsi = window.setInterval(function(){
           if(ds == true){window.location = "{{url('block')}}";}
        }, 3000);
   </script>
    @include('modals.mark-paid-script')
    @include('modals.cannotpay-script')
    @include('modals.payment-information-script')
    @include('modals.confirm-script')
    @include('modals.report-script')
@stop
