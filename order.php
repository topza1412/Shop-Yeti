<?php require_once "header.php";?>

<?php 
//update จำนวนสินค้า
if($_REQUEST['data']=='confirm'){

//สร้างเลขที่ order 
$order = date('dmyHis'); 
  
$conn->query("insert orders set Mem_ID = '$_SESSION[ses_user_id]',Ord_Number = '$order',Ord_AddressSend = '$_REQUEST[address]',Ord_Note = '$_REQUEST[note]',Ord_Shipping = '$_REQUEST[shipping]',Ord_AmountTotal = '$_REQUEST[total_amount]',Ord_DateBuy = now(),Ord_Status = 0")or die ($conn->error());

//id last
$sql = $conn->query("select * from orders order by Ord_ID desc")or die ($conn->error());
$show = $sql->fetch_assoc();

$sql2 = $conn->query("select * from cart where Mem_ID = '$_SESSION[ses_user_id]'")or die ($conn->error());

while ($show2 = $sql2->fetch_assoc()){  

//insert product detail 
$conn->query("insert order_detail set Ord_ID = '$show[Ord_ID]',Pro_ID = '$show2[Pro_ID]',Odd_Amount = '$show2[Car_Amount]'")or die ($conn->error());

//insert price total
$total_price = $show2['Car_Amount'] * $_REQUEST['shipping'];
$total_price = $_REQUEST['total_price'] + $total_price;

$conn->query("update orders set Ord_PriceTotal = '$total_price' where Ord_ID = '$show[Ord_ID]'");

//update stock product
$conn->query("update product set Pro_Buy = Pro_Buy+1,Pro_Amount = Pro_Amount-'$show2[Car_Amount]' where Pro_ID = '$show2[Pro_ID]'")or die ($conn->error());

}

//delete cart total
$conn->query("delete from cart where Mem_ID = '$_SESSION[ses_user_id]'");


Alert('ทำการสั่งซื้อเรียบร้อย','history_order.php');

}

//update จำนวนสินค้า
if($_REQUEST['data']=='cancel'){

$conn->query("delete from cart where Mem_ID = '$_SESSION[ses_user_id]'");  

Alert_Return('ลบสินค้าเรียบร้อย!');

}

?>

	<div class="content-grids">

	<h2 class="alert">ยืนยันการสั่งซื้อสินค้า</h2>

	<div class="col-md-12 content-grid">
		
<div class="table-responsive">

<form  class="form-horizontal" id="myform1" name="form" action="?data=confirm" method="post" enctype="multipart/form-data">
        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th width="auto"><div align="center">ลำดับ</div></th>
                                                    <th width="auto"><div align="center">รูปสินค้า</div></th>
                                                    <th width="auto"><div align="center">สินค้า</div></th>
                                                    <th width="auto"><div align="center">จำนวน</div></th>
                                                    <th width="auto"><div align="center">ราคา / หน่วย</div></th>
                                                    <th width="auto"><div align="center">ราคารวม</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
        <?php

//แสดงข้อมูลตามเงื่อนไข
$sql = $conn->query("select * from cart c , product p , member m where c.Pro_ID = p.Pro_ID && c.Mem_ID = m.Mem_ID && c.Mem_ID = '$_SESSION[ses_user_id]' order by c.Car_ID desc");

 $i = 1;
  while ($show= $sql->fetch_assoc()) {

$address = $show['Mem_Address'];    

$total_price = $show['Car_Amount'] * $show['Pro_Price'];

//ราคารวมของสินค้ายังไม่หักส่วนลด
$total += $show['Car_Amount'] * $show['Pro_Price'];

$total_amount += $show['Car_Amount'];

//ผลรวมส่วนลดทั้งหมด
$total_discount += $show['Car_Amount'] * $show['Pro_Discount'];

//ผลรวมราคาทั้งหมด ลบ กับ ส่วนลด ทั้งหมด
$total_all = $total - $total_discount;
?>

<input type="hidden" name="total_amount" value="<?php echo $total_amount;?>">
<input type="hidden" name="total_price" value="<?php echo $total_all;?>">

                  <tr>
                  <td><div align="center"><?php echo $i++;?></div></td>
                  <td><div align="center"><img src="images/product/<?php echo $show['Pro_Img'];?>" width="70" height="70"></div></td>
                  <td><div align="center"><?php echo $show['Pro_Name'];?></div></td>
                  <td><div align="center"><?php echo $show['Car_Amount'];?></div></td>
                  <td><div align="center"><?php echo number_format($show['Pro_Price'],0);?></div></td>
                  <td><div align="center"><?php echo number_format($total_price,0);?></div></td>
                  </tr>

          <?php }?>

           <tr>
            <td colspan="7" class="alert bg-info" align="right">

            <span class="text-warning"><b>ราคาสินค้าทั้งหมด:</b>&nbsp;&nbsp;<?php echo number_format($total,2);?>&nbsp;&nbsp;<b>บาท</b></span>
            <br> 
            <span class="text-success"><b>ส่วนลดโปรโมชั่นทั้งหมด:</b>&nbsp;&nbsp;<?php echo number_format($total_discount,2);?>&nbsp;&nbsp;<b>บาท</b></span>
            <br> 
            <span class="text-info"><b>รวมจำนวนเงินที่ต้องชำระ: <span class="text-danger">(ไม่รวมค่าจัดส่ง)</span></b>&nbsp;&nbsp;<?php echo number_format($total_all,0);?>&nbsp;&nbsp;<b>บาท</b></span>
            <br> 
            </td>

          </tr>

          <tr>
          <td colspan="7" align="left">
          <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> ข้อมูลการจัดส่งสินค้า
                        </div>

                        <div class="panel-body">
                            
                   <div class="col-lg-12">

                  <div class="form-group">
                  <label class="control-label col-lg-5">Address / ที่อยู่จัดส่ง</label>
                  <div class="col-lg-7">
                  <div class="form-group has-feedback">
                  <textarea name="address" class="form-control css-require" rows="7" required><?php echo $address;?></textarea>
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-lg-5">รายละเอียดเพิ่มเติม</label>
                  <div class="col-lg-7">
                  <div class="form-group has-feedback">
                  <textarea name="note" class="form-control css-require" rows="7"></textarea>
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-lg-5">รูปแบบการจัดส่ง</label>
                  <div class="col-lg-7">
                  <div class="form-group has-feedback">
                  <input type="radio" name="shipping" value="50" required> <b>ลงทะเบียน / 50 ต่อชิ้น</b>
                  &nbsp;<input type="radio" name="shipping" value="80" required> <b>Ems / 80 ต่อชิ้น</b>
                  </div>
                  </div>
                  </div>

                  </div>
                  </div>
                  
          </td>
          </tr>

          <tr>
          <td colspan="12">
            <div class="text-right"><button type="submit" class="btn btn-primary btn-grad btn-xl" onClick="return confirm ('ยืนยันการสั่งซื้อ');">ยืนยันการสั่งซื้อ</button>&nbsp;<button type="button" class="btn btn-danger btn-grad" onClick="window.location='?data=cancel';">ยกเลิกรายการทั้งหมด</button></div>

          </td>
          </tr>

                                            </tbody>
                                        </table>

                                        </form>

                                        
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