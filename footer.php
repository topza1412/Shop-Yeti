<!--footer-->
	<div class="footer">

		<div class="col-md-3 footer-left">
			<h4>สินค้า</h4>
			<div class="run-top">
				<ul class="run-grid">
				<?php $sql = $conn->query("select * from product order by Pro_ID desc limit 0,5");
				while ($show = $sql->fetch_assoc()){
				?>
					<li><a href="view_product.php?id=<?php echo $show['Pro_ID'];?>">- <?php echo $show['Pro_Name'];?></a></li>

					<?php } Chk_Row($sql);?>

				</ul>

			<div class="clearfix"> </div>
			</div>
		</div>
		<div class="col-md-5 footer-left left-footer">
			<h4>เกี่ยวกับเรา</h4>
			<div class="run-top top-run">
			<ul class="run-grid">
			<li><a href="index.php"><?php echo $title_web;?></a></li>
			</ul>
			<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="col-md-4 footer-left left-footer">
			<ul class="social-in">
				<li><a href="#"><i> </i></a></li>
				<li><a href="#"><i class="youtube"> </i></a></li>
				<li><a href="#"><i class="facebook"> </i></a></li>
				<li><a href="#"><i class="twitter"> </i></a></li>
			</ul>
			<div class="letter">
				<h5>ติดต่อเรา</h5>
				<p><?php echo $contact_web;?></p>
				<p class="footer-class"> © 2018 <?php echo $title;?> All Rights Reserved </p>
                <?php $sql = $conn->query("select * from count_page");
				$row = $sql->num_rows;
				?>
                <p>จำนวนผู้เข้าเว็บไซต์: <?php echo $row;?></p>
                <br>
                <a href="admin/index.php" class="text-success" target="_blank">สำหรับผู้ดูแลระบบ</a> 
			</div>
			
		</div>
		<div class="clearfix"> </div>
	</div>