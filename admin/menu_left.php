 <?php
if($_REQUEST['logout']=='chk'){

    //ออกจากระบบ
    Logout($_SESSION['ses_admin_id'],'../index.php');
}
?>

 <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">

                            <div class="user-info">
                                <div><strong>Welcome : </strong><font color="white"><?php echo $_SESSION['ses_admin_user'];?></font></div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    
                    <li class="selected">
                        <a href=""><i class="fa fa-dashboard fa-fw"></i>เมนูหลัก</a>
                    </li>
					
					<li>
					<a href="#"><i class="fa fa-edit fa-fw"></i> จัดการข้อมูลทั่วไป<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						<li>
                                <a href="edit_admin.php">- แก้ไขข้อมูลส่วนตัว</a>
                            </li>
                            <li>
                                <a href="manage_admin.php">- ข้อมูลผู้ดูแลระบบ</a>
                            </li>
							<li>
                                <a href="manage_member.php">- ข้อมูลสมาชิก</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li>
                    <a href="#"><i class="fa fa-save fa-fw"></i> จัดการข้อมูลสินค้า<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                       
                            <li>
                                <a href="manage_product.php"> - ข้อมูลสินค้า</a>
                            </li>
                           
                        </ul>
                    </li>
                  
                    <li>
                    <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> จัดการ Orders<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        
                            <li>
                                <a href="manage_order.php"> - ข้อมูลการสั่งซื้อ</a>
                            </li>
                            <li>
                                <a href="manage_payment.php"> - ข้อมูลการชำระเงิน</a>
                            </li>
                            
                        </ul>
                    </li>

					
                    <li>
                        <a href="?logout=chk"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                    </li>


                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->