<?php
session_start();
require_once 'connect.php';

if (isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}

$errors = [];
$email = "";

if (isset($_POST['btn_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "") { $errors['email'] = "Vui long nhap email."; }
    if ($password == "") { $errors['password'] = "Vui long nhap password."; }

    if (count($errors) == 0) {
        $hashed_password = md5($password);
        
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$hashed_password'";
        $result = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            
            header("Location: account.php");
            exit();
        } else {
            $errors['login'] = "Email hoac mat khau khong dung.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
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
        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="index.php"><img src="images/home/logo.png" alt="Logo" /></a>
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    // Da login: Hien thi menu Account va Logout
                                ?>
                                    <li><a href="account.php"><i class="fa fa-user"></i> Account (Xin chao <?php echo $_SESSION['user_name']; ?>)</a></li>
                                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                                <?php
                                } else {
                                    // Chua login: Hien thi menu Login va Register
                                ?>
                                    <li><a href="login.php" class="active"><i class="fa fa-lock"></i> Login</a></li>
                                    <li><a href="register.php"><i class="fa fa-user"></i> Register</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <section id="form" style="margin-top: 20px; margin-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="login-form">
                        <h2>Login to your account</h2>
                        
                        <?php if (isset($errors['login'])) echo '<span class="error-msg">'.$errors['login'].'</span>'; ?>

                        <form action="" method="POST">
                            <input type="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" />
                            <?php
                             if (isset($errors['email'])) echo '<span class="error-msg">'.$errors['email'].'</span>';
                              ?>

                            <input type="password" name="password" placeholder="Password" />
                            <?php
                             if (isset($errors['password'])) echo '<span class="error-msg">'.$errors['password'].'</span>'; 
                             ?>

                            <button type="submit" name="btn_login" class="btn btn-default" style="margin-top: 10px;">Login</button>
                        </form>
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
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>