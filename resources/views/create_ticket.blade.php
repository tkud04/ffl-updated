@extends('layout')

@section('title',"CREATE TICKET")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">We would like to hear from you!</h2>
                <p class="text-center wow fadeInDown">You can also contact us via email: support@fundsforlife.com</p>
            </div>
            
            <div class="row">
            <div class="col-sm-6">
            
            <div class="address">
            <h4>Email</h4>
            <p><a href="#">info@fundsforlife.com </a></p>
            </div>
            
            <div class="address">
            <h4>Follow Us</h4>
            <p><a href="#"><i class="fa fa-facebook"></i></a>  &nbsp; <a href="#"><i class="fa fa-twitter"></i></a> &nbsp; <a href="#"><i class="fa fa-instagram"></i></a></p>
            </div>
            </div>
            
            <div class="col-sm-6">
            
            <form action="{{url('create-ticket')}}" method="post" name="contact-form" id="main-contact-form">
                                <div class="form-group">
                                    <input type="text" required placeholder="Name" class="form-control" name="name" value="{{$name}}">
                                </div>
                                <div class="form-group">
                                    <input type="email" required placeholder="Email" class="form-control" name="email" value="{{$email}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" required placeholder="Subject" class="form-control" name="subject">
                                </div>
                                <div class="form-group">
                                    <textarea required placeholder="Message" rows="8" class="form-control" name="message"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">OPEN NEW TICKET</button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->
    
    <?php
$txt = "";
if(Session::has('create-ticket-status') && Session::get('create-ticket-status') == "success") $txt = "Ticket opened successfully!  We will respond ASAP";
?>
<input id="notif" value="<?php echo $txt; ?>" type="hidden">

@stop

@section('custom-scripts')
<script src="{{asset('fundsforlife/js/alerts.js')}}" type="text/javascript"></script>
<script>
       var notif = $('#notif').val();
       $(document).ready(function(){      
        var alertHTML = "<strong>" + notif + "</strong>.<br><br>";
       if(notif != "") showNotification('flip','FundsForLife',alertHTML,'top-right', 0,'success');
       });
    </script>
@stop