<?php require_once "header.php";?>

		<!--//sreen-gallery-cursual---->
	<div class="content-grids">

	<h2 class="alert">Keyword: <?php echo $_REQUEST['txt_search'];?></h2>

  <hr>
	

	<div class="col-md-12 content-grid">
		<div class="row">
 <?php 
  //โค๊ดแบ่งหน้า
 $perpage = 12;
if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
            $start = ($page - 1) * $perpage;

 $sql = $conn->query("select * from product where Pro_Name like '%$_REQUEST[txt_search]%' or Pro_Price like '%$_REQUEST[txt_search]%' order by Pro_ID desc limit $start,$perpage");

 $sql2 = $conn->query("select * from product where Pro_Name like '%$_REQUEST[txt_search]%' or Pro_Price like '%$_REQUEST[txt_search]%' order by Pro_ID desc");
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);

       while ($show = $sql->fetch_assoc()){
              ?>

  
  <div class="col-sm-6 col-md-4 grid-product-in">
    <div class="thumbnail">
      <a href="view_product.php?id=<?php echo $show['Pro_ID'];?>" class="lot"><img class="img-responsive " src="images/product/<?php echo $show['Pro_Img'];?>" alt=""></a>
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
                <?php echo number_format($show['Pro_Price'],0);?>
                </label>
                <?php } ?>
        <p><button type="button" onclick="window.location='?data=cart&pro_id=<?php echo $show['Pro_ID'];?>'" class="btn btn-danger">Add to cart</button></p>
      </div>
    </div>
  </div>
	
	<?php }?>

  </div>
  
		</div>

		<div class="clearfix"> </div>

		<div align="center"><?php if($sql->num_rows==0){Chk_Row($sql);}else {?><nav>
 <ul class="pagination">
 <li>
 <a href="?page=1" aria-label="Previous">
 <span aria-hidden="true">&laquo;</span> </a> </li>
 <?php for($i=1;$i<=$total_page;$i++){ ?>
 <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 <?php } ?>
 <li>
 <a href="?page=<?php echo $total_page;?>" aria-label="Next">
 <span aria-hidden="true">&raquo;</span> </a> </li>
 </ul>
 </nav><?php } ?></div>

	</div>

	<div class="clearfix"> </div>
	</div>
	<!---->

<?php require_once "footer.php";?>

</body>
</html>