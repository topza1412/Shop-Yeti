<?php require_once "header.php";?>

<?php 
//update จำนวนสินค้า
if($_REQUEST['data']=='amount'){

$conn->query("update cart set Car_Amount = '$_REQUEST[amount]' where Car_ID = '$_REQUEST[cart_id]'");  

Alert_Return('อัพเดทจำนวนสินค้าเรียบร้อย!');

}

//update จำนวนสินค้า
if($_REQUEST['data']=='delete'){

$conn->query("delete from cart where Car_ID = '$_REQUEST[cart_id]'");  

Alert_Return('ลบสินค้าเรียบร้อย!');

}

?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

	<h2 class="alert">ตะกร้าสินค้า</h2>

	<div class="col-md-12 content-grid">
		
<div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th width="auto"><div align="center">ลำดับ</div></th>
                                                    <th width="auto"><div align="center">รูปสินค้า</div></th>
                                                    <th width="auto"><div align="center">สินค้า</div></th>
                                                    <th width="auto"><div align="center">จำนวน</div></th>
                                                    <th width="auto"><div align="center">ราคา / หน่วย</div></th>
                                                    <th width="auto"><div align="center">ราคารวม</div></th>
                                                    <th width="auto"><div align="center">ลบ</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
        <?php

//แสดงข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from cart c , product p where c.Pro_ID = p.Pro_ID && c.Mem_ID = '$_SESSION[ses_user_id]' order by c.Car_ID desc");
$row = $sql->num_rows;
 $s = 1;
  while ($show= $sql->fetch_assoc()) {

    $total_price = $show['Car_Amount'] * $show['Pro_Price'];
?>
                  <tr>
                  <td><div align="center"><?php echo $s++;?></div></td>
                  <td><div align="center"><img src="images/product/<?php echo $show['Pro_Img'];?>" width="70" height="70"></div></td>
                  <td><div align="center"><?php echo $show['Pro_Name'];?></div></td>
                  <td><div align="center">
                   <select name="amount" id="type" onChange="window.location='?data=amount&cart_id=<?php echo $show['Car_ID'];?>&amount='+this.value;">
                   <?php 
              $sql3 = $conn->query("select * from product where Pro_ID = '$show[Pro_ID]'"); 
              $show3 = $sql3->fetch_assoc();
              for($i=1;$i<=$show3['Pro_Amount'];$i++){
       ?>
    <option value="<?php echo $i;?>"<?php if($show['Car_Amount']==$i){echo 'selected';}?>><?php echo $i;?></option>
                               
                               <?php }?>
                        </select>

                  </div></td>
                  <td><div align="center"><?php echo number_format($show['Pro_Price'],0);?></div></td>
                  <td><div align="center"><?php echo number_format($total_price,0);?></div></td>
                  <td><div align="center"><a href="?data=delete&cart_id=<?php echo $show['Car_ID'];?>"><button type="button" onclick="return confirm('ยืนยันการลบสินค้า',<?php echo $show['Pro_ID'];?>);" class="btn btn-danger">ลบ</button></a></div></td>
                  </tr>

          <?php }?>

          <tr>
          <td colspan="8">
          <?php if($row==0){Chk_Row($sql);}else {?>
          <div align="right"><button type="button" onclick="window.location='order.php';" class="btn btn-success btn-xl">ทำรายการต่อ >> </button></div>
          <?php } ?>
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