        <footer id="footer">
        <div class="container text-center">
          All rights reserved &copy; 2017 | <a href="#">FundsForLife</a>
        </div>
    </footer><!--/#footer-->
 
      </div>
        <!-- /#white background-->
   
            </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->



     <script src="{{asset('fundsforlife/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('fundsforlife/lib/bootstrap/js/bootstrap.min.js')}}"></script>   
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="{{asset('fundsforlife/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('fundsforlife/lib/mousescroll/mousescroll.js')}}"></script>
    <script src="{{asset('fundsforlife/lib/smoothscroll/smoothscroll.js')}}"></script>
    <script src="{{asset('fundsforlife/lib/jquery/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('fundsforlife/lib/isotope/jquery.isotope.min.js')}}"></script>
    <script src="{{asset('fundsforlife/lib/jquery/jquery.inview.min.js')}}"></script>
    <script src="{{asset('fundsforlife/lib/wow/wow.js')}}"></script>
    <script src="{{asset('fundsforlife/js/main.js')}}"></script>
	<script src="{{asset('fundsforlife/js/scrolling-nav.js')}}"></script>
	<script src="{{asset('fundsforlife/lib/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('fundsforlife/lib/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('fundsforlife/lib/jquery-datatable/media/js/dataTables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('fundsforlife/lib/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('fundsforlife/lib/datatables-responsive/js/datatables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{asset('fundsforlife/lib/datatables-responsive/js/lodash.min.js')}}"></script>
    <script src="{{asset('fundsforlife/js/datatables.js')}}" type="text/javascript"></script>
    <script src="{{asset('fundsforlife/js/pages.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('fundsforlife/js/pages.frontend.js')}}" type="text/javascript"></script>
<script>

    $(document).ready(function($) {
      $("#owl-example").owlCarousel();
    });

    $("body").data("page", "frontpage");
    
    /** Menu Toggle Script **/
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        toggleSidebarIcon();
    });

$("#owl-example").owlCarousel({ 
        items:3,   
/*        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,9],
        itemsTablet: [768,5],
        itemsTabletSmall: false,
        itemsMobile : [479,4]*/
})

    </script>
    
    @yield('custom-scripts')
    
    <!-- Custom scripts -->
	
    <script src="{{asset('fundsforlife/js/alerts.js')}}" type="text/javascript"></script>
	<script>
       var blade = "r"; var notif = $('#notif').val();
       $(document).ready(function(){      
        //var alertHTML = "<strong>" + notif + "</strong>.<br><br>";
       // showNotification('flip','FundsForLife',alertHTML,'top-right', 0,'success');
       });
    </script>
	<script type="text/javascript" src="{{asset('fundsforlife/lib/countdown/jquery.countdown.js')}}"></script>
    <script type="text/javascript" src="{{asset('fundsforlife/lib/countdown/script.js')}}"></script>
    <script src="{{asset('fundsforlife/js/modals.js')}}" type="text/javascript"></script>
</body>
</html>