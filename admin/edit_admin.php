<?php require_once "header.php";?>


<?php 

if($_REQUEST['admin']=='edit'){
	
//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถแก้ไขข้อมูลได้
$sql = $conn->query("select * from member where Mem_User = '$_REQUEST[user]' && Mem_ID != '$_SESSION[ses_admin_id]'")or die (mysqli_error());

if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);	
	
}
else {
	
	//เพิ่มข้อมูลแอดมิน
	$sql = $conn->query("update member set Mem_Name = '$_REQUEST[name]',Mem_User = '$_REQUEST[user]',Mem_Pass = '$_REQUEST[pass]',Mem_Email = '$_REQUEST[email]' where Mem_ID = '$_SESSION[ses_admin_id]'")or die (mysqli_error());
	
	Chk_Update($sql,'แก้ไขข้อมูลเรียบร้อย');
	}

	}
?>
    <!--  wrapper -->
    <div id="wrapper">
	
        <?php 
			  require_once "menu_left.php";
		?>
		
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <div class="panel panel-body panel-primary alert-danger"><h3>ยินดีต้อนรับสู่ระบบจัดการข้อมูล <?php echo $title;?></h3></div>
                </div>
                <!--End Page Header -->
            </div>
			

            <div class="row">
                <div class="col-lg-12">
					
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> แก้ไขข้อมูลส่วนตัว
                           
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="?admin=edit" method="post">
									
									<?php 
									//แสดงข้อมูลตาม session ที่ login
									$sql = $conn->query("select * from member where Mem_ID = '$_SESSION[ses_admin_id]'");
									$show = $sql->fetch_assoc();
									?>
									
									<div class="col-lg-6 form-group">
									<label>ชื่อ-นามสกุล</label>
									<input name="name" type="text" class="form-control" required value="<?php echo $show[Mem_Name];?>">
									</div>

									<div class="col-lg-6 form-group">
									<label>E-mail</label>
									<input name="email" type="email" class="form-control" required value="<?php echo $show[Mem_Email];?>">
									</div>
									
									
									<div class="col-lg-6 form-group">
									<label>Username</label>
									<input name="user" type="text" class="form-control" required value="<?php echo $show[Mem_User];?>">
									</div>
									
									<div class="col-lg-6 form-group">
									<label>Password</label>
									<input name="pass" type="password" class="form-control" required value="<?php echo $show[Mem_Pass];?>">
									</div>


									<div class="col-lg-4 form-group">
									<input name="" type="submit" class="btn btn-primary panel-info" value="ยืนยัน">
									<input name="" type="reset" class="btn btn-danger panel-info" value="ยกเลิก">
									
									</div>
									
									</form>

                                </div>

                            </div>
                            <!-- /.row -->
							
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->

                </div>

            </div>

                    </div>
                    <!--End Chat Panel Example-->
                </div>
            </div>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
