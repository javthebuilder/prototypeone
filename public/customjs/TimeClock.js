var tempArrMonth=["January","Febuary","March","April","May","June","July","August","September","October","November","December"];function setCurrentTime(){var e=new Date,t=e.getDate(),r=e.getFullYear(),n=e.getMonth(),u=e.getHours()>12?e.getHours()-12:e.getHours();u=u<10?"0"+u:u;var o=e.getHours()>=12?"PM":"AM",a=e.getMinutes();a=a<10?"0"+a:a;var s=tempArrMonth[n]+" "+t+" "+r+" "+u+":"+a+" "+o;$("#currenttime").html(s)}setInterval(setCurrentTime,1e4),setCurrentTime(),$(document).ready(function(){setInterval(function(){$.ajax({url:"/apichecksession",type:"GET",success:function(e){},statusCode:{401:function(){window.location.href="/login"}},error:{}})},2e3)});