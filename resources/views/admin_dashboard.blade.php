@extends('layout')

@section('title',"DASHBOARD")

@section('content')

<link class="main-stylesheet" href="{{asset('fundsforlife/css/pages.css')}}" rel="stylesheet" type="text/css"/>

<div class="row" style="margin-top: 10% !important;">
<div class="col-md-12">
<div class="panel panel-transparent">
<div class="panel-content">

<!----------row ------------>
<div class="row">
	
<!----------portlet ------------>
<div class="col-md-3">
<center>
<div class="panel panel-default" id="total-users">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/users')}}">TOTAL USERS</a> <h2 class="semi-bold">{{$ret['total_users']}}</h2></div>
<div class="col-md-3"><i class="fa fa-users fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------portlet ------------>
	
<!----------portlet ------------>
<div class="col-md-3">
<center>
<div class="panel panel-default bg-primary" id="total-blocked-users">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/users')}}" class="semi-bold text-white">TOTAL BLOCKED USERS</a> <h2 class="semi-bold text-white">{{$ret['total_blocked_users']}}</h2></div>
<div class="col-md-3"><i class="fa fa-ban fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------portlet ------------>
	
	
<!----------portlet ------------>
<div class="col-md-3">
<center>
<div class="panel panel-default bg-danger" id="open-tickets">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/tickets')}}" class="text-white">TICKETS - RESPONSE REQUIRED</a> <h2 class="semi-bold text-white">{{$ret['open_tickets']}}</h2></div>
<div class="col-md-3"><i class="fa fa-support fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------portlet ------------>
	
	
	
<!----------portlet ------------>
<div class="col-md-3">
<center>
<div class="panel panel-default bg-success" id="packages">
<div class="panel-body">
<div class="row">
<div class="col-md-9"> <a href="{{url('admin/packages')}}" class="text-white">PACKAGES</a><h2 class="semi-bold text-white">{{$ret['packages']}}</h2></div>
<div class="col-md-3"><i class="fa fa-gift fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------portlet ------------>

</div>
<!----------/row ------------>




<!----------row ------------>
<div class="row">
	
<!----------portlet ------------>
<div class="col-md-4">
<center>
<div class="panel panel-default bg-complete" id="reported-donations">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="text-white">REPORTED DONATIONS</a> <h2 class="semi-bold text-white">{{$ret['reported_donations']}}</h2></div>
<div class="col-md-3"><i class="fa fa-bullhorn fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------portlet ------------>
	
<!----------portlet ------------>
<div class="col-md-4">
<center>
<div class="panel panel-default" id="active-users-now">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/users')}}" class="semi-bold">ACTIVE USERS NOW</a> <h2 class="semi-bold">{{$ret['active_users_now']}}</h2></div>
<div class="col-md-3"><i class="fa fa-users fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------portlet ------------>
	
	
<!----------portlet ------------>
<div class="col-md-4">
<center>
<div class="panel panel-default bg-primary" id="active-users-today">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/users')}}" class="text-white">ACTIVE USERS TODAY</a> <h2 class="semi-bold text-white">{{$ret['active_users_today']}}</h2></div>
<div class="col-md-3"><i class="fa fa-history fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/portlet ------------>

</div>
<!----------/row ------------>



<!----------row ------------>
<div class="row">
	
<!----------portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-transparent">
<div class="panel-heading"><div class="panel-title">AWAITING PAYMENT</div>
<div class="panel-content">
<div class="row">

<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default" id="awaiting-payments-count">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="semi-bold "># PAYMENT</a> <h2 class="semi-bold">{{$ret['ap']}}</h2></div>
<div class="col-md-3"><i class="fa fa-users fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>


<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default bg-primary" id="awaiting-payments-amount">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="text-white">AMOUNT</a> <h2 class="semi-bold text-white">&#8358;{{$ret['am']}}</h2></div>
<div class="col-md-3"><i class="fa fa-briefcase fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>

</div>
</div>
</div>
</center>
</div>
<!----------/portlet ------------>


