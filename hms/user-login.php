<?php
session_start();
error_reporting(0);
include("include/config.php"); // Make sure $bd is defined

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

	$stmt = mysqli_prepare($bd, "SELECT id, password FROM users WHERE email = ?");

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Password matched
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = $username;
            $_SESSION['id'] = $row['id'];
            $uip = $_SERVER['REMOTE_ADDR'];
            $status = 1;

            // Successful login log
            $log_stmt = mysqli_prepare($bd, "INSERT INTO userlog (uid, username, userip, status) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($log_stmt, "issi", $row['id'], $username, $uip, $status);
            mysqli_stmt_execute($log_stmt);

            header("Location: dashboard.php");
            exit();
        } else {
            // Password incorrect
            $status = 0;
            $uip = $_SERVER['REMOTE_ADDR'];
            $_SESSION['login'] = $username;
            $_SESSION['errmsg'] = "Invalid username or password";

            $log_stmt = mysqli_prepare($bd, "INSERT INTO userlog (username, userip, status) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($log_stmt, "ssi", $username, $uip, $status);
            mysqli_stmt_execute($log_stmt);

            header("Location: user-login.php");
            exit();
        }
    } else {
        // User not found
        $status = 0;
        $uip = $_SERVER['REMOTE_ADDR'];
        $_SESSION['login'] = $username;
        $_SESSION['errmsg'] = "Invalid username or password";

        $log_stmt = mysqli_prepare($bd, "INSERT INTO userlog (username, userip, status) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($log_stmt, "ssi", $username, $uip, $status);
        mysqli_stmt_execute($log_stmt);

        header("Location: user-login.php");
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User-Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
					<h2> HMS | Patient Login</h2>
				</div>

				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>
								Sign in to your account
							</legend>
							<p>
								Please enter your name and password to log in.<br />
								<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Username">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i>
									 </span>
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
								Don't have an account yet?
								<a href="registration.php">
									Create an account
								</a>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HMS</span>. <span>All rights reserved</span>
					</div>
			
				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>