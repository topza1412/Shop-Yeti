<?php require_once "header.php";?>

<?php
//บันทึกข้อมูลชำระเงิน
if($_REQUEST['data']=='payment'){

$file = strrchr($_FILES['file']['name'], "."); //ตัดนามสกุลไฟล์เก็บไว้
$filename = (Date("dmy_His").$file); //ตั้งเป็น วันที่_เวลา.นามสกุล
$folder = "images/payment/"; // path folder
$width = 0;// ความกว้างของภาพ
$height = 0;// ความยาวของภาพ

Upload_File ($filename,$folder,$width,$height); 

$sql = $conn->query("insert payment set Ord_ID = '$_REQUEST[Ord_ID]' , Pay_Name = '$_REQUEST[name]',Pay_Tel = '$_REQUEST[tel]', Pay_File = '$filename', Pay_Price = '$_REQUEST[priceoln]', 
Pay_Bank = '$_REQUEST[bank]', Pay_Detail = '$_REQUEST[detail]', Pay_Date = '$_REQUEST[date]', Pay_Time = '$_REQUEST[time]'");

Chk_Insert($sql,'รอตรวจสอบชำระเงิน','history_order.php');

}
?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

	<h2 class="alert bg-primary">แจ้งชำระเงิน</h2>
	

	<div class="col-md-4 col-md-offset-4 content-grid">
		<form name="form1" method="post" action="?data=payment" onsubmit="return chk_error();" enctype="multipart/form-data">

       <?php  
       $sql2 = $conn->query("select * from orders o,member m where o.Mem_ID = m.Mem_ID && o.Ord_ID = '$_REQUEST[id]'");
       $show2 = $sql2->fetch_assoc();
       ?>
     <input type="hidden" name="Ord_ID" value="<?php echo $show2['Ord_ID'];?>">

      <div class="form-group col-md-12">
            <h3>Order Number:</h3>
            <input name="order" type="text" class="form-control" readonly value="<?php echo $show2['Ord_Number'];?>">
          </div>

          <div class="form-group col-md-12">
            <h3>ชื่อผู้ชำระเงิน:</h3>
            <input name="name" type="text" class="form-control" required value="<?php echo $show2[Mem_Name];?>">
          </div>

          <div class="form-group col-md-12">
            <h3>จำนวนเงินที่ต้องชำระ:</h3>
            <input name="price" type="text" class="form-control" disabled value="<?php echo $show2[Ord_PriceTotal];?>">
          </div>

          <div class="form-group col-md-12">
            <h3>หลักฐานการโอน:</h3>
            <input name="file" type="file" class="file" required>
          </div>

          <div class="form-group col-md-12">
            <h3>เบอร์ติดต่อ:</h3>
            <input name="tel" type="text" class="form-control" required onKeyPress="CheckNumber()" value="<?php echo $show2[Mem_Tel];?>">
          </div>

          <div class="form-group col-md-12">
            <h3>จำนวนเงินที่โอน:</h3>
            <input name="priceoln" type="text" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <h3>โอนเข้าธนาคาร:</h3>
            <select name="bank" class="form-control">
      <option value="ไทยพาณิชย์">ไทยพาณิชย์ (xxx)</option>
      <option value="กรุงเทพ">กรุงเทพ (xxx)</option>
      <option value="กสิกร">กสิกร (xxx)</option>
      <option value="กรุงไทย">กรุงไทย (xxx)</option>
      </select>
          </div>

          <div class="form-group col-md-12">
            <h3>วันที๋โอน:</h3>
            <input name="date" type="date" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <h3>เวลาที่โอน:</h3>
            <input name="time" type="time" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <h3>ข้อมูลเพิ่มเติม:</h3>
            <textarea name="detail" class="form-control" rows="5" ></textarea>
          </div>

      <div class="clear"></div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-grad">ยืนยันชำระเงิน</button>
        <button type="button" class="btn btn-danger btn-grad" data-dismiss="modal">ยกเลิก</button>
      </div>
        </form>

		</div>

		<div class="clearfix"> </div>

	</div>

	<div class="clearfix"> </div>
	</div>
	<!---->
<script type="text/javascript">
  
  function chk_error(){

    if(document.form1.priceoln.value != document.form1.price.value){

      alert('ยอดเงินชำระไม่ถูกต้อง!');
      return false;
    }
  }

</script>

<?php require_once "footer.php";?>


</body>
</html>