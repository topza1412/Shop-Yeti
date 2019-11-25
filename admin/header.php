<?php
session_start ();

//เรียกใช้ไฟล์ connect db,function
require_once "../conn.php";
require_once "../function.php";

//ตรวจสอบการ login เข้าระบบ
Chk_Login($_SESSION['ses_admin_id'],'../index.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title_web;?></title>

			<!-- Bootstrap core CSS -->
<link href=../css/BackEnd/assets/plugins/bootstrap/bootstrap.css rel=stylesheet />
<link href=../css/BackEnd/assets/font-awesome/css/font-awesome.css rel=stylesheet />
<link href=../css/BackEnd/assets/css/style.css rel=stylesheet />
<link href=../css/BackEnd/assets/css/main-style.css rel=stylesheet />
<link href=../css/BackEnd/assets/plugins/morris/morris-0.4.3.min.css rel=stylesheet />

<!-- datepicker -->
<link rel="stylesheet" media="all" type="text/css" href="../plugins/jquerydatepicker/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="../plugins/jquerydatepicker/jquery-ui-timepicker-addon.css">

<!--javascript ของระบบ-->
<script src=../css/BackEnd/assets/plugins/jquery-1.10.2.js></script>
<script src=../css/BackEnd/assets/plugins/bootstrap/bootstrap.min.js></script>
<script src=../css/BackEnd/assets/plugins/metisMenu/jquery.metisMenu.js></script>
<script src=../css/BackEnd/assets/scripts/siminta.js></script>
<!--javascript เขียนเอง-->
<script src=../js/function_javascript.js></script>

<!--plugins ckeditor-->
<script src=../plugins/ckeditor/ckeditor.js></script>
<!-- datepicker -->
<script type="text/javascript" src="../plugins/jquerydatepicker/jquery-ui.min.js"></script>
<script type="text/javascript" src="../plugins/jquerydatepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="../plugins/jquerydatepicker/jquery-ui-sliderAccess.js"></script>

<!-- datepicker-->
<script type="text/javascript">
    
     $(function(){
    $("#dateinput1").datepicker({dateFormat: 'dd-mm-yy',minDate:0,});
    $("#dateinput2").datepicker({dateFormat: 'dd-mm-yy',minDate:0,});
    $("#dateinput3").datepicker({dateFormat: 'dd-mm-yy',minDate:0,});
});


</script>

		</head>
<body>
   <navbar top>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <navbar-header>
          <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                   
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand " href="main.php">
                    <h4>Admin System</h4>
                </a> <!-- <span id="date_time" style="color: #000000; font-size: x-large;"></span>
	<script type="text/javascript"> window.onload = date_time('date_time');</script> -->
				
            </div>
            <end navbar-header>
            <navbar-top-links>
            
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

