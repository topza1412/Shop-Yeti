<?php
session_start ();
//เรียกใช้ไฟล์ connect db
require_once "../conn.php";
require_once "../function.php";


if($_REQUEST['login']=='chk'){

Login('member','Mem_User',
'Mem_Pass',$_REQUEST['user'],$_REQUEST['pass'],'main.php');

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_web;?></title>
	
<link href=../css/BackEnd/assets/plugins/bootstrap/bootstrap.css rel=stylesheet />
<link href=../css/BackEnd/assets/plugins/bootstrap/bootstrap.min.css rel=stylesheet />
<link href=../css/BackEnd/assets/font-awesome/css/font-awesome.css rel=stylesheet />
<link href=../css/BackEnd/assets/plugins/pace/pace-theme-big-counter.css rel=stylesheet />
<link href=../css/BackEnd/assets/css/style.css rel=stylesheet />
<link href=../css/BackEnd/assets/css/main-style.css rel=stylesheet />
<link href=../css/BackEnd/assets/plugins/morris/morris-0.4.3.min.css rel=stylesheet />

<!--javascript ของระบบ-->
<script src=../css/BackEnd/assets/plugins/jquery-1.10.2.js></script>
<script src=../css/BackEnd/assets/plugins/bootstrap/bootstrap.min.js></script>
<script src=../css/BackEnd/assets/plugins/metisMenu/jquery.metisMenu.js></script>
<script src=../css/BackEnd/assets/plugins/pace/pace.js></script>
<script src=../css/BackEnd/assets/scripts/siminta.js></script>
<!--javascript เขียนเอง-->
<script src=../javascript/function_javascript.js></script>
<script src=../ajax/insert-delete.js></script>
<!--plugins-->
<script src=../plugins/ckeditor/ckeditor.js></script>
   
   </head>
<body class="body-Login-back">
   <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title pannel-body"><strong>สำหรับผู้ดูแลระบบ</strong></h3>
                    </div>
                    <div class="panel-body">
                        <form id="myform1" name="form1" role="form" method="post" action="?login=chk" onSubmit="return remember()" >
                            <fieldset>
                                <div class="form-group">
								<div class="form-group has-feedback">
                                    <input class="form-control css-require" placeholder="Username" name="user" type="text" autocomplete="off" value="<?php echo $_COOKIE['CK_username']?>">
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
                                </div>
								
                                <div class="form-group">
								<div class="form-group has-feedback">
                                    <input class="form-control css-require" placeholder="Password" name="pass" type="password" value="<?php echo $_COOKIE['CK_password']?>">
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
                                </div>
								
                                <!-- Change this to a button or input when using this as a form -->
                                <input name="" type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
