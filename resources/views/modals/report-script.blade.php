<script>
$(document).ready(function(){
  $('#rm_0').click(function(e){
    e.preventDefault();
    //alert(temp0);
   // alert(temp0.g); alert(temp0.p);
    $('#rgrepo').val(temp0.g);
     $('#rprice').val(temp0.p);
    // alert($('#rgrepo').val()); alert($('#rprice').val()); 
      $('#ReportDonationModal').modal("show");
  });
  
  $('#rm_1').click(function(e){
    e.preventDefault();
    //alert(temp1);
   // alert(temp1.g); alert(temp1.p);
$('#rgrepo').val(temp1.g);
     $('#rprice').val(temp1.p);
    // alert($('#rgrepo').val()); alert($('#rprice').val()); 
      $('#ReportDonationModal').modal("show");
  });
  
    $('#rdfs').click(function(e){
         e.preventDefault();
         $('#rdf').submit();
     });
});
</script>