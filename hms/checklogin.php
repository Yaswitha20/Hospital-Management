<?php
function check_login()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['login'])) {
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "admin.php";  // Adjust if needed
        $_SESSION["login"] = "";
        header("Location: http://$host$uri/$extra");
        exit(); // Always call exit() after header redirects
    }
}
?>