<!----------portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-transparent">
<div class="panel-heading"><div class="panel-title">COMPLETED PAYMENTS</div>
<div class="panel-content">
<div class="row">

<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default" id="completed-payments-count">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="semi-bold"># PAYMENT</a> <h2 class="semi-bold">{{$ret['cp']}}<</h2></div>
<div class="col-md-3"><i class="fa fa-users fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>


<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default bg-success" id="completed-payments-amount">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="text-white">AMOUNT</a> <h2 class="semi-bold text-white">&#8358;{{$ret['cm']}}</h2></div>
<div class="col-md-3"><i class="fa fa-briefcase fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>

</div>
</div>
</div>
</center>
</div>
<!----------/portlet ------------>

</div>
<!----------/row ------------>



<!----------row ------------>
<div class="row">
	
<!----------portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-transparent">
<div class="panel-heading"><div class="panel-title">COMPLETED PAYMENTS THIS WEEK&nbsp;&nbsp;<span class="pull-right">(last 7 days)</span</div>
<div class="panel-content">
<div class="row">

<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default" id="cp-7-count">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="semi-bold "># PAYMENT</a> <h2 class="semi-bold">{{$ret['cp_7']}}</h2></div>
<div class="col-md-3"><i class="fa fa-users fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>


<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default bg-primary" id="cp-7-amount">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="text-white">AMOUNT</a> <h2 class="semi-bold text-white">&#8358;{{$ret['cm_7']}}</h2></div>
<div class="col-md-3"><i class="fa fa-briefcase fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>

</div>
</div>
</div>
</center>
</div>
<!----------/portlet ------------>


<!----------portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-transparent">
<div class="panel-heading"><div class="panel-title">COMPLETED PAYMENTS THIS MONTH&nbsp;&nbsp;<span class="pull-right">(last 30 days)</span></div>
<div class="panel-content">
<div class="row">

<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default" id="cp-30-count">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="semi-bold"># PAYMENT</a> <h2 class="semi-bold">{{$ret['cp_30']}}</h2></div>
<div class="col-md-3"><i class="fa fa-users fa-4x"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>


<!----------nested portlet ------------>
<div class="col-md-6">
<center>
<div class="panel panel-default bg-success" id="cp-30-amount">
<div class="panel-body">
<div class="row">
<div class="col-md-9"><a href="{{url('admin/view-donations')}}" class="text-white">AMOUNT</a> <h2 class="semi-bold text-white">&#8358;{{$ret['cm_30']}}</h2></div>
<div class="col-md-3"><i class="fa fa-briefcase fa-4x text-white"></i></div>
</div>
</div>
</div>
</center>
</div>
<!----------/nested portlet ------------>

</div>
</div>
</div>
</center>
</div>
<!----------/portlet ------------>

</div>
<!----------/row ------------>





</div>
</div>
</div>
</div>


@stop

@section('custom-scripts')
<script>
$(document).ready(function(){
    $('div.panel#total-users').click(function(e){
        window.location.href = "{{url('admin/users')}}";
    });
    
    $('div.panel#total-blocked-users').click(function(e){
        window.location.href = "{{url('admin/users')}}";
    });
    
    $('div.panel#open-tickets').click(function(e){
        window.location.href = "{{url('admin/tickets')}}";
    });
    
    $('div.panel#packages').click(function(e){
        window.location.href = "{{url('admin/packages')}}";
    });
    
    $('div.panel#reported-donations').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#active-users-now').click(function(e){
        window.location.href = "{{url('admin/users')}}";
    });
    
    $('div.panel#active-users-today').click(function(e){
        window.location.href = "{{url('admin/users')}}";
    });
    
    $('div.panel#awaiting-payments-count').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#awaiting-payments-amount').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#completed-payments-count').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#completed-payments-amount').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#cp-7-count').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#cp-7-amount').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#cp-30-count').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
    
    $('div.panel#cp-30-amount').click(function(e){
        window.location.href = "{{url('admin/view-donations')}}";
    });
});
</script>
@stop