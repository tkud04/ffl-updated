<script>
  $('#pm_0').click(function(e){
    e.preventDefault();
    //alert(temp0);
    //alert(temp0.pt);
    $('#ptype').html(temp0.pt);
     $('#sname').html(temp0.sn);
      $('#pimage').attr("src",temp0.pi);
      
      $('#PaymentInformationModal').modal("show");
  });
  
  $('#pm_1').click(function(e){
    e.preventDefault();
    //alert(temp0);
    //alert(temp0.pt);
    $('#ptype').html(temp1.pt);
     $('#sname').html(temp1.sn);
      $('#pimage').attr("src",temp1.pi);
      
      $('#PaymentInformationModal').modal("show");
  });
</script>