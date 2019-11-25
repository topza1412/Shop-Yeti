<?php require_once "header.php";?>

<?php
//insert data
if($_REQUEST['admin']=='insert'){

//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถเพิ่มข้อมูลได้
$sql = $conn->query("select * from brand where Bra_Name = '$_REQUEST[name]'")or die (mysqli_error());

if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {
//เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
$sql = $conn->query("insert brand set Bra_Name = '$_REQUEST[name]'");

//function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','manage_brand.php');
}


}


//update data
if($_REQUEST['admin']=='update'){

//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถแก้ไขข้อมูลได้
$sql = $conn->query("select * from brand where Bra_Name = '$_REQUEST[name]' && Bra_ID != '$_REQUEST[id]'")or die (mysqli_error());
if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {
//แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
$sql = $conn->query("update brand set Bra_Name = '$_REQUEST[name]' where Bra_ID = '$_REQUEST[id]'")or die (mysqli_error());

//function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Update($sql,'แก้ไขข้อมูลเรียบร้อย');
}


}

//delete data
if($_REQUEST['admin']=='delete'){
//ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
$sql = $conn->query("delete from brand where Bra_ID = '$_REQUEST[id]'")or die (mysqli_error());

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
                                    <form id="myform1" action="?admin=insert" method="post">

									<div class="col-lg-3 form-group">
									<label>ยี่ห้อสินค้า</label>
									<div class="form-group has-feedback">
									<input name="name" type="text" class="form-control css-require">
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									</div>

									<div class="col-lg-12 form-group">
									<input name="submit" type="submit" class="btn btn-success panel-info" value="ยืนยัน">
									<input name="" type="reset" class="btn btn-danger panel-info" value="ยกเลิก">

									</div>

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
                                    <form id="myform1" action="?admin=update&id=<?php echo $_REQUEST['id'];?>" method="post">

									<?php 
									$sql = $conn->query("select * from brand where Bra_ID = '$_REQUEST[id]'")or die (mysqli_error());
									$show = $sql->fetch_assoc ();
									?>

									<div class="col-lg-3 form-group">
									<label>ยี่ห้อสินค้า</label>
									<div class="form-group has-feedback">
									<input name="name" type="text" class="form-control css-require" value="<?php echo $show[Bra_Name];?>">
									</div>
									</div>


									<div class="col-lg-12 form-group">
									<input name="" type="submit" class="btn btn-primary panel-info" value="ยืนยัน">
									<input name="" type="reset" class="btn btn-danger panel-info" value="ยกเลิก">

									</div>

									</form>

                                </div>

                            </div>

							<?php } ?>
                            <!-- /.row -->



							<!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลยี่ห้อสินค้าทั้งหมด



                        </div>
						<div class="col-lg-4 form-group panel-body panel-primary sidebar-search">

						<form autocomplete="off" class="input-group custom-search-form">

	<input name="txt_search" type="text" id="course" size="50" class="form-control" placeholder="ค้นหาข้อมูล" required="required" /><span class="input-group-btn">
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
                                                    <th width="5%"><div align="center">ลำดับ</div></th>
                                                    <th width="40%"><div align="center">ยี่ห้อสินค้า</div></th>
													<th width="15%"><div align="center">จัดการ</div></th>

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
$sql = $conn->query("select * from brand order by Bra_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from brand order by Bra_ID desc")or die (mysqli_error());
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
$sql = $conn->query("select * from brand where Bra_Name like '%$_REQUEST[txt_search]%' order by Bra_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกค้นหาเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from brand where Bra_Name like '%$_REQUEST[txt_search]%' order by Bra_ID desc")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);
		}

  $i = 1;

  while ($show= $sql->fetch_assoc()) {

?>
                  <tr>
                  <td><div align="center"><?php echo $i++;?></div></td>
                  <td><div align="center"><?php echo $show['Bra_Name'];?></div></td>
				  <td><div align="center"><a href="?admin=edit&id=<?php echo $show['Bra_ID'];?>"><input name="" type="button" class="btn btn-primary" value="Edit"></a>&nbsp;<a href="?admin=delete&id=<?php echo $show['Bra_ID'];?>"><input name="" type="button" class="btn btn-danger" value="Delete"></a></div></td>
                  </tr>
				  <?php }?>

                  <!-- ส่วนของการแสดงเลขแบ่งหน้า ถ้าไม่พบข้อมูลเลยจะขึ้นว่า Data Not Found แต่ถ้ามีข้อมูลจะขึ้นเลขแบ่งหน้า-->
                  <tr>
                    <td colspan="5"><div align="center"><?php if($sql->num_rows==0){Chk_Row($sql);}else {?><nav>
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
