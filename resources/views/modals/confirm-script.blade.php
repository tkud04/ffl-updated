<script>
$(document).ready(function(){
  $('#cm_0').click(function(e){
    e.preventDefault();
    //alert(temp0);
    //alert(temp0.g); alert(temp0.p);
    $('#grepo').val(temp0.g);
     $('#price').val(temp0.p);
      
      $('#ConfirmPaymentModal').modal("show");
  });
  
  $('#cm_1').click(function(e){
    e.preventDefault();
    //alert(temp0);
   // alert(temp1.g); alert(temp1.p);
    $('#grepo').val(temp1.g);
     $('#price').val(temp1.p);
      
      $('#ConfirmPaymentModal').modal("show");
  });
  
    $('#cpfs').click(function(e){
         e.preventDefault();
         $('#cpf').submit();
     });
});
</script>