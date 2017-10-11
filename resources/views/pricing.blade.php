@if(isset($availablePackages) && count($availablePackages) > 0) 
   <section id="pricing">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">WHAT ARE YOU WAITING FOR?</h2>
                <p class="text-center wow fadeInDown">SELECT A PACKAGE BELOW</p>
            </div>

            <div class="row">
 @foreach($availablePackages as $package)
@if($package['enabled'] == "yes")           	
                <div class="col-sm-4">
                    <div class="wow zoomIn" data-wow-duration="400ms" data-wow-delay="0ms">
                        <ul class="pricing">
                            <li class="plan-header">
                                <div class="plan-name">
                                    {{$package['name']}} Pack
                                </div>
                                <div class="plan-price">
                                    &#8358;{{$package['price']}}  <span>one time payment</span>
                                </div>
                                
                            </li>
                            <li>2:1 MATRIX</li>
                            <li>AUTO ASSIGN</li>
                           
                            <li>&#8358;{{$package['price'] * 2}} RETURN ON INVESTMENT</li>
                            <li>24/7 SUPPORT</li>
                            <?php $pid = $package['id']; $url = url('register-step-0');?>
                            <li class="plan-purchase"><a class="btn btn-primary" href="{{$url}}">SIGN UP</a></li>
                        </ul>
                    </div>
                </div>          
@endif
@endforeach                
                
                
                
            </div>
        </div>
    </section><!--/#pricing-->
    
   @endif
    
