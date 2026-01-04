<?php
session_start();
// error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

date_default_timezone_set('Asia/Kolkata'); // Set your timezone
$currentTime = date('d-m-Y h:i:s A', time());

if (isset($_POST['submit'])) {
    // Encrypt the old password using md5
    $cpass = md5($_POST['cpass']);

    // Check if the current password is correct
    $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE password = ? AND email = ?");
    mysqli_stmt_bind_param($stmt, 'ss', $cpass, $_SESSION['login']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num = mysqli_stmt_num_rows($stmt);

    if ($num > 0) {
        // If matched, update password
        $newpass = md5($_POST['npass']);
        $stmt2 = mysqli_prepare($conn, "UPDATE users SET password = ?, updationDate = ? WHERE email = ?");
        mysqli_stmt_bind_param($stmt2, 'sss', $newpass, $currentTime, $_SESSION['login']);
        if (mysqli_stmt_execute($stmt2)) {
            $_SESSION['msg1'] = "Password Changed Successfully !!";
        } else {
            $_SESSION['msg1'] = "Error updating password. Please try again.";
        }
        mysqli_stmt_close($stmt2);
    } else {
        $_SESSION['msg1'] = "Old Password not match !!";
    }
    mysqli_stmt_close($stmt);
}
?>
