<?php
session_start ();
//เรียกใช้ไฟล์ connect db
require_once "conn.php"; 
require_once "function.php"; 

$sql = $conn->query("select * from orders o,member m where o.Mem_ID = m.Mem_ID && o.Ord_ID = '$_REQUEST[id]'");
$i = 1;
$show = $sql->fetch_assoc();

if($show['Ord_Status']==0){$status =  '<span class=text-warning>ยังไม่ชำระเงิน</span>';}
else if($show['Ord_Status']==1){$status =  '<span class=text-info>ตรวจสอบชำระเงิน</span>';}
else if($show['Ord_Status']==2){$status =  '<span class=text-success>ชำระเงินเรียบร้อย</span>';}
else if($show['Ord_Status']==3){$status =  '<span class=text-primary>จัดส่งเรียบร้อย</span>';}
else if($show['Ord_Status']==4){$status =  '<span class=text-danger>ยกเลิกรายการ</span>';}
?>

<!DOCTYPE HTML>
<head>
<title><?php echo $title_web;?></title>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="<?php echo $author;?>" >
  <meta name="description" content="<?php echo $description;?>" >
  <meta name="keywords" content="<?php echo $keywords;?>" >
  <meta name="robots" content="<?php echo $robots;?>">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<!--theme-style-->


</head>
<body>
<div style="padding:30px;">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header text-center">
          <?php echo $title_web;?>
          <p class="text-info"><b>ใบสั่งซื้อสินค้า</b></p>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <strong>ข้อมูลลูกค้า</strong>
        <address>
          <?php echo $show['Mem_Name'];?><br>
          Phone: <?php echo $show['Mem_Tel'];?><br>
          Email: <?php echo $show['Mem_Email'];?><br>
          ที่อยู่: <?php echo $show['Mem_Address'];?><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-5 invoice-col">
        <strong>ข้อมูลติดต่อร้าน</strong>
        <address>
          <strong class="text-primary"><?php echo $title_web;?></strong><br>
        </address>
      </div>
      <!-- /.col -->

      <div class="col-sm-3">
      <b>Date Order:</b> <?php echo cover_date($show['Ord_DateBuy']);?>
      <br>
        <b>Number Order:</b> <b class="text-danger"><?php echo $show['Ord_Number'];?></b>
        <br>
        <b>สถานะ Order:</b><b class="text-primary"><?php echo $status;?></b>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
          <tr class="bg-primary">
            <th width="5%" align="center">No.</th>
            <th width="30%" align="center">สินค้า</th>
            <th width="15%" align="center">ยี่ห้อสินค้า</th>
            <th width="10%" align="center">จำนวน</th>
            <th width="10%" align="center">ราคาต่อ/หน่วย</th>
            <th width="20%" align="center">ราคารวม</th>
          </tr>
          </thead>
          <tbody> 
<?php 
$sql2 = $conn->query("select * from order_detail o , product p where o.Pro_ID = p.Pro_ID && o.Ord_ID = '$_REQUEST[id]'");
while ($show2 = $sql2->fetch_assoc()){

if($show['Ord_Shipping']==50){

  $shipping = 'ลงทะเบียน';
}
else {

  $shipping = 'EMS';
}

$total_price = $show2['Odd_Amount'] * $show2['Pro_Price'];

//ราคารวมของสินค้ายังไม่หักส่วนลด
$total += $show2['Odd_Amount'] * $show2['Pro_Price'];

//ผลรวมส่วนลดทั้งหมด
$total_discount += $show2['Odd_Amount'] * $show2['Pro_Discount'];

//ผลรวมค่าจัดส่ง
$total_shipping += $show2['Odd_Amount'] * $show['Ord_Shipping']; 

//ผลรวมราคาทั้งหมด ลบ กับ ส่วนลด ทั้งหมด
$total_all = $total - $total_discount;
?>               
          <tr>
            <td align="center"><?php echo $i++;?></td>
            <td><?php echo $show2['Pro_Name'];?></td>
            <td><?php echo $show2['Bra_Name'];?></td>
            <td align="center"><?php echo $show2['Odd_Amount'];?></td>
            <td align="center"><?php echo $show2['Pro_Price'];?></td>
            <td align="center"><?php echo number_format($total_price,0);?></td>
          </tr>
          <?php } Chk_Row($sql2);?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- /.col -->
      <div class="col-12">

        <div class="table-responsive">
          <table class="table table-bordered">
          <tr class="text-primary">
              <th>ราคาสินค้าทั้งหมด:</th>
              <td><?php echo number_format($total,2);?></td>
              <td>บาท</td>
            </tr>
            <tr class="text-primary">
              <th>ค่าจัดส่ง: <span class="text-success">(<?php echo $shipping;?>)</span></th>
              <td class="text-success"><?php echo number_format($total_shipping,2);?></td>
              <td>บาท</td>
            </tr>
            <tr class="text-primary">
              <th>รวมค่าใช้จ่ายที่ต้องชำระทั้งหมด:</th>
              <td class="text-info"><?php echo number_format($total_all,2);?></td>
              <td>บาท</td>
            </tr>
            <tr class="text-success">
              <th>ข้อมูลการจัดส่ง:
              <br>
              <span class="text-danger small">ที่อยู่จัดส่ง: <?php echo $show['Ord_AddressSend'];?></span> 
              <br>
              <span class="text-info small">วันที่จัดส่ง: <?php if($show['Ord_DateShipping']==""){echo '-';}else {echo $show['Ord_DateShipping'];}?></span>
              <br>
              <span class="text-info small">เลขที่จัดส่ง: <a href="http://www.emstrackingthailand.com/" target="_blank"><?php if($show['Ord_NumberShipping']==""){echo '-';}else {echo $show['Ord_NumberShipping'];}?></a></span>
              </th>
            </tr>
          </table>
        </div>
<hr>
        <div class="clear"></div>

        <div align="center">
        <button class="btn btn-primary btd-grad" onClick="window.print();">Print</button>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
							 
</body>
</html>

