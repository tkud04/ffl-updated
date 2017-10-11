<div class="modal fade disable-scroll" id="MarkAsPaidModal" tabindex="-1" role="dialog" aria-hidden="false">
<div class="modal-dialog ">
<div class="modal-content-wrapper">
<div class="modal-content">
<div class="modal-header clearfix text-left">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
<h5>Mark as <span class="semi-bold">Paid</span></h5>
<p class="p-b-10">We need payment information inorder to comfirm your payment</p>
</div>
<div class="modal-body">
<div id ="response" class ="alert alert-primary"></div>
<form role="form" action="{{url('mark-paid')}}" method="post" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" id = "token" name="_token" value="{{ csrf_token() }}">
 <input type="hidden" id="grepo" name="grepo" value="{{$ret['user_id']}}">
<input type="hidden" id="price" name="price" value="{{$ret['amount']}}">
<div class="form-group-attached">
<div class="row">
<div class="col-sm-12">
<div class="form-group form-group-default">
<label>Payment Type</label>
<input name="payment-type" id="payment-type"  type="text" class="form-control">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-4">
<div class="form-group form-group-default">
<label>Name on Payslip</label>
<input name="slip-name" id="slip-name"  type="text" class="form-control">
</div>
</div>
<div class="col-sm-8">
<div class="form-group form-group-default">
<label>Proof of Payment</label>
<input type="file"id= "payment-image" name="payment-image" class="form-control" />
</div>
</div>
</div>
</div>
</form>
<div class="row">
<div class="col-sm-12 m-t-10 sm-m-t-10">
<button type="button" class="btn btn-primary btn-block m-t-5" id="mp-submit">Pay Now</button>
</div>
</div>
</div>
</div>
</div>
 
</div>
</div>