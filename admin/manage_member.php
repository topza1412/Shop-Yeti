<?php require_once "header.php";?>

<?php
//insert data
if($_REQUEST['admin']=='insert'){

//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถเพิ่มข้อมูลได้
$sql = $conn->query("select * from member where Mem_User = '$_REQUEST[user]'");

if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {

//เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
$sql = $conn->query("insert member set Mem_User = '$_REQUEST[user]',Mem_Pass = '$_REQUEST[pass]',Mem_Name = '$_REQUEST[name]',Mem_Email = '$_REQUEST[email]',
Mem_Tel = '$_REQUEST[tel]',Mem_Address = '$_REQUEST[address]',Mem_Date = now(),Mem_Permission = 1,Mem_Status = 2")or die (mysqli_error());

//function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','manage_member.php');
}


}


//update data
if($_REQUEST['admin']=='update'){

//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถแก้ไขข้อมูลได้
$sql = $conn->query("select * from member where Mem_User = '$_REQUEST[user]' && Mem_ID != '$_REQUEST[id]'")or die (mysqli_error());
if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {
//แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
$sql = mysqli_query($conn,"update member set Mem_User = '$_REQUEST[user]',Mem_Pass = '$_REQUEST[pass]',Mem_Name = '$_REQUEST[name]',Mem_Email = '$_REQUEST[email]',
Mem_Tel = '$_REQUEST[tel]',Mem_Address = '$_REQUEST[address]',Mem_Permission = '$_REQUEST[permission]' where Mem_ID = '$_REQUEST[id]'")or die (mysqli_error());

//function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Update($sql,'แก้ไขข้อมูลเรียบร้อย');
}


}

//delete data
if($_REQUEST['admin']=='delete'){
//ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
$sql = $conn->query("delete from member where Mem_ID = '$_REQUEST[id]'")or die (mysqli_error());

//function delete ข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Delete($sql,'ลบข้อมูลเรียบร้อย');
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
                    <div class="panel panel-body panel-primary alert-danger"><h3>ยินดีต้อนรับสู่ระบบจัดการข้อมูล <?php echo $title_web;?></h3></div>
                </div>
                <!--End Page Header -->
            </div>

            <?php if($_REQUEST['admin']=='add'){?>

            <div class="row">
                <div class="col-lg-12">

                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> เพิ่มข้อมูล

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <form action="?admin=insert" method="post" role="form" class="wowload fadeInRight">
       <div class="form-group col-md-6">
            <h3>Username:</h3>
            <input name="user" type="text" class="form-control" required>
          </div>

      <div class="form-group col-md-6">
            <h3>Password:</h3>
            <input name="pass" type="password" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <h3>ชื่อ-นามสกุล:</h3>
            <input name="name" type="text" class="form-control" required>
          </div>

      <div class="form-group col-md-6">
            <h3>Email:</h3>
            <input name="email" type="email" class="form-control" required>
          </div>

          <div class="form-group col-md-6">
            <h3>Tel:</h3>
            <input name="tel" type="text" class="form-control" required onKeyPress="CheckNum()">
          </div>

          <div class="form-group col-md-12">
            <h3>ที่อยู่สมาชิก:</h3>
            <textarea name="address" class="form-control" rows="5"  required="required"></textarea>
          </div>
		  
  
  <div class="clearfix"></div>

        <button type="submit" class="btn btn-success">ยืนยัน</button> <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
    </form>    

                                </div>

                            </div>

							<?php } ?>
                            <!-- /.row -->




							<?php if($_REQUEST['admin']=='edit'){?>

            <div class="row">
                <div class="col-lg-12">

                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> แก้ไขข้อมูล

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="?admin=update&id=<?php echo $_REQUEST['id'];?>" method="post" role="form" class="wowload fadeInRight">
      <?php
		$sql = $conn->query("select * from member where Mem_ID = '$_REQUEST[id]'");
    	$show = $sql->fetch_assoc();
		?>

		  <div class="form-group col-md-6">
            <h3>Username:</h3>
            <input name="user" type="text" class="form-control" required value="<?php echo $show['Mem_User'];?>">
          </div>

		  <div class="form-group col-md-6">
            <h3>Password:</h3>
            <input name="pass" type="password" class="form-control" required value="<?php echo $show['Mem_Pass'];?>">
          </div>

          <div class="form-group col-md-12">
            <h3>ชื่อ-นามสกุล:</h3>
            <input name="name" type="text" class="form-control" required value="<?php echo $show['Mem_Name'];?>">
          </div>

		  <div class="form-group col-md-6">
            <h3>Email:</h3>
            <input name="email" type="email" class="form-control" required value="<?php echo $show['Mem_Email'];?>">
          </div>

          <div class="form-group col-md-6">
            <h3>Tel:</h3>
            <input name="tel" type="text" class="form-control" required value="<?php echo $show['Mem_Tel'];?>"  onKeyPress="CheckNum()">
          </div>

          <div class="form-group col-md-12">
            <h3>ที่อยู่สมาชิก:</h3>
            <textarea name="address" class="form-control" rows="5"  required="required"><?php echo $show['Mem_Address'];?></textarea>
          </div>

  <div class="form-group col-md-4">
            <h3>สิทธิ์การใช้งาน:</h3>
            <select name="permission" class="form-control">
            <option value="1"<?php if($show['Mem_Permission']==1){echo 'selected';}?>>ใช้งานปกติ</option>
            <option value="2"<?php if($show['Mem_Permission']==2){echo 'selected';}?>>ยกเลิก</option>
            </select>
          </div>

          <div class="clearfix"></div>
  
        <button type="submit" class="btn btn-primary">ยืนยัน</button> <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
    </form>    
                                </div>

                            </div>

							<?php } ?>
                            <!-- /.row -->



							<!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลสมาชิกทั้งหมด



                        </div>
						<div class="col-lg-4 form-group panel-body panel-primary sidebar-search">

						<form autocomplete="off" class="input-group custom-search-form">

	<input name="txt_search" type="text" id="course" size="50" class="form-control" placeholder="ค้นหาข้อมูล" required /><span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>

</form>

</div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">

									<div class="panel"><a href="?admin=add"><input name="" type="button" class="btn btn-success" value="เพิ่มข้อมูล ++"></a></div>

                                        <table class="table table-striped table-bordered table-hover" id="table_example2">
                                            <thead>
                                                <tr>
                                                    <th width="auto"><div align="center">ลำดับ</div></th>
                                                    <th width="auto"><div align="center">ชื่อ-นามสกุล</div></th>
                                                    <th width="auto"><div align="center">Username</div></th>
                                                    <th width="auto"><div align="center">Email</div></th>
                                                    <th width="auto"><div align="center">สิทธิ์การใช้งาน</div></th>
                                                    <th width="auto"><div align="center">วันที่เป็นสมาชิก</div></th>
													<th width="auto"><div align="center">จัดการ</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
				<?php
				if(!$_REQUEST['txt_search']){

			//โค๊ดแบ่งหน้า
			$perpage = 10;
			if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
			$start = ($page - 1) * $perpage;

//แสดงข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from member where Mem_Status = 2  order by Mem_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from member where Mem_Status = 2 order by Mem_ID desc")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);


		}
		else {

		//โค๊ดแบ่งหน้า
			$perpage = 10;
			if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
			$start = ($page - 1) * $perpage;

//ค้นหาข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from member where Mem_Status = 2 && Mem_Name like '%$_REQUEST[txt_search]%' or Mem_User like '%$_REQUEST[txt_search]%' or Mem_Email like '%$_REQUEST[txt_search]%' or Mem_Tel like '%$_REQUEST[txt_search]%' order by Mem_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกค้นหาเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from member where Mem_Status = 2 && Mem_Name like '%$_REQUEST[txt_search]%' or Mem_User like '%$_REQUEST[txt_search]%' or Mem_Email like '%$_REQUEST[txt_search]%' or Mem_Tel like '%$_REQUEST[txt_search]%' order by Mem_ID desc")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);
		}

  $i = 1;

  while ($show= mysqli_fetch_assoc($sql)) {

?>
                  <tr>
                  <td><div align="center"><?php echo $i++;?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Name'];?></div></td>
                  <td><div align="center"><?php echo $show['Mem_User'];?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Email'];?></div></td>
                  <td><div align="center"><?php if($show['Mem_Permission']==1){echo 'ใช้งานปกติ';}else {echo 'ยกเลิก';}?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Date'];?></div></td>
				  <td><div align="center"><a href="?admin=edit&id=<?php echo $show['Mem_ID'];?>"><input name="" type="button" class="btn btn-primary" value="Edit"></a>&nbsp;<a href="?admin=delete&id=<?php echo $show['Mem_ID'];?>"><input name="" type="button" class="btn btn-danger" value="Delete"></a></div></td>
                  </tr>
				  <?php }?>

                  <!-- ส่วนของการแสดงเลขแบ่งหน้า ถ้าไม่พบข้อมูลเลยจะขึ้นว่า Data Not Found แต่ถ้ามีข้อมูลจะขึ้นเลขแบ่งหน้า-->
                  <tr>
                    <td colspan="8"><div align="center"><?php if(mysqli_num_rows($sql)==0){Chk_Row($sql);}else {?><nav>
 <ul class="pagination">
 <li>
 <a href="?page=1" aria-label="Previous">
 <span aria-hidden="true">&laquo;</span> </a> </li>
 <?php for($i=1;$i<=$total_page;$i++){ ?>
 <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 <?php } ?>
 <li>
 <a href="?page=<?php echo $total_page;?>" aria-label="Next">
 <span aria-hidden="true">&raquo;</span> </a> </li>
 </ul>
 </nav><?php } ?></div></td>
                    </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->



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

    </div></div>
    <!-- end wrapper -->

</body>

</html>
