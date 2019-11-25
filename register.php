<?php require_once "header.php";?>

<?php
//insert data member
if($_REQUEST['data']=='register'){

//check data ซ้ำ
$sql = $conn->query ("select * from member")or die (mysqli_error());
$show = $sql->fetch_assoc();

if($_REQUEST['user']==$show['Mem_User']){

Alert_Return('Username ซ้ำกับในระบบ');

}
else if($_REQUEST['email']==$show['Mem_Email']){

Alert_Return('Email ซ้ำกับในระบบ');

}
else {
$sql = $conn->query("insert member set Mem_User = '$_REQUEST[user]',Mem_Pass = '$_REQUEST[pass]',Mem_Name = '$_REQUEST[name]',Mem_Email = '$_REQUEST[email]',
Mem_Tel = '$_REQUEST[tel]',Mem_Address = '$_REQUEST[address]',Mem_Date = now(),Mem_Permission = 1,Mem_Status = 2");

Chk_Insert($sql,'สมัครสมาชิกเรียบร้อย','login.php');
}

}
?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

	<h2 class="alert">สมัครสมาชิก</h2>
	

	<div class="col-md-4 col-md-offset-4 content-grid">
		<form id="myform1" method="post" action="?data=register">

      <div class="form-group">
            <h3>Username:</h3>
            <input name="user" type="text" class="form-control" required value="<?php echo $show['Mem_User'];?>">
          </div>

      <div class="form-group">
            <h3>Password: <span class="text-danger small">(ไม่น้อยกว่า 6 หลัก)</span></h3>
            <input name="pass" type="password" class="form-control" minlength="6" required value="<?php echo $show['Mem_Pass'];?>">
          </div>

          <div class="form-group">
            <h3>ชื่อ-นามสกุล:</h3>
            <input name="name" type="text" class="form-control" required value="<?php echo $show['Mem_Name'];?>">
          </div>

      <div class="form-group">
            <h3>Email:</h3>
            <input name="email" type="email" class="form-control" required value="<?php echo $show['Mem_Email'];?>">
          </div>

          <div class="form-group">
            <h3>Tel:</h3>
            <input name="tel" type="text" class="form-control" maxlength="10" required value="<?php echo $show['Mem_Tel'];?>"  onKeyPress="CheckNum()">
          </div>

          <div class="form-group">
            <h3>ที่อยู่:</h3>
            <textarea name="address" class="form-control" rows="5" required></textarea>
          </div>

      <div class="clear"></div>

      <span class="text-danger">*กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง!</span>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-grad">สมัครสมาชิก</button>
        <button type="button" class="btn btn-danger btn-grad" data-dismiss="modal">ยกเลิก</button>
      </div>

        </form>

		</div>

		<div class="clearfix"> </div>

	</div>

	<div class="clearfix"> </div>
	</div>
	<!---->

<?php require_once "footer.php";?>

</body>
</html>