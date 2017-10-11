@extends('layout')

@section('title',"ADD NEWS")

@section('content')

<section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Add News</h2>
                <p class="text-center wow fadeInDown">Pass messages to members of FundsForLife. </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
            
            <form action="{{url('admin/add-news')}}" method="post" name="contact-form">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">         
                                <div class="form-group">
                                       	<input type="text" name="title" placeholder="News title" class="form-control" value ="{{old('title')}}" required>
                                </div>
                                <div class="form-group">
                                    <textarea required name="body" placeholder="News goes here, make it as long as you need!" rows="8" value ="{{old('body')}}" class="form-control"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">SUBMIT </button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->
    
    <?php
$txt = "";
if(Session::has('add-news-status') && Session::get('add-news-status') == "success") $txt = "News item has been ADDED";
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