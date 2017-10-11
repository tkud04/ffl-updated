@extends('layout')

@section('title',"LEGAL SETTINGS")

@section('content')

<div class="row">
<div class="col-md-12">
<div class="panel panel-transparent">
<div class="panel-heading"><div class="panel-title">Legal Information</div></div>
<div class="panel-content">
<a class="btn btn-primary btn-cons m-t-10" href="{{url('admin/edit-legal-information')}}">Edit Legal Information</a>
<!----------portlet ------------>
<div class="row">
<div class="col-md-12">
<br>
<div class="panel panel-transparent">
<ul class="nav nav-tabs nav-tabs-simple nav-tabs-left bg-white" id="tab-3">
<li class="active">
<a data-toggle="tab" href="#tabTC">Terms and Conditions</a>
</li>
<li>
<a data-toggle="tab" href="#tabW">Warning</a>
</li>
<li>
<a data-toggle="tab" href="#tabPP">Privacy Policy</a>
</li>
</ul>
<div class="tab-content bg-white">
<!----------Tab----------->
<div class="tab-pane active" id="tabTC">
<div class="row column-seperation">
<div class="col-md-12">
    <!-- Swiper -->
    <div class="swiper-container" id="swiperTC">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <h4>Terms and Conditions</h4>
                @include('terms')            
            </div>
        </div>
        <!-- Add Scroll Bar -->
        <div class="swiper-scrollbar"></div>
    </div>
    <!-- Swiper -->
</div>
</div>
</div>
<!----------/Tab----------->


<!----------Tab----------->
<div class="tab-pane" id="tabW">
<div class="row column-seperation">
<div class="col-md-12">
    <!-- Swiper -->
    <div class="swiper-container" id="swiperW">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <h4>WARNING</h4>
                @include('warning')            
             </div>
        </div>
        <!-- Add Scroll Bar -->
        <div class="swiper-scrollbar"></div>
    </div>
    <!-- Swiper -->
</div>
</div>
</div>
<!----------/Tab----------->

<!----------Tab----------->
<div class="tab-pane" id="tabPP">
<div class="row column-seperation">
<div class="col-md-12">
    <!-- Swiper -->
    <div class="swiper-container" id="swiperPP">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <h4>Privacy Policy</h4>
                @include('privacy_policy')            
            </div>
        </div>
        <!-- Add Scroll Bar -->
        <div class="swiper-scrollbar"></div>
    </div>
    <!-- Swiper -->
</div>
</div>
</div>
<!----------/Tab----------->
</div>
</div>
</div>
</div>
<!----------/portlet ------------>

</div>
</div>
</div>
</div>
</div>
 
</div>

@stop