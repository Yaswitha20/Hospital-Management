
<?php
// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to check login status
function check_login() {
    // Redirect if the user is not logged in
    if (empty($_SESSION['login'])) {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "user-login.php"; // Removed leading "./" for better path compatibility
        header("Location: http://$host$uri/$extra");
        exit(); // Stop further execution
    }
}
?>
