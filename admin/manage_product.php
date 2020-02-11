<?php require_once "header.php";?>

<?php
//insert data
if($_REQUEST['admin']=='insert'){

//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถเพิ่มข้อมูลได้
$sql = $conn->query("select * from product where Pro_Name = '$_REQUEST[name]'")or die (mysqli_error());

if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {
$detail = nl2br($_REQUEST['detail']);

$file = strrchr($_FILES['file']['name'], "."); //ตัดนามสกุลไฟล์เก็บไว้
$filename = (Date("dmy_His").$file); //ตั้งเป็น วันที่_เวลา.นามสกุล
$folder = "../images/product/"; // path folder
$width = 400;// ความกว้างของภาพ
$height = 500;// ความยาวของภาพ

Upload_File ($filename,$folder,$width,$height);


//เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
$sql = $conn->query("insert product set Pro_Img = '$filename',Pro_Name = '$_REQUEST[name]',Pro_Detail = '$detail',Pro_Price = '$_REQUEST[price]',Pro_Amount = '$_REQUEST[amount]',Pro_Date = now()");


//function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','manage_product.php');
}


}


//update data
if($_REQUEST['admin']=='update'){

//check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถแก้ไขข้อมูลได้
$sql = $conn->query("select * from product where Pro_Name = '$_REQUEST[name]' && Pro_ID != '$_REQUEST[id]'")or die (mysqli_error());
if($sql->num_rows>0){

//function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Duplicate ($sql);

}
else {

$detail = nl2br($_REQUEST['detail']);

$file = strrchr($_FILES['file']['name'], "."); //ตัดนามสกุลไฟล์เก็บไว้
$filename = (Date("dmy_His").$file); //ตั้งเป็น วันที่_เวลา.นามสกุล
$folder = "../images/product/"; // path folder
$width = 0;// ความกว้างของภาพ
$height = 0;// ความยาวของภาพ        

if($file){

Upload_File ($filename,$folder,$width,$height);

//แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
$sql = $conn->query("update product set Pro_Img = '$filename',Pro_Name = '$_REQUEST[name]',Pro_Detail = '$detail',Pro_Price = '$_REQUEST[price]',Pro_Amount = '$_REQUEST[amount]' where Pro_ID = '$_REQUEST[id]'")or die (mysqli_error());

}

else {

//แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
$sql = $conn->query("update product set Pro_Name = '$_REQUEST[name]',Pro_Detail = '$detail',Pro_Price = '$_REQUEST[price]',Pro_Amount = '$_REQUEST[amount]' where Pro_ID = '$_REQUEST[id]'")or die (mysqli_error());

}

//function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Update($sql,'แก้ไขข้อมูลเรียบร้อย');
}

}

