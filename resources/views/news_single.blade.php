@extends('layout')

@section('title',"NEWS")

@section('content')

<section id="blog">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Latest News</h2>
                <p class="text-center wow fadeInDown">What's Happening On FundsForLife</p>
            </div>
			 
             <div class="row">
           	<div class="col-xs-12">
@if(count($ret) < 1)
<div class="alert alert-primary" role="alert"><p><strong>No News found.</strong></p></div>       
@else      	
             <div id="owl-example" class="owl-carousel"> 
@foreach($ret as $r)  
<?php $url = url("news")."/".$r["news-id"]; ?>           	
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                	
                                    <img src="{{$r['news-image']}}" alt="">
                                   
                                </div>
                                <div class="entry-date">{{$r['date']}}</div>
                                <h2 class="entry-title"><a href="#">{{$r['title']}}</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>{{$r['body']}}</P>
                                <a class="btn btn-primary" href="{{$url}}">READ MORE</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
@endforeach               

                                            
            </div>
@endif
            </div>			
               </div>			

        </div>
    </section> 

@stop