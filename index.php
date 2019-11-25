<?php require_once "header.php";

$ip = $_SERVER['REMOTE_ADDR'];
$conn->query("insert count_page set Cou_Date = now(),Cou_IP = '$ip'");
?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

	<h2 class="alert">สินค้ามาใหม่!</h2>

	 <?php $sql = $conn->query("select * from product order by Pro_ID desc limit 0,6");
            while ($show = $sql->fetch_assoc()){
              ?>

	  <div class="col-sm-6 col-md-4 grid-product-in">
    <div class="thumbnail">
      <a href="view_product.php?id=<?php echo $show['Pro_ID'];?>" class="lot"><img class="img-responsive" height="160px" width="180px" src="images/product/<?php echo $show['Pro_Img'];?>" alt=""></a>
      <div class="caption">
        <h3><a href="view_product.php?id=<?php echo $show['Pro_ID'];?>"><?php echo iconv_substr($show['Pro_Name'],0,10,'UTF-8').'...';?></a></h3>
        <?php if($show['Pro_Discount']!=""){?>
                <h4  class="text-success">
                <b><S><?php echo number_format($show['Pro_Price'],0);?></S></b>
                </h4>
                <label  class="add-to"><?php echo number_format($show['Pro_Price']-$show['Pro_Discount'],0);?> บาท</label>
                <label  class="text-info">
                ส่วนลด: <?php echo $show['Pro_Discount'];?>
                </label>
                <?php } else {?>
                <label  class="add-to">
                <?php echo number_format($show['Pro_Price'],0);?> บาท
                </label>
                จำนวนสั่งซื้อ: <?php echo $show['Pro_Buy'];?>
                <?php } ?>
        <p><button type="button" onclick="window.location='?data=cart&pro_id=<?php echo $show['Pro_ID'];?>'" class="btn btn-danger">Add to cart</button></p>
      </div>
    </div>
  </div>
	
	<?php } Chk_Row($sql);?>

	
	
	</div>
	<!---->

	<div class="clearfix"></div>

	<br>

<?php require_once "footer.php";?>

</body>
</html>