<?php 
require_once("include/config.php");

// Create a connection using mysqli
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check if the connection was successful
if (!$bd) {
    die("Could not connect to the database: " . mysqli_connect_error());
}

if(!empty($_POST["email"])) {
    $email = mysqli_real_escape_string($bd, $_POST["email"]);
    
    // Query to check if the email already exists in the database
    $result = mysqli_query($bd, "SELECT email FROM users WHERE email='$email'");
    $count = mysqli_num_rows($result);

    // Return the count for debugging or verification
    echo $count;
    
    if($count > 0) {
        echo "<span style='color:red'> Email already exists .</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> Email available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}

// Close the connection
mysqli_close($bd);
?>

