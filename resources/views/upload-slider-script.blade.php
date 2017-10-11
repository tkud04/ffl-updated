<script>
$(document).ready(function() {
	$('#response').hide();
//first populate the formdata before tampering with the file input
var pop;

// We can attach the `fileselect` event to all file inputs on the page
$(document).on('change', ':file', function() {
pop = document.querySelector('input#slider-image').files[0];
});

$('#mp-submit').click(function(e){
         e.preventDefault();
         //alert("please wait");
         
         if(document.querySelector('input#slider-image').files.length == 0){
         	if(document.querySelector('input#payment-image').files.length == 0) alert("Please upload slider image");
         } 
         
         else{
              $('#mp-submit').html("PLEASE WAIT...");
            var fd = new FormData();
         
            fd.append('slider-image', pop);
            fd.append('_token', $('#token').val());         
        
           $.ajax({
        	   url: "{{url('admin/asi')}}",
               type: "POST",
               data: fd,
               processData: false,
               contentType: false,
               cache: false,
               success: function(d){
                   $('#response').html(d);
                   $('#response').fadeIn();
                   $('#mp-submit').html("SUBMIT");
                   
                   if(d == "Slider Image has been UPLOADED.") window.location.reload();
                 }
             });
         } 
         
     });
});
</script>