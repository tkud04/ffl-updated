@extends('layout')

@section('title',"Generate Activation Pin")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Generate Activation Pin</h2>
                <p class="text-center wow fadeInDown">Generate new activation pins to be sold to users here. </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            <!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
                     
             @if(Session::has("generate-pin-status") && Session::get("generate-pin-status") == "success") 
                <?php
                  $p = Session::get("pin");                
               ?>
               <div class="alert alert-success">Activation Pin: <strong>{{$p}}</strong></div>
             @endif
                     
            <form action="{{url('admin/gap')}}" method="post" name="contact-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">        
                                <div class="form-group">
                                       	  <select class="form-control" id= "pc" name="pc">
   	     <option value="none">Valid for how many times?</option>
            <option value="1">1</option>       
            <option value="2">2</option>       
            <option value="3">3</option>       
            <option value="4">4</option>       
            <option value="5">5</option>       
         </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Generate Pin</button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop