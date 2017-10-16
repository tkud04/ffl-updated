'use strict';
function showNotification(style, title, message, position, timeout, type){
$('body').pgNotification({style:style,title:title,message:message,position:position,timeout:0,type:type}).show();
}
