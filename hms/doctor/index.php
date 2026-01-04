<?php
session_start();
include("include/config.php");

// Enable MySQLi error reporting for development (disable in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Secure query
    $sql = "SELECT id, password FROM doctors WHERE docEmail = ?";
    $stmt = mysqli_prepare($bd, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['dlogin'] = $username;
        $_SESSION['id'] = $user['id'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;

        // Log successful login
        $log_sql = "INSERT INTO doctorslog(uid, username, userip, status) VALUES (?, ?, ?, ?)";
        $log_stmt = mysqli_prepare($bd, $log_sql);
        mysqli_stmt_bind_param($log_stmt, 'issi', $_SESSION['id'], $_SESSION['dlogin'], $uip, $status);
        mysqli_stmt_execute($log_stmt);

        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['dlogin'] = $username;
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;

        // Log failed login
        $log_sql = "INSERT INTO doctorslog(username, userip, status) VALUES (?, ?, ?)";
        $log_stmt = mysqli_prepare($bd, $log_sql);
        mysqli_stmt_bind_param($log_stmt, 'ssi', $_SESSION['dlogin'], $uip, $status);
        mysqli_stmt_execute($log_stmt);

        $_SESSION['errmsg'] = "Invalid username or password";
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/plugins.css" rel="stylesheet">
    <link href="assets/css/themes/theme-1.css" rel="stylesheet" id="skin_color">
</head>
<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <h2>HMS | Doctor Login</h2>
            </div>

            <div class="box-login">
                <form class="form-login" method="post" action="">
                    <fieldset>
                        <legend>Sign in to your account</legend>
                        <p>
                            Please enter your name and password to log in.<br />
                            <span style="color:red;">
                                <?php 
                                if (isset($_SESSION['errmsg'])) {
                                    echo htmlentities($_SESSION['errmsg']);
                                    $_SESSION['errmsg'] = "";
                                }
                                ?>
                            </span>
                        </p>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="username" placeholder="Email" required>
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="password" class="form-control password" name="password" placeholder="Password" required>
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right" name="submit">
                                Login <i class="fa fa-arrow-circle-right"></i>
                            </button>
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
            document.querySelector('.current-year').textContent = new Date().getFullYear();
        });
    </script>
</body>
</html>
