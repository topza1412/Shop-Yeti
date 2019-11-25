<?php

//chk login 
function Chk_Login($session,$link){
if(!isset($session)){
Alert('กรุณาเข้าสู่ระบบ!',$link);
}

}

/*--------------------------------------------------------------------------*/


//login
function Login ($table_login,$field_user,$field_pass,$user,$pass,$link){

include "conn.php";


$sql = $conn->query("select * from $table_login where $field_user = '$user' && $field_pass = '$pass'")or die ($conn->error());


if($sql->num_rows==false){

Alert('กรุณากรอกข้อมูลให้ถูกต้อง!','index.php');
                        
}

else {
$show = $sql->fetch_array();

if($show['Mem_Permission']==1){

if($show['Mem_Status']==1){
  
$_SESSION[ses_admin_id] = $show[0];
$_SESSION[ses_admin_user] = $show[1];

Alert('ยินดีต้อนรับเข้าสู่ระบบ',$link); 

}else if($show['Mem_Status']==2){
	
$_SESSION[ses_user_id] = $show[0];
$_SESSION[ses_user_user] = $show[1];
$_SESSION[ses_user_name] = $show[3];
$_SESSION[ses_user_email] = $show[4];
$_SESSION[ses_user_tel] = $show[5];
$_SESSION[ses_user_address] = $show[6];

Alert('ยินดีต้อนรับเข้าสู่ระบบ',$link);	

}

}

else {Alert('Username นี้ ไม่สามารถใช้งานได้ชั่วคราว!','index.php');}

}


}


/*--------------------------------------------------------------------------*/


//logout
function Logout($session,$link){
unset($session);
session_destroy();
echo "<script>window.location='$link'</script>";
}

/*--------------------------------------------------------------------------*/


//Alert แจ้งเตือนต่างๆ
function Alert($text,$link){	
echo "<script language=\"javascript\">";
echo "alert('$text');";
echo "window.location='$link'";
echo "</script>";		
	}
	
/*--------------------------------------------------------------------------*/
	
//Alert แจ้งเตือนต่างๆ
function Alert_Return($text){	
echo "<script language=\"javascript\">";
echo "alert('$text');";
echo "history.back();";
echo "</script>";		
	}	
/*--------------------------------------------------------------------------*/

function Alert_Bootstarp($text){

echo '<div class="alert alert-info">
      <button type=button class=close data-dismiss=alert>&times;</button>
       <strong>'.$text.'</strong></div>';


}

/*--------------------------------------------------------------------------*/


function Alert_Bootstarp_Error($text){

echo '<div class="alert alert-danger">
      <button type=button class=close data-dismiss=alert>&times;</button>
       <strong>'.$text.'</strong></div>';


}

/*--------------------------------------------------------------------------*/


//ตรวจสอบข้อมูลของที่ select ออกมา ถ้าไม่มีข้อมูล = ค่าว่าง
function Chk_Row ($sql){
if(mysqli_num_rows($sql)==0){
echo "<center>Data not found...</center>";
}
}


/*--------------------------------------------------------------------------*/


//ตรวจสอบข้อมูลว่าถูกต้องไหม
function Chk_Correct ($sql,$text){

if(mysqli_num_rows($sql)==false){

Alert_Return($text);

}

}


/*--------------------------------------------------------------------------*/

//ตรวจสอบข้อมูลซ้ำ
function Chk_Duplicate ($sql){
	
Alert_Return('Data Duplicate!');

}


/*--------------------------------------------------------------------------*/


//ตรวจสอบเพิ่มข้อมูล
function Chk_Insert ($sql,$text,$link){
if($sql>0){
	
Alert($text,$link);

}
else {

Alert_Return('Not Complete!');

}

}


/*--------------------------------------------------------------------------*/


//ตรวจสอบการแก้ไขข้อมูล
function Chk_Update ($sql,$text){

if($sql>0){
	
Alert_Return($text);

}

else {

Alert_Return('Not Complete!');

}

}


/*--------------------------------------------------------------------------*/


//ตรวจสอบลบข้อมูล
function Chk_Delete ($sql,$text){

if($sql>0){
	
Alert_Return($text);

}
else {
	
Alert_Return('Not Complete!');

}

}


/*--------------------------------------------------------------------------*/

//เพิ่มไฟล์อัพโหลด
function Upload_File ($filename,$folder){
//เก็บรูปไว้ในโฟลเดอร์ปลายทาง
move_uploaded_file($_FILES["file"]["tmp_name"],"$folder".$filename);

}

/*--------------------------------------------------------------------------*/
    


//เพิ่มสินค้าลงตะกร้า
function Add_Cart ($pro_id){

include "conn.php";

$sql = $conn->query("select * from cart where Pro_ID = '$pro_id' && Mem_ID = '$_SESSION[ses_user_id]'")or die ($conn->error());

if($sql->num_rows>0){

  Alert_Return('สินค้านี้มีอยู่ในตะกร้าสินค้าแล้ว!');
}

else {

$conn->query("insert cart set Mem_ID = '$_SESSION[ses_user_id]',Pro_ID = '$_REQUEST[pro_id]',Car_Amount = 1")or die ($conn->error());

Alert_Return('เพิ่มสินค้าลงตะกร้าเรียบร้อย');

}

}


/*--------------------------------------------------------------------------*/

//ตรวจสอบข้อมูลจำนวนสินค้าในตะกร้า

function Total_Cart (){

include "conn.php";

$sql = $conn->query("select * from cart where Mem_ID = '$_SESSION[ses_user_id]'")or die (mysqli_error());
echo $rows = $sql->num_rows;

}


/*--------------------------------------------------------------------------*/



//แปลงวันที่จาก d-m-Y => Y-m-d
function cover_date($date){
    if($date!=""){
        $date=explode("-",$date);
        return $date[2]."-".$date[1]."-".$date[0];
    }
    
}

/****************************************************************************/



function Forgot_Password ($user,$pass,$email){

include "conn.php";

require_once('plugins/PHPMailer_v5_0_2/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsHTML(true);
$mail->Debugoutput = 'html';
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->Host = $host_smtp; // sets GMAIL as the SMTP server
$mail->Port = $port_smtp; // set the SMTP port for the GMAIL server
$mail->Username = $email_connect; // GMAIL username
$mail->Password = $pass_connect; // GMAIL password
$mail->From = $email_connect; // "name@yourdomain.com";
$mail->FromName = $title_web;  // set from Name
$mail->Subject = "แจ้งลืมรหัสผ่าน ($title_web)"; 
$mail->Body = "ระบบได้ทำการส่งรหัสผ่านมาให้ท่านเรียบร้อย <br><br> Username: $user <br><br> Password: $pass <br><br>ไปที่เว็บไซต์ >> 
<a href=$url_web/index.php>$url_web/index.php</a><br><hr>By Admin";
 
$mail->AddAddress($email, '$email'); // to 
 
$mail->Send(); 

if($mail->Send()){
Alert_Return('ระบบได้ทำการส่งรหัสผ่านไปที่ Email เรียบร้อย...');
}
else
{
Alert_Return("ไม่สามารถส่ง Email ได้! $mail->ErrorInfo");

}


}


/*--------------------------------------------------------------------------*/


?>