//delete data
if($_REQUEST['admin']=='delete'){
//ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
$sql = $conn->query("delete from product where Pro_ID = '$_REQUEST[id]'")or die (mysqli_error());

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
                                    <form name="form1" id="myform1" action="?admin=insert" method="post" enctype="multipart/form-data" onsubmit="return chk_error();">

									<div class="form-group col-lg-4">
                                    <label>รูปสินค้า</label>
                                    
                                    <div class="form-group has-feedback">
                                      <input type="file"  id="file" name="file" required class="file">
                                    </div>
                                    </div>
                                    


                                    <div class="form-group col-lg-4">
                                    <label>ชื่อสินค้า</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="name" type="text" required class="form-control css-require">
                                    </div>
                                    </div>


                                    <div class="form-group col-lg-12">
                                    <label>รายละเอียดสินค้า</label>
                                    
                                    <div class="form-group has-feedback">
                                    <textarea name="detail" required class="form-control css-require" rows="7"></textarea>
                                    </div>
                                    </div>


                                    <div class="form-group col-lg-2">
                                    <label>จำนวนสินค้า</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="amount" type="text" required class="form-control css-require">
                                    </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                    <label>ราคา (บาท)</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="price" type="text" required class="form-control css-require">
                                    </div>
                                    </div>
                                    

                                    <div class="clearfix"></div>
                                    <hr>

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
                                    <form name="form1" id="myform1" action="?admin=update&id=<?php echo $_REQUEST['id'];?>" method="post" onsubmit="return chk_error();" enctype="multipart/form-data">

									<?php 
									$sql = $conn->query("select * from product where Pro_ID = '$_REQUEST[id]'")or die (mysqli_error());
									$show = $sql->fetch_assoc ();
									?>

                                    <div class="form-group col-lg-4">
                                    <img src="../images/product/<?php echo $show['Pro_Img'];?>" width=130 height=120>
                                    <br>
                                    <label>รูปสินค้า</label>
                                    <div class="form-group has-feedback">
                                      <input type="file"  id="file" name="file" class="file">
                                    </div>
                                    </div>

                                    <div class="form-group col-lg-4">
                                    <label>ชื่อสินค้า</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="name" type="text" class="form-control css-require" value="<?php echo $show['Pro_Name'];?>">
                                    </div>
                                    </div>
                                    

                                    <div class="form-group col-lg-12">
                                    <label>รายละเอียดสินค้า</label>
                                    
                                    <div class="form-group has-feedback">
                                    <textarea name="detail" class="form-control css-require" rows="7"><?php echo str_replace('<br />',"",$show['Pro_Detail']);?></textarea>
                                    </div>
                                    </div>


                                    <div class="form-group col-lg-2">
                                    <label>จำนวนสินค้า</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="amount" type="text" class="form-control css-require" value="<?php echo $show['Pro_Amount'];?>">
                                    </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                    <label>ราคา (บาท)</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="price" type="text" class="form-control css-require" value="<?php echo $show['Pro_Price'];?>">
                                    </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>

                                    <div class="form-group col-lg-2">
                                    <label>จำนวนที่ขายได้</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="buy" type="text" disabled class="form-control css-require"  value="<?php echo $show['Pro_Buy'];?>">
                                    </div>
                                    </div>

                                    <div class="form-group col-lg-2">
                                    <label>Date Create</label>
                                    
                                    <div class="form-group has-feedback">
                                    <input name="buy" type="text" disabled class="form-control css-require"  value="<?php echo $show['Pro_Date'];?>">
                                    </div>
                                    </div>
                                    


                                    <div class="clearfix"></div>


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
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลสินค้าทั้งหมด



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
                                                    <th width="auto"><div align="center">สินค้า</div></th>
                                                    <th width="auto"><div align="center">ราคา</div></th>
                                                    <th width="auto"><div align="center">Date Create</div></th>
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
$sql = $conn->query("select * from product order by Pro_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from product order by Pro_ID desc")or die (mysqli_error());
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
$sql = $conn->query("select * from  product  where Pro_Name like '%$_REQUEST[txt_search]%' order by Pro_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกค้นหาเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from  product  where Pro_Name like '%$_REQUEST[txt_search]%' order by Pro_ID desc")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);
		}

  $i = 1;

  while ($show= $sql->fetch_assoc()) {

?>
                  <tr>
                  <td><div align="center"><?php echo $i++;?></div></td>
                  <td><div align="center"><?php echo $show['Pro_Name'];?></div></td>
                  <td><div align="center"><?php echo $show['Pro_Price'];?></div></td>
                  <td><div align="center"><?php echo $show['Pro_Date'];?></div></td>
				  <td><div align="center"><a href="?admin=edit&id=<?php echo $show['Pro_ID'];?>"><input name="" type="button" class="btn btn-primary" value="Edit"></a>&nbsp;<a href="?admin=delete&id=<?php echo $show['Pro_ID'];?>"><input name="" type="button" class="btn btn-danger" value="Delete"></a></div></td>
                  </tr>
				  <?php }?>

                  <!-- ส่วนของการแสดงเลขแบ่งหน้า ถ้าไม่พบข้อมูลเลยจะขึ้นว่า Data Not Found แต่ถ้ามีข้อมูลจะขึ้นเลขแบ่งหน้า-->
                  <tr>
                    <td colspan="6"><div align="center"><?php if($sql->num_rows==0){Chk_Row($sql);}else {?><nav>
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
