<?php
session_start();
require_once 'connect.php';

$errors = [];
$name = $email = $password = "";

if (isset($_POST['btn_register'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $file_name = $_FILES['avatar']['name'];
    $file_tmp  = $_FILES['avatar']['tmp_name'];
    $file_size = $_FILES['avatar']['size'];
    $file_type = $_FILES['avatar']['type'];
    
    // YEU CAU: show ra loi ben duoi moi input neu input nao chua nhap
    if ($name == "") { $errors['name'] = "Vui long nhap ten."; }
    if ($email == "") { $errors['email'] = "Vui long nhap email."; }
    if ($password == "") { $errors['password'] = "Vui long nhap password."; }
    
    if ($file_name == "") {
        $errors['avatar'] = "Vui long chon anh dai dien.";
    } else {
        // avatar chi cho phep upload kieu hinh anh va dung luong < 1mb
        if ($file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/gif') {
            if ($file_size > 1048576) {
                $errors['avatar'] = "Dung luong file phai nho hon 1MB.";
            } else {
                $avatar_name = time() . '_' . $file_name;
            }
        } else {
            $errors['avatar'] = "Chi cho phep upload file hinh anh (jpg, png, gif).";
        }
    }

    if (count($errors) == 0) {     
        // ma hoa du lieu
        $hashed_password = md5($password);  
        
        $target_file = "uploads/" . $avatar_name;
        move_uploaded_file($file_tmp, $target_file);
            
        $sql = "INSERT INTO user (email, password, name, avatar) VALUES ('$email', '$hashed_password', '$name', '$avatar_name')";
        
        if (mysqli_query($con, $sql)) {
            $thong_bao = "Dang ky thanh cong!";
            $name = $email = "";
        } else {
            $errors['db'] = "Co loi xay ra khi luu database.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">     
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <style>
        .error-msg { 
            color: red; 
            margin-bottom: 10px; 
            display: block; 
        }
    </style>
</head>

<body>
	<header id="header">
		<div class="header_top">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-user"></i> Account</a></li>
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="header-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.php">Login</a></li> 
                                    </ul>
                                </li> 
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<section id="form">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="signup-form">
						<h2>New User Sign Up!</h2>
						<span class="error-msg">
                            
							<?php if (isset($errors['db'])) echo $errors['db']; ?>
							<?php if ($thong_bao != "") echo '<span style="color:green;">' . $thong_bao . '</span>'; ?>
						</span>
	
						<form action="" method="POST" enctype="multipart/form-data">
                            
							<input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"/>
							<?php 
							if (isset($errors['name'])) echo '<span class="error-msg">'.$errors['name'].'</span>'; 
							?>

							<input type="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>"/>
							<?php
							 if (isset($errors['email'])) echo '<span class="error-msg">'.$errors['email'].'</span>'; 
							?>
							
							<input type="password" name="password" placeholder="Password"/>
							<?php 
							if (isset($errors['password'])) echo '<span class="error-msg">'.$errors['password'].'</span>'; 
							?>
							
							<input type="file" name="avatar" style="margin-bottom: 10px;"/>
							<?php
							 if (isset($errors['avatar'])) echo '<span class="error-msg">'.$errors['avatar'].'</span>'; 
							 ?>
							
							<button type="submit" name="btn_submit" class="btn btn-default">Sign Up</button>
						</form>
						<p style="margin-top: 15px;">Already have an account? <a href="login.php">Login here</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer">
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright  2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
	</footer>

    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>