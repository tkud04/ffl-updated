(function($){
 'use strict';
$('#mp').click(function(e){ 
        e.preventDefault(); 
        $('#MarkAsPaidModal').modal('show');
 });
 
  $('#cap').click(function(e){ 
        e.preventDefault(); 
        $('#CannotPayModal').modal('show');
 });
 
  })(window.jQuery);