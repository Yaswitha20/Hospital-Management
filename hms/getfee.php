<?php
// Database connection details
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "hms";

// Create a connection using mysqli
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check the connection
if (!$bd) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'action' is set to 'doctorid'
if (isset($_GET['action']) && $_GET['action'] == 'doctorid') {
    // Sanitize the input to avoid SQL injection
    $docinfo = mysqli_real_escape_string($bd, $_POST['docinfo']);

    // Prepare the query using a prepared statement to prevent SQL injection
    $query = mysqli_prepare($bd, "SELECT * FROM doctors WHERE doctorName = ?");
    mysqli_stmt_bind_param($query, "s", $docinfo); // 's' denotes a string parameter

    // Execute the query
    mysqli_stmt_execute($query);

    // Get the result
    $result = mysqli_stmt_get_result($query);

    // Fetch the data and display the doctor fees
    if ($array = mysqli_fetch_array($result)) {
        echo $array['docFees'];
    } else {
        echo "No doctor found with that name.";
    }

    // Close the prepared statement
    mysqli_stmt_close($query);
}

// Close the database connection
mysqli_close($bd);
?>
