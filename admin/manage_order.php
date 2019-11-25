<?php require_once "header.php";?>

<?php

//update data
if($_REQUEST['admin']=='confirm'){

//ส่ง email confirm
  Email_Confirm($_REQUEST['email'],$_REQUEST['detail']);

}

//update data
if($_REQUEST['admin']=='status'){

//แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
$sql = $conn->query("update orders set Ord_DateShipping = '$_REQUEST[date]',Ord_NumberShipping = '$_REQUEST[ems]',Ord_Status = '$_REQUEST[status]' where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());

//function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Update($sql,'อัพเดทข้อมูลเรียบร้อย');

}

//delete data
if($_REQUEST['admin']=='delete'){
//ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
$sql = $conn->query("delete from orders where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());

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
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลการสั่งซื้อทั้งหมด



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

                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr class="small">
                                                    <th class="small">No.</th>
                                                    <th class="small">Number Order</th>
                                                    <th class="small">ชื่อลูกค้า</th>
                                                    <th class="small">Email</th>
                                                    <th class="small">เบอร์ติดต่อ</th>
                                                    <th class="small">จำนวนสั่งซื้อ (ชิ้น)</th>
                                                    <th class="small">จำนวนเงิน (บาท)</th>
                                                    <th class="small">วันที่สั่งซื้อ</th>
                                                    <th class="small">สถานะ</th>
                                                    <th class="small" width="12%">จัดการ</th>
                                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
<?php
                
//แสดงข้อมูลตามเงื่อนไข
$sql = $conn->query("select * from orders o ,member m where o.Mem_ID = m.Mem_ID order by o.Ord_ID desc");

  $i = 1;

  while ($show = $sql->fetch_assoc()) { 

if($show['Ord_Status']==0){$status =  '<span class=text-warning>รอชำระเงิน</span>';}
else if($show['Ord_Status']==1){$status =  '<span class=text-info>ตรวจสอบชำระเงิน</span>';}
else if($show['Ord_Status']==2){$status =  '<span class=text-success>ชำระเงินเรียบร้อย</span>';}
else if($show['Ord_Status']==3){$status =  '<span class=text-primary>จัดส่งเรียบร้อย</span>';}
else if($show['Ord_Status']==4){$status =  '<span class=text-danger>ยกเลิกรายการ</span>';}

?>
                                            <tr class="small">
                   <td class="small" align="center"><?php echo $i++;?></div></td>
                  <td class="small"><a href="../print_order.php?id=<?php echo $show['Ord_ID'];?>" target="_blank"><?php echo $show['Ord_Number'];?></a></td>
                  <td class="small"><?php echo $show['Mem_Name'];?></td>
                  <td class="small"><?php echo $show['Mem_Email'];?></td>
                  <td class="small"><?php echo $show['Mem_Tel'];?></td>
                  <td class="small" align="center"><?php echo $show['Ord_AmountTotal'];?></td>
                  <td class="small" align="center"><?php echo number_format($show['Ord_PriceTotal'],0);?></td>
                  <td class="small"><?php echo $show['Ord_DateBuy'];?></td>
                  <td class="small"><?php echo $status;?></td>
                          
                  <td class="small">
                    <div align="center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    จัดการ<span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="text-left"><a href="#order<?php echo $show['Ord_ID'];?>" data-toggle="modal">Update</a></li>
                    <li class="text-left"><a href="../print_order.php?id=<?php echo $show['Ord_ID'];?>" target="_blank">Print Order</a></li>
                    <li class="text-left"><a href="?admin=delete&id=<?php echo $show['Ord_ID'];?>" onclick="return confirm('คุณแน่ใจที่จะลบรายการนี้!');">Delete</a></li>
                  </ul>
                </div>

                </div>
                </td>

                   </tr>


<div id="order<?php echo $show['Ord_ID'];?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="alert alert-danger" id="exampleModalLabel" data-toggle="modal">Update Order</h2>
      </div>
    <div class="modal-body">
        <form id="myform1" method="post" action="?admin=status&id=<?php echo $show['Ord_ID'];?>">

        <?php 

        $sql2 = $conn->query("select * from orders where Ord_ID = '$show[Ord_ID]'");
        $show2 = $sql2->fetch_assoc();
        ?>

            <div class="form-group">
            <lable>สถานะ Order:<lable>
           <select name="status" class="form-control">
           <option value="0"<?php if($show2['Ord_Status']==0){echo 'selected';}?>>รอชำระเงิน</option>
           <option value="1"<?php if($show2['Ord_Status']==1){echo 'selected';}?>>รอตรวจสอบชำระเงิน</option>
           <option value="2"<?php if($show2['Ord_Status']==2){echo 'selected';}?>>ชำระเงินเรียบร้อย</option>
           <option value="3"<?php if($show2['Ord_Status']==3){echo 'selected';}?>>จัดส่งเรียบร้อย</option>
           <option value="4"<?php if($show2['Ord_Status']==4){echo 'selected';}?>>ยกเลิกรายการ</option>
           </select>
          </div>
          
          <div class="form-group">
            <lable>วันที่จัดส่งสินค้า:<lable>
			<input type="date" name="date" class="form-control">
          </div>
          
          <div class="form-group">
            <lable>เลขที่จัดส่งสินค้า:<lable>
           <input type="text" name="ems" class="form-control">
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
