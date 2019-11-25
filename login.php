<?php require_once "header.php";?>

<?php
//login chk
if($_REQUEST['data']=='login'){

//ส่งค่า login ไปที่ function ที่สร้างไว้
Login('member','Mem_User','Mem_Pass',$_REQUEST['user'],$_REQUEST['pass'],'index.php');

}

//forgot password
if($_REQUEST['mail']=='forgot_pass'){

$sql = $conn->query("select * from member where Mem_User = '$_REQUEST[user]' && Mem_Email = '$_REQUEST[email]'")or die ($conn->error());
if($sql->num_rows==0){
	Alert_Return('ข้อมูลไม่ถูกต้อง!');
	}
	else {
$show = $sql->fetch_assoc();
Forgot_Password($show['Mem_User'],$show['Mem_Pass'],$show['Mem_Email']);
	}
	
}
?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

	<?php if(!$_REQUEST['data']=='forgot_pass'){?>

	<form  class="alert" action="?data=login" method="post" enctype="multipart/form-data">

 					<div class="col-md-4 col-md-offset-4">

 					<div class="alert bg-info">                  
                    <div class="panel-heading">
                        <h3><strong>เข้าสู่ระบบ</strong></h3>
                    </div>
                    <div class="panel-body">

<label> Username </label>
  <input name="user" type="text" required class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="User name">

<label> Password </label>
  <input name="pass" type="password" required class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Password">

                                    <div class="clearfix"></div>

									<div class="alert text-right">
                                    <input name="submit" type="submit" class="btn btn-success btn-grad" value="Login">
                                    <input name="" type="button" class="btn btn-danger btn-grad" onclick="window.location='?data=forgot_pass';" value="Forgot Password">
                                    </div>

									</div>

									</div>
									</div>

                                    </form>

                                    <?php } else {?>

	<form  class="alert" action="?mail=forgot_pass" method="post" enctype="multipart/form-data">

 					<div class="col-md-4 col-md-offset-4">

 					<div class="alert bg-danger">                  
                    <div class="panel-heading">
                        <h3 class="text-danger"><strong>ขอรหัสผ่านใหม่</strong></h3>
                    </div>
                    <div class="panel-body">

<label> Username </label>
  <input name="user" type="text" required class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="User name">

<label> Email </label>
  <input name="email" type="email" required class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Password">

                                    <div class="clearfix"></div>

                                    <div class="alert text-right">
                                    <input name="submit" type="submit" class="btn btn-success btn-grad" value="Login">
                                    <input name="" type="button" class="btn btn-danger btn-grad" onclick="window.location='login.php';" value="Cancel">
                                    </div>

									</div>

									</div>
									</div>

                                    </form>

                                    <?php } ?>

		<div class="clearfix"> </div>

	</div>

	<div class="clearfix"> </div>
	</div>
	<!---->

<?php require_once "footer.php";?>

</body>
</html>