<?php require_once "header.php";?>

<?php 

//ยกเลิกรายการ
if($_REQUEST['data']=='delete'){

$sql = $conn->query("update orders set Ord_Status = 4 where Ord_ID = '$_REQUEST[id]'");
Chk_Update($sql,'ยกเลิกรายการเรียบร้อย');

}

?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

	<h2 class="alert">ประวัติการสั่งซื้อสินค้า</h2>

  <hr>
	

	<div class="col-md-12 content-grid">
		
<div class="table-responsive">
	     <table class="table table-striped table-bordered table-hover" id="table_example">
                                            <thead>
                                                <tr>
                                                    <th width="5%" class="small"><div align="center">ลำดับ</div></th>
                                                    <th width="auto" class="small"><div align="center">Order Number</div></th>
                                                    <th width="auto" class="small"><div align="center">ชื่อลูกค้า</div></th>
                                                    <th width="auto" class="small"><div align="center">Email</div></th>
                                                    <th width="auto" class="small"><div align="center">Tel</div></th>
                                                    <th width="auto" class="small"><div align="center">วันที่สั่งซื้อ</div></th>
                                                    <th width="auto" class="small"><div align="center">สถานะ</div></th>
                                                    <th width="auto" class="small"><div align="center">View Order</div></th>
                                                    <th width="auto" class="small"><div align="center">แจ้งชำระเงิน</div></th>
                                                    <th width="auto" class="small"><div align="center">ยกเลิก</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
        <?php

//แสดงข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from orders o,member m where o.Mem_ID = m.Mem_ID && o.Mem_ID = '$_SESSION[ses_user_id]'");
 $i = 1;
  while ($show= $sql->fetch_assoc()) {

if($show['Ord_Status']==0){$status = '<span class=text-wrning>รอชำระเงิน</span>';}
else if($show['Ord_Status']==1){$status = '<span class=text-success>ตรวจสอบชำระเงิน</span>';}
else if($show['Ord_Status']==2){$status = '<span class=text-info>ชำระเงินเรียบร้อย</span>';}
else if($show['Ord_Status']==3){$status = '<span class=text-primary>จัดส่งเรียบร้อย</span>';}
else if($show['Ord_Status']==4){$status = '<span class=text-danger>ยกเลิกรายการ</span>';}
?>
                  <tr>
                  <td class="small"><div align="center"><?php echo $i++;?></div></td>
                  <td class="small"><div align="center"><?php echo $show['Ord_Number'];?></div></td>
                  <td class="small"><div align="center"><?php echo $show['Mem_Name'];?></div></td>
                  <td class="small"><div align="center"><?php echo $show['Mem_Email'];?></div></td>
                  <td class="small"><div align="center"><?php echo $show['Mem_Tel'];?></div></td>
                  <td class="small"><div align="center"><?php echo $show['Ord_DateBuy'];?></div></td>
                  <td class="small"><div align="center"><?php echo $status;?></div></td>
                   <td class="small"><div align="center"><a href="print_order.php?id=<?php echo $show['Ord_ID'];?>" target="_blank" class="btn btn-primary">View Order</a></div></td>
                    <td class="small"><div align="center">
                    <?php if($show['Ord_Status']==0 or $show['Ord_Status']==1){?>	
                    <a href="payment.php?id=<?php echo $show['Ord_ID'];?>" class="btn btn-success">ชำระเงิน</a>
                    <?php } else {echo '-';}?>
                    </div></td>
                     <td class="small"><div align="center"><?php if($show['Ord_Status']==0 or $show['Ord_Status']==1){?><a href="?data=delete&id=<?php echo $show['Ord_ID'];?>" onClick="return confirm('คุณแน่ใจที่จะยกเลิกรายการนี้!');" class="btn btn-danger">ยกเลิกรายการ</a><?php } else {echo '-';}?></div></td>
                  </tr>

<?php } ?>
          

          <tr>
          <td colspan="12">
           <?php Chk_Row($sql);?>
          </td>
          </tr>
 </tbody>
</table>
                                        </div>

		</div>

		<div class="clearfix"> </div>

	</div>

	<div class="clearfix"> </div>
	</div>
	<!---->

<?php require_once "footer.php";?>

</body>
</html>