<?php
session_start(); 
require_once "conn.php"; 
require_once "function.php"; 
?>

<!doctype html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $title_web;?></title>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> 

<link href="css/owl.carousel.css" rel="stylesheet">

<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>

<!-- ckeditor-->
<script src="plugins/ckeditor/ckeditor.js"></script>

<!-- icon web -->
<link rel="shortcut icon" href="images/shortcut_icon/logo.png">


<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- requried-jsfiles-for owl -->
<script>
$(document).ready(function() {
$("#owl-demo").owlCarousel({
items : 5,
lazyLoad : true,
autoPlay : true,
navigation : true,
navigationText :  true,
pagination : false,
});
});
</script>
<!-- //requried-jsfiles-for owl -->
  
</head>

<body>

<?php
//add to cart
if($_REQUEST['data']=='cart'){

if($_SESSION['ses_user_id']){
  Add_Cart($_REQUEST['pro_id']);
}
else {

  Alert('กรุณาเข้าสู่ระบบก่อน!','login.php');
}
}


//ตรวจสอบการออกจากระบบ
if($_REQUEST['logout']=='chk'){
Logout($_SESSION['ses_user_id'],'index.php');
}
?>

<!--header-->
  <div class="line">
  
  </div>
  <div class="header">
    <div class="logo">
      <h1><b>Y</b>eti Shop</h1>
    </div>
    <div  class="header-top">
      <div class="header-grid">
        <ul class="header-in">
            <?php if($_SESSION['ses_user_id']){?>
            <li class="text-info" style="font-size:18px;">Welcome: <b><?php echo $_SESSION['ses_user_user'];?></b></li>
            <li class="small"><a href="edit_profile.php" class="text-danger">แก้ไขข้อมูลส่วนตัว</a></li>
            <li class="small"><a href="history_order.php" class="text-danger">ประวัติการสั่งซื้อ</a></li>
            <li class="small"><a href="?logout=chk" class="text-danger">ออกจากระบบ</a></li>
            </ul> 
            <?php } ?>
          </ul>
          <div class="search-box">
              <div id="sb-search" class="sb-search">
              <form action="search_product.php" method="get">
                <input class="sb-search-input" placeholder="ค้นหาข้อมูลสินค้า..." required type="search" name="txt_search" id="search" required>
                <input class="sb-search-submit" type="submit" value="">
                <span class="sb-icon-search"> </span>
              </form>
            </div>
            </div>
          <!-- search-scripts -->
          <script src="js/classie.js"></script>
          <script src="js/uisearch.js"></script>
            <script>
              new UISearch( document.getElementById( 'sb-search' ) );
            </script>
          <!-- //search-scripts -->
          <div class="online">
          <a href="cart.php" >สินค้าในตะกร้า: <?php Total_Cart();?></a>
          </div>
          <div class="clearfix"> </div>
      </div>
      <div class="header-bottom">
        <div class="h_menu4"><!-- start h_menu4 -->
        <a class="toggleMenu" href="#">Menu</a>
        <ul class="nav">
          <li class="active"><a href="index.php">หน้าแรก</a></li>
          <?php if(!$_SESSION['ses_user_id']){?><li><a href="register.php">สมัครสมาชิก</a></li><?php } ?>
          <?php if(!$_SESSION['ses_user_id']){?><li><a href="login.php">เข้าสู่ระบบ</a></li><?php } ?>   
          <li><a href="#">วิธีการ <i> </i></a>
            <ul>
              <li><a href="howto_buy.php">วิธีการสั่งซื้อ</a></li>
              <li><a href="howto_pay.php">วิธีการชำระเงิน</a></li>
            </ul>
          </li> 
          <li><a href="all_product.php">สินค้าทั้งหมด</a></li>
          <li><a href="contact.php">ติดต่อเรา</a></li>
        </ul>
        <script type="text/javascript" src="js/nav.js"></script>
      </div><!-- end h_menu4 -->
      <div class="clearfix"> </div>
    </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <!---->
  <div class="banner">
  <div class="container">
    <div class="banner-matter">
    </div>  
    </div>
  </div>
<!---->
<div class="content">
  <div class="sport-your">


    <!-- start content_slider -->
    <div class="line1">
  
    </div>
    <div id="example1">
    <div id="owl-demo" class="owl-carousel text-center">
    <?php $sql = $conn->query("select * from product order by Pro_ID asc");
            while ($show = $sql->fetch_assoc()){
              ?>
      
      <div class="thumbnail">
        <a href="view_product.php?id=<?php echo $show['Pro_ID'];?>" title="image" rel="title1">
          <img class="img-responsive" width="200px" height="200px" src="images/product/<?php echo $show['Pro_Img'];?>" alt="">
        <div class="run">
          <p><?php echo iconv_substr($show['Pro_Name'],0,20,'UTF-8').'...';?></p>
                <label  class="add-to">
                <?php echo number_format($show['Pro_Price'],0);?> บาท
                </label>

        </div>
        </a>
        
      </div>

      <?php } Chk_Row($sql);?>
      
    </div>
    </div>
    <h6 class="your-in">รายการสินค้า</h6>
    <div class="line2"></div>
  </div>

<!-- end content_slider -->