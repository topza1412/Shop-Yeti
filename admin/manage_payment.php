<?php require_once "header.php";?>

<?php

//update data
if($_REQUEST['admin']=='update'){

//แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
$sql = $conn->query("update payment set Pay_Status = '$_REQUEST[status]' where Pay_ID = '$_REQUEST[id]'");

$sql = $conn->query("update orders set Ord_Status = '2' where Ord_ID = '$_REQUEST[ord_id]'");

//function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Update($sql,'อัพเดทข้อมูลเรียบร้อย');

}

//delete data
if($_REQUEST['admin']=='delete'){
//ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
$sql = $conn->query("delete from payment where Pay_ID = '$_REQUEST[id]'")or die (mysqli_error());

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

           


							<!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลการชำระเงินทั้งหมด



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

                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                    <th width="10%" class="small">No.</th>
                                                    <th width="auto" class="small">Number Order</th>
                                                    <th width="auto" class="small">ชื่อลูกค้า</th>
                                                    <th width="auto" class="small">เบอร์ติดต่อ</th>
                                                    <th width="auto" class="small">โอนเข้าธนาคาร</th>
                                                    <th width="auto" class="small">วันที่โอน</th>
                                                    <th width="auto" class="small">เวลาที่โอน</th>
                                                    <th width="auto" class="small">สถานะ</th>
                                                    <th width="20%" class="small">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
 <?php
  if(!$_REQUEST['txt_search']) {                   
//แสดงข้อมูลตามเงื่อนไข
$sql = $conn->query("select * from payment order by Pay_ID desc");
}
else {
$sql = $conn->query("select * from payment where Pay_Name like '%$_REQUEST[txt_search]%' or Pay_Tel like '%$_REQUEST[txt_search]%' order by Pay_ID desc");

}
  $i = 1;

  while ($show= $sql->fetch_assoc()) {

$sql2 = $conn->query("select * from orders where Ord_ID = '$show[Ord_ID]'");
$show2 = $sql2->fetch_assoc();
?>
                                            <tr>
                  <td class="small" align="center"><?php echo $i++;?></div></td>
                  <td class="small"><a href="../print_order.php?id=<?php echo $show2['Ord_ID'];?>" target="_blank">
                  <?php echo $show2['Ord_Number'];?></a></td>
                  <td class="small"><?php echo $show['Pay_Name'];?></td>
                  <td class="small"><?php echo $show['Pay_Tel'];?></td>
                  <td class="small"><?php echo $show['Pay_Bank'];?></td>
                  <td class="small"><?php echo $show['Pay_Date'];?></td>
                  <td class="small"><?php echo $show['Pay_Time'];?></td>
                  <td class="small">
                  <?php if($show['Pay_Status']==0){echo '<span class=text-danger>ตรวจสอบ</span>';}
                  else if($show['Pay_Status']==1){echo '<span class=text-success>ชำระเรียบร้อย</span>';}
                  ?></td>
                  <td class="small" align="center"><a href="#payment<?php echo $show['Pay_ID'];?>" data-toggle="modal">
                  <input name="" type="button" class="btn btn-primary btn-grad " value="ตรวจสอบ"></a>
                  <a href="?admin=delete&id=<?php echo $show['Ord_ID'];?>"><input name="" type="button" class="btn btn-danger btn-grad" value="Delete"></a></div></td>
                                            </tr>

<div id="payment<?php echo $show['Pay_ID'];?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="alert alert-danger" id="exampleModalLabel" data-toggle="modal">Update Payment</h2>
      </div>
    <div class="modal-body">
        <form id="myform1" method="post" action="?admin=update&id=<?php echo $show['Pay_ID'];?>">

        <?php 

        $sql3 = $conn->query("select * from payment where Pay_ID = '$show[Pay_ID]'");
        $show3 = $sql3->fetch_assoc();
        ?>
        <input type="hidden" name="ord_id" value="<?php echo $show3['Ord_ID'];?>">

            <div class="form-group">
            <lable>หลักฐานการโอนเงิน:<lable>
            <a href="../images/payment/<?php echo $show3['Pay_File'];?>" target="_blank"><img src="../images/payment/<?php echo $show3['Pay_File'];?>" width="530" height="300"></a>
            </div>

            <div class="form-group">
            <lable>สถานะ:<lable>
           <select name="status" class="form-control">
           <option value="0"<?php if($show3['Pay_Status']==0){echo 'selected';}?>>ตรวจสอบ</option>
           <option value="1"<?php if($show3['Pay_Status']==1){echo 'selected';}?>>ชำระเรียบร้อย</option>
           </select>
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


                                            <?php } ?>
                                        </tbody>
                                    </table>

                            
                            <?php Chk_Row($sql);?>
          
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
