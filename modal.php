<?php
//login chk
if($_REQUEST['login']=='chk'){

//ส่งค่า login ไปที่ function ที่สร้างไว้
Login_User('member','Mem_User','Mem_Pass',$_REQUEST['user'],$_REQUEST['pass'],'index.php');

}

//forgot password
if($_REQUEST['mail']=='forgot_pass'){

$sql = $conn->query("select * from member where Mem_User = '$_REQUEST[user]' && Mem_Email = '$_REQUEST[email]'")or die (mysqli_error());
if($sql->num_rows==0){
	Alert_Return('ข้อมูลไม่ถูกต้อง!');
	}
	else {
$show = $sql->fetch_assoc();
Forgot_Password($show['Mem_User'],$show['Mem_Pass'],$show['Mem_Email']);
	}
	
}


//insert data member
if($_REQUEST['data']=='register'){

//check data ซ้ำ
$sql = $conn->query ("select * from member where Mem_User = '$_REQUEST[user]' or  Mem_Email = '$_REQUEST[email]'")or die (mysqli_error());
if(mysqli_num_rows($sql)>0){

Chk_Duplicate ($sql);

}
else {
$sql = $conn->query("insert member set Mem_User = '$_REQUEST[user]',Mem_Pass = '$_REQUEST[pass]',Mem_Name = '$_REQUEST[name]',Mem_Email = '$_REQUEST[email]',
Mem_Tel = '$_REQUEST[tel]',Mem_Address = '$_REQUEST[address]',Mem_Date = now(),Mem_Permission = 1,Mem_Status = 2");

Chk_Insert($sql,'สมัครสมาชิกเรียบร้อย','index.php');
}

}


//update data member
if($_REQUEST['data']=='edit'){

//check data ซ้ำ
$sql = $conn->query("select * from member where Mem_User = '$_REQUEST[user]' && Mem_ID != '$_SESSION[ses_user_id]'")or die ($conn->error());
if($sql->num_rows>0){

Chk_Duplicate ($sql);

}
else {
$sql = $conn->query("update member set Mem_User = '$_REQUEST[user]',Mem_Pass = '$_REQUEST[pass]',Mem_Name = '$_REQUEST[name]',Mem_Email = '$_REQUEST[email]',
Mem_Tel = '$_REQUEST[tel]',Mem_Position = '$_REQUEST[position]',Mem_Address = '$_REQUEST[address]' where Mem_ID = '$_SESSION[ses_user_id]'")or die ($conn->error());
Chk_Update($sql,'แก้ไขข้อมูลเรียบร้อย');
}

}


//ตั้งกระทู้
if($_REQUEST['data']=='webboard'){

$detail = nl2br($_REQUEST['detail']);

$sql = $conn->query("insert webboard set Mem_ID = '$_SESSION[ses_user_id]',Web_Title = '$_REQUEST[title]',Web_Detail = '$detail',Web_DateCreate = now()")or die (mysqli_error());

Chk_Insert($sql,'ตั้งกระทู้เรียบร้อย...','webboard.php');

}

?>

<script type="text/javascript">
  
//modal bootstrap
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* 
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})

</script>

 
<div id="login" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-success" id="exampleModalLabel" data-toggle="modal">เข้าสู่ระบบ</h2>
      </div>
    <div class="modal-body">
        <form id="myform1" method="post" action="?login=chk">

      <label for="basic-url"> Username </label>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3"></span>
  <input name="user" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="User name">
  </div>

      <label for="basic-url"> Password </label>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3"></span>
  <input name="pass" type="password" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Password">
  </div>


      <div class="clear"></div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
        <a href="#forgot_pass" data-toggle="modal"><button type="button" class="btn btn-warning" data-dismiss="modal">ลืมรหัสผ่าน</button></a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------->



 <div id="forgot_pass" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-danger" id="exampleModalLabel" data-toggle="modal">กรอกข้อมูลเพื่อขอรหัสผ่าน</h2>
      </div>
	  <div class="modal-body">
        <form id="myform1" method="post" action="?mail=forgot_pass">

		  <div class="form-group">
            <lable for="basic-url">Username:<lable>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="user" type="text" class="form-control"  required="required">
            </div>
          </div>
		  <div class="form-group">
            <lable for="basic-url">Email:<lable>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="email" type="email" class="form-control"  required="required">
            </div>
            </div>

		  <div class="clear"></div>
		  <div class="modal-footer">
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------->


