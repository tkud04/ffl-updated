@extends('layout')

@section('title',"ADD SITE MESSAGE")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Add Site Messages</h2>
                <p class="text-center wow fadeInDown">Add or edit the messages displayed in various sections of FundsForLife. </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            <!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
                     
            <form action="{{url('admin/asm')}}" method="post" name="contact-form" id="main-contact-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">        
                                <div class="form-group">
                                       	  <select class="form-control" id= "role" name="in_use">
   	     <option value="none">NO ROLE</option>
            <option value="w">HEADER</option>
            <option value="footer">FOOTER</option>
         </select>
                                </div>
                                <div class="form-group">
                                    <textarea required id= "message" name="message" placeholder="Message" rows="8" class="form-control" value ="{{old('message')}}"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">ADD MESSAGE</button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop