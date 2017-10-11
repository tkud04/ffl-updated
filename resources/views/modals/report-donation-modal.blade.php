<div class="modal fade stick-up disable-scroll" id="ReportDonationModal" tabindex="-1" role="dialog" aria-hidden="false">
<div class="modal-dialog ">
<div class="modal-content-wrapper">
<div class="modal-content">
<div class="modal-header clearfix text-left">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
<h5>Report <span class="semi-bold">Donation</span></h5>
<p class="p-b-10">The user account will be disabled if you report the donation. Be sure to confirm from the user first!</p>
</div>
<div class="modal-body">
<div class="panel panel-transparent">
<div class="panel-heading">
<div class="panel-title">REPORT DONATION</div>
</div>
<div class="panel-body">
         <form id="rdf" action="{{url('report-donation')}}" method="post" autocomplete="off">
    	  <input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">    	
      	<input type="hidden" id = "rgrepo" name="grepo" value="">    
      	<input type="hidden" id = "rprice" name="price" value="">    	    	      
        </form>    
<div class="row">
<div class="col-sm-12">
  <div class = "btn-group btn-group-justified" aria-label="..." role="group">
    	<a class="btn btn-danger" role="button" href="#" id="rdfs">YES</a>
        <a class="btn btn-warning" role="button" href="#" data-dismiss="modal">NO</a>
    </div><br>
</div>
</div>
</div>
</div>


</div>
</div>
</div>
 
</div>
</div>