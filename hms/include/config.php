<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Enable MySQLi error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection settings
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "hms";

// Connect to the database
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check the connection
if (!$bd) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to UTF-8
mysqli_set_charset($bd, "utf8mb4");


?>

