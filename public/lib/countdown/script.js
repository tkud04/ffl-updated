$(function(){
	
	var note = $('#note'),
		ts = new Date(2012, 0, 1),
		newYear = false;
	
	if(blade == "r") ts = (new Date()).getTime() + 3*24*60*60*1000;
	else if(blade == "ph") ts = (new Date()).getTime() + 3*60*60*1000;
	else if(blade == "c") ts = (new Date()).getTime() + 1*24*60*60*1000;
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			if(newYear){
				message += "left until the new year!";
			}
			else {
				message += "left before your account is blocked!";
			}
			
			note.html(message);
			
			//if(seconds % 3 == 0) count();
		}
	});
	
});


function count(){
console.log("about to update countdown...");
fd = new FormData();
fd.append("_token", $('#token').val());

$.ajax({
        	   url: $('#url').val(),
               type: "POST",
               data: fd,
               processData: false,
               contentType: false,
               cache: false,
               success: function(d){
                  console.log(d);
              }
          });
          
}