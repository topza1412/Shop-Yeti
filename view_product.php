<?php require_once "header.php";?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

<?php 
$sql = $conn->query("select * from product where Pro_ID = '$_REQUEST[id]'");
$show = $sql->fetch_assoc();

?>	

	<h2 class="alert alert-danger"><?php echo $show['Pro_Name'];?></h2>

  <hr>

  	<!---->	
	<div class="container">
<div class="single">
				<div class="col-md-12 top-in-single">
					<div class="col-md-5 single-top">	
						
									<img class="etalage_thumb_image img-responsive" src="images/product/<?php echo $show['Pro_Img'];?>" alt="" >
							
					</div>	
					<div class="col-md-7 single-top-in">
						<div class="single-para">
							<h5><b>รหัสสินค้า: <?php echo $show['Pro_ID'];?></b></h5>
							<h4>ชื่อสินค้า: <?php echo $show['Pro_Name'];?></h4>
							รายละเอียด:
							<p><?php echo $show['Pro_Detail'];?></p>

								<label  class="add-to">ราคา: <?php echo number_format($show['Pro_Price'],0);?> บาท</label>
								
								<h4>จำนวนสั่งซื้อ: <?php echo $show['Pro_Buy'];?></h4>
								
								<a href="?data=cart&pro_id=<?php echo $_REQUEST['id'];?>" class="cart">Add to cart</a>
							
						</div>
					</div>
				<div class="clearfix"> </div>
				<div class="product-top">
<?php 
$sql = $conn->query("select * from product order by Pro_ID desc limit 0,6");
while($show = $sql->fetch_assoc()){
?>

		<div class="col-md-3 grid-product-in">	
		<div class=" product-grid" align="center">	
			<a href="view_product.php?id=<?php echo $show['Pro_ID'];?>"><img class="img-responsive" width="250" height="250" src="images/product/<?php echo $show['Pro_Img'];?>" alt=""></a>		
			<div class="shoe-in">
				<h6><a href="view_product.php?pro_id=<?php echo $show['Pro_ID'];?>"><?php echo $show['Pro_Name'];?></a></h6>
				<label><?php echo $show['Pro_Price'];?></label>
				<button type="button" onclick="window.location='?data=cart&pro_id=<?php echo $show['Pro_ID'];?>'" class="btn btn-danger">Add to cart</button>
			</div>
			
			<b class="plus-on">+</b>
		</div>	
		</div>

		<?php } Chk_Row($sql);?>
		
	<div class="clearfix"> </div>
	</div>
				</div>
				
				</div>
				<div class="clearfix"> </div>		
		</div>
	</div>

	</div>

	</div>
	<!---->

<?php require_once "footer.php";?>

</body>
</html>