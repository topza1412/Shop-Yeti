<?php require_once "header.php";?>

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
                    <div class="panel panel-body panel-primary alert-danger"><h3>ยินดีต้อนรับสู่ระบบจัดการ <?php echo $title_web;?></h3></div>
                </div>
                <!--End Page Header -->
            </div>

            <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลการสั่งซื้อทั้งหมด
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                    <th class="small">No.</th>
                                                    <th class="small">Number Order</th>
                                                    <th class="small">ชื่อลูกค้า</th>
                                                    <th class="small">Email</th>
                                                    <th class="small">เบอร์ติดต่อ</th>
                                                    <th class="small">จำนวนสั่งซื้อ (ชิ้น)</th>
                                                    <th class="small">จำนวนเงิน (บาท)</th>
                                                    <th class="small">วันที่สั่งซื้อ</th>
                                                    <th class="small">สถานะ</th>
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
                  <tr>
                  <td class="small" align="center"><?php echo $i++;?></div></td>
                  <td class="small"><a href="../print_order.php?id=<?php echo $show['Ord_ID'];?>" target="_blank"><?php echo $show['Ord_Number'];?></a></td>
                  <td class="small"><?php echo $show['Mem_Name'];?></td>
                  <td class="small"><?php echo $show['Mem_Email'];?></td>
                  <td class="small"><?php echo $show['Mem_Tel'];?></td>
                  <td class="small" align="center"><?php echo $show['Ord_AmountTotal'];?></td>
                  <td class="small" align="center"><?php echo number_format($show['Ord_PriceTotal'],0);?></td>
                  <td class="small"><?php echo $show['Ord_DateBuy'];?></td>
                  <td class="small"><?php echo $status;?></td>
                  
                                            </tr>
                                            <?php } ?>

                                            <tr><td colspan="10"><?php Chk_Row($sql);?></td></tr>

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
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