<div id="register" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-success" id="exampleModalLabel" data-toggle="modal">สมัครสมาชิก</h2>
      </div>
    <div class="modal-body">
        <form id="myform1" method="post" action="?data=register">

      <div class="form-group">
            <h3>Username:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="user" type="text" class="form-control" required value="<?php echo $show['Mem_User'];?>">
            </div>
          </div>

      <div class="form-group">
            <h3>Password: <span class="text-danger">(ไม่น้อยกว่า 6 หลัก)</span></h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="pass" type="password" class="form-control" minlength="6" required value="<?php echo $show['Mem_Pass'];?>">
            </div>
          </div>

          <div class="form-group">
            <h3>ชื่อ-นามสกุล:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="name" type="text" class="form-control" required value="<?php echo $show['Mem_Name'];?>">
            </div>
          </div>

      <div class="form-group">
            <h3>Email:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="email" type="email" class="form-control" required value="<?php echo $show['Mem_Email'];?>">
            </div>
          </div>

          <div class="form-group">
            <h3>Tel:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="tel" type="text" class="form-control" maxlength="10" required value="<?php echo $show['Mem_Tel'];?>"  onKeyPress="CheckNum()">
            </div>
          </div>

          <div class="form-group">
            <h3>ที่อยู่:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <textarea name="address" class="form-control" rows="5" required></textarea>
            </div>
          </div>

      <div class="clear"></div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-grad">สมัครสมาชิก</button>
        <button type="button" class="btn btn-danger btn-grad" data-dismiss="modal">ยกเลิก</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------->



<div id="edit_profile" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-primary" id="exampleModalLabel" data-toggle="modal">แก้ไขข้อมูลส่วนตัว</h2>
      </div>
    <div class="modal-body">
        <form id="myform1" method="post" action="?data=update">
    <?php
    $sql = $conn->query("select * from member where Mem_ID = '$_SESSION[ses_user_id]'");
      $show = $sql->fetch_assoc();
    ?>

      <div class="form-group">
            <h3>Username:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="user" type="text" class="form-control" required value="<?php echo $show['Mem_User'];?>">
            </div>
          </div>

      <div class="form-group">
            <h3>Password:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="pass" type="password" class="form-control" required value="<?php echo $show['Mem_Pass'];?>">
            </div>
          </div>

          <div class="form-group">
            <h3>ชื่อ-นามสกุล:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="name" type="text" class="form-control" required value="<?php echo $show['Mem_Name'];?>">
            </div>
          </div>

      <div class="form-group">
            <h3>Email:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="email" type="email" class="form-control" required value="<?php echo $show['Mem_Email'];?>">
            </div>
          </div>

          <div class="form-group">
            <h3>Tel:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="tel" type="text" class="form-control" required value="<?php echo $show['Mem_Tel'];?>"  onKeyPress="CheckNum()">
            </div>
          </div>
          
           <div class="form-group">
            <h3>ที่อยู่:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <textarea name="address" class="form-control" rows="5" required><?php echo $show['Mem_Address'];?></textarea>
            </div>
          </div>


      <div class="clear"></div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-grad">แก้ไขข้อมูล</button>
        <button type="button" class="btn btn-danger btn-grad" data-dismiss="modal">ยกเลิก</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------->



<div id="webboard" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-primary" id="exampleModalLabel" data-toggle="modal">ตั้งกระทู้ใหม่</h2>
      </div>
    <div class="modal-body">
        <form id="myform1" method="post" action="?data=webboard">
     
      <div class="form-group col-md-12">
            <h3>หัวข้อกระทู้:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <input name="title" type="text" class="form-control" required>
            </div>
          </div>

          <div class="form-group col-md-12">
            <h3>รายละเอียด:</h3>
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"></span>
            <textarea name="detail" class="form-control" rows="5"  required></textarea>
            </div>
          </div>

      <div class="clear"></div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-grad">ตั้งกระทู้</button>
        <button type="button" class="btn btn-danger btn-grad" data-dismiss="modal">ยกเลิก</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------->


 </body>
</html>
