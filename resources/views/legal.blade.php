@extends('layout')

@section('title',"LEGAL INFORMATION")

@section('content')

<?php
$title = ""; $content = "";

 if($purpose == "w"){
 	$title = "WARNING";
    $content = "warning";
}        

elseif($purpose == "t"){
 	$title = "Terms of Use";
    $content = "terms";
} 

if($purpose == "pp"){
 	$title = "Privacy Policy";
    $content = "privacy_policy";
}                                   
 ?>

    <section id="testimonial">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">{{$title}}</h2>
                <p class="text-center wow fadeInDown">FundsForLife makes it easy to enjoy what matters most in your life!</p>
            </div>

            <div class="row">
                 <div class="col-sm-12">
                      @include($content)
                 </div>
            </div>

        </div>
    </section> <!--/#testimonial-->

@stop