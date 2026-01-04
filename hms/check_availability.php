<?php
require_once("include/config.php");

if (!empty($_POST["email"])) {
    $email = $_POST["email"];
    
    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($bd, "SELECT email FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);

    if ($count > 0) {
        // Email already exists
        echo "<span style='color:red'>Email already exists.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        // Email available for registration
        echo "<span style='color:green'>Email available for registration.</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }

    mysqli_stmt_close($stmt);
}
?>
