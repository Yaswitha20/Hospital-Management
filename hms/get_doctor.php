<?php
include('include/config.php');

// Check if 'specilizationid' is set in POST request
if (!empty($_POST["specilizationid"])) {
    // Prepare and execute query to fetch doctors by specialization
    $specilizationid = $_POST['specilizationid'];
    $query = mysqli_prepare($bd, "SELECT doctorName, id FROM doctors WHERE specilization = ?");
    mysqli_stmt_bind_param($query, "s", $specilizationid);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    // Output the results
    echo '<option selected="selected">Select Doctor</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . htmlentities($row['id']) . '">' . htmlentities($row['doctorName']) . '</option>';
    }

    // Close the statement
    mysqli_stmt_close($query);
}

// Check if 'doctor' is set in POST request
if (!empty($_POST["doctor"])) {
    // Prepare and execute query to fetch doctor's fees by id
    $doctorid = $_POST['doctor'];
    $query = mysqli_prepare($bd, "SELECT docFees FROM doctors WHERE id = ?");
    mysqli_stmt_bind_param($query, "i", $doctorid);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    // Output the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . htmlentities($row['docFees']) . '">' . htmlentities($row['docFees']) . '</option>';
    }

    // Close the statement
    mysqli_stmt_close($query);
}
?>
