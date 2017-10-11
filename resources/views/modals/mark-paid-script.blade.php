<script>
$(document).ready(function() {
	$('#response').hide();
//first populate the formdata before tampering with the file input
var pop;

// We can attach the `fileselect` event to all file inputs on the page
$(document).on('change', ':file', function() {
pop = document.querySelector('input#payment-image').files[0];
});

$('#mp-submit').click(function(e){
         e.preventDefault();
         //alert("please wait");
         pt = $('#payment-type').val();
         sn = $('#slip-name').val();
         
         if(document.querySelector('input#payment-image').files.length == 0 || pt == "" || sn == ""){
         	if(document.querySelector('input#payment-image').files.length == 0) alert("Please upload proof of payment");
             if(pt =="") $().attr({"placeholder":"Enter payment type to proceed"});
             if(sn =="") $().attr({"placeholder":"Enter slip name to proceed"});
         } 
         
         else{
              $('#mp-submit').html("PLEASE WAIT...");
            var fd = new FormData();
         
            fd.append('payment-image', pop);
            fd.append('_token', $('#token').val());
            fd.append('payment-type', pt);
            fd.append('slip-name',sn);
            fd.append('grepo', $('#grepo').val());
            fd.append('price', $('#price').val());
        
           $.ajax({
        	   url: "{{url('mark-paid')}}",
               type: "POST",
               data: fd,
               processData: false,
               contentType: false,
               cache: false,
               success: function(d){
                   $('#response').html(d);
                   $('#response').fadeIn();
                   $('#mp-submit').html("SUBMIT");
                   
                   if(d == "User has been marked as PAID.") window.location = "dashboard";
                 }
             });
         } 
         
     });
});
</script>