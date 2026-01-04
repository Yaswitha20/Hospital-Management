<?php
session_start();
include('include/config.php');

// Properly unset the login session
$_SESSION['login'] = "";

// Set timezone
date_default_timezone_set('Asia/Kolkata');
$ldate = date('d-m-Y h:i:s A', time());

// Use mysqli_query instead of mysql_query
mysqli_query($bd, "UPDATE userlog SET logout = '$ldate' WHERE uid = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");

// Clear session
session_unset();
session_destroy();

$_SESSION['errmsg'] = "You have successfully logout";
?>
<script language="javascript">
document.location = "./user-login.php";
</script>
