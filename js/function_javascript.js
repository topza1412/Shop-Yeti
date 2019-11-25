//refresh page 
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload();",timeoutPeriod);
}


//check number
function CheckNum(){
		if (event.keyCode < 48 || event.keyCode > 57){
		alert('Enter only number');
		      event.returnValue = false;
	    	}
	}



    //sum price product auto
function sum(){
var obj= document.all;

    obj.price_discount.value=parseInt(obj.total_price.value)-parseInt(obj.discount.value);

    obj.change.value=parseInt(obj.pay.value)-parseInt(obj.price_discount.value);
}

	
	
//remember login	
function remember(){
	var j_keep_login=document.form1.keep_login;
	var i_username=document.form1.user.value;
	var i_password=document.form1.pass.value;
	if(j_keep_login.checked==true){
		var days=30; // day remember
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
		document.cookie = "CK_username=" +i_username+ "; expires=" + expires + "; path=/";
		document.cookie = "CK_password=" +i_password+ "; expires=" + expires + "; path=/";
	}else{
		var expires="";
		document.cookie = "CK_username="+expires+";-1;path=/";
		document.cookie = "CK_password="+expires+";-1;path=/";		
	}
}


//popup windows
function popup(url,name,windowWidth,windowHeight){    
    myleft=(screen.width)?(screen.width-windowWidth)/2:100; 
    mytop=(screen.height)?(screen.height-windowHeight)/2:100;   
    properties = "width="+windowWidth+",height="+windowHeight;
    properties +=",scrollbars=yes, top="+mytop+",left="+myleft;   
    window.open(url,name,properties);
}


//check form validator jquery
$(function(){

     var obj_check=$(".css-require");
     $("#myform1").on("submit",function(){  
         obj_check.each(function(i,k){
             var status_check=0;
             if(obj_check.eq(i).find(":radio").length>0 || obj_check.eq(i).find(":checkbox").length>0){
                 status_check=(obj_check.eq(i).find(":checked").length==0)?0:1;
             }else{
                 status_check=($.trim(obj_check.eq(i).val())=="")?0:1;
             }
             formCheckStatus($(this),status_check);
         });
         if($(this).find(".has-error").length>0){
              return false;
         }
     });

     obj_check.on("change",function(){
         var status_check=0;
         if($(this).find(":radio").length>0 || $(this).find(":checkbox").length>0){
             status_check=($(this).find(":checked").length==0)?0:1;
         }else{
             status_check=($.trim($(this).val())=="")?0:1;
         }
         formCheckStatus($(this),status_check);
     });

     var formCheckStatus = function(obj,status){
         if(status==1){
             obj.parent(".form-group").removeClass("has-error").addClass("has-success");
             obj.next(".glyphicon").removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
         }else{
             obj.parent(".form-group").removeClass("has-success").addClass("has-error");
             obj.next(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
         }
     }

 });
 

//modal bootstrap
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* 
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})



//time date auto
 function date_time(id) {
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
            d = date.getDate();
            day = date.getDay();
            days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            h = date.getHours();
            if (h < 10) {
                h = "0" + h;
            }
            m = date.getMinutes();
            if (m < 10) {
                m = "0" + m;
            }
            s = date.getSeconds();
            if (s < 10) {
                s = "0" + s;
            }
            result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
            document.getElementById(id).innerHTML = result;
            setTimeout('date_time("' + id + '");', '1000');
            return true;
        }


//table auto angular selected
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });

