<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "hms";

// Create connection
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if (!$bd) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
