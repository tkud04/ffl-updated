@extends('layout')

@section('title',"EDIT LEGAL INFORMATION")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Edit Legal Information</h2>
                <p class="text-center wow fadeInDown">Add or edit terms and condition, warning and privacy policy.  </p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            	
            <!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif
            
            <form action="{{url('admin/edit-legal-information')}}" method="post" name="contact-form" id="main-contact-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">        
                                <div class="form-group">
                                       	  <select class="form-control"  id= "role" name="role">
   	        	     <option value="tc">TERMS AND CONDITIONS</option>
            <option value="w">WARNING</option>
            <option value="pp">PRIVACY POLICY</option>
         </select>
                                </div>
                                <div class="form-group">
                                    <textarea required id= "content" name="content" placeholder="Message" rows="8" class="form-control"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">ADD MESSAGE</button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop