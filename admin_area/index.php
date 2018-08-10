<?php

session_start();

if (!isset($_SESSION['user_email'])) {
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{
	


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>OPTIMUM BEAUTY | ADMIN</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/table.css" />
	<link type="text/css" rel="stylesheet" href="css/email.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<?php include("inc/header.php") ?>

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">Manage Content<i class="fa fa-list"></i></span>
					<ul class="category-list">
						
						<li><a href="index.php?insert_product">Insert Product</a></li>
						<li><a href="index.php?view_products">View All Products</a></li>
						<li><a href="index.php?insert_cats">Insert New Category</a></li>
						<li><a href="index.php?view_cats">View All Categories</a></li>
						<li><a href="index.php?insert_sub_cat">Insert New Sub Categories</a></li>
						<li><a href="index.php?view_sub_cat">View All Sub Categories</a></li>
						<li><a href="index.php?insert_region">Insert New Region </a></li>
						<li><a href="index.php?view_regions">View All Regions</a></li>
						<li><a href="index.php?view_customers">View All Customers</a></li>
						<li><a href="index.php?view_orders">View Orders</a></li>
						<li><a href="index.php?email">Email</a></li>
						<li><a href="logout.php">Admin Logout</a></li>
						
					</ul>
				</div>
				<!-- /category nav -->

				
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Admin</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				

				<!-- MAIN -->
				<div id="main" class="col-md-12">
					
					<!-- /store top filter -->

					<!-- STORE -->
					<div id="store">
						<!-- row -->
						<div class="row"><br><br>
							<h2 style="color: #800080; text-align: center;"><?php  echo @$_GET['logged_in']; ?></h2>


							<?php

							  if (isset($_GET['insert_product'])) {
							  	include("insert_product.php");
							  }



							  if (isset($_GET['view_products'])) {
							  	include("view_products.php");
							  }

							  if (isset($_GET['edit_pro'])) {
							  	include("edit_pro.php");
							  }
							  if (isset($_GET['insert_cats'])) {
							  	include("insert_cat.php");
							  }
							  if (isset($_GET['view_cats'])) {
							  	include("view_cats.php");
							  }
							  if (isset($_GET['edit_cat'])) {
							  	include("edit_cat.php");
							  }
							  if (isset($_GET['insert_sub_cat'])) {
							  	include("insert_sub_cat.php");
							  }
							  if (isset($_GET['view_sub_cat'])) {
							  	include("view_sub_cat.php");
							  }
							  if (isset($_GET['edit_sub_cat'])) {
							  	include("edit_sub_cat.php");
							  }
							  if (isset($_GET['view_customers'])) {
							  	include("view_customers.php");
							  }
							   if (isset($_GET['view_orders'])) {
							  	include("view_orders.php");
							  }
							   
							   if (isset($_GET['email'])) {
							  	include("email.php");
							  }
							  




							?>
							


						</div>
						<!-- /row -->
					</div>
					<!-- /STORE -->

					
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php include("inc/footer1.php")  ?>

	<?php } ?>

	<?php
	include("inc/db.php");

if (isset($_GET['confirm_order'])) {
  
  $get_id = $_GET['confirm_order'];

  $status = 'Completed';

  $update_order = "update orders set status = '$status' where order_id = '$get_id'";

  $run_update = mysqli_query($con,$update_order);

  if($run_update){
    echo "<script>alert('Order was Updated')</script>";
    echo "<script>window.open('index.php?view_orders','_self')</script>";
  }


}
?>