<div class="modal fade stick-up disable-scroll" id="CannotPayModal" tabindex="-1" role="dialog" aria-hidden="false">
<div class="modal-dialog ">
<div class="modal-content-wrapper">
<div class="modal-content">
<div class="modal-header clearfix text-left">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
<h5>I Can Not <span class="semi-bold">Pay</span></h5>
<p class="p-b-10">Your account will be disabled if you fail to pay more than ONCE.</p>
</div>
<div class="modal-body">
<div class="panel panel-transparent">
<div class="panel-heading">
<div class="panel-title">I CANNOT PAY</div>
</div>
<div class="panel-body">
<div class="row">
<form role="form" id="capf" action="{{url('cannot-pay')}}" method="post" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
<input type="hidden" id="grepo" name="grepo" value="{{$ret['receiver_id']}}">
</form>

<div class="col-sm-12">
  <div class = "btn-group btn-group-justified" aria-label="..." role="group">
    	<a class="btn btn-danger" id="capfs" role="button" href="">YES</a>
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