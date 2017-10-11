@extends('layout')

@section('title',"UPLOAD SLIDER IMAGE")

@section('content')

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Upload New Slider Image</h2>
                <p class="text-center wow fadeInDown">Change the slider Images from time to time to keep FundsForLife interesting!</p>
            </div>
            
            <div class="row">
                       
            <div class="col-sm-12">
            	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif            	
            
            <form action="{{url('admin/asi')}}" method="post" name="contact-form" id="main-contact-form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">        
                                <div class="form-group">
                                  <input required type="file" id= "slider-image" class="form-control" name="slider-image" />
                                </div>
                                <button class="btn btn-primary" type="submit">SUBMIT</button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->

@stop

@section('custom-scripts')
@include('upload-slider-script')
@stop