<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_GET['cancel']) && isset($_GET['id'])) {
    $appointment_id = intval($_GET['id']); // Sanitize input

    $stmt = mysqli_prepare($bd, "UPDATE appointment SET doctorStatus = 0 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $appointment_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['msg'] = "Appointment canceled!";
    } else {
        $_SESSION['msg'] = "Failed to cancel appointment. Please try again.";
    }

    mysqli_stmt_close($stmt);
    header("Location: appointment-history.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor | Appointment History</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Doctor | Appointment History</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Doctor</span></li>
                            <li class="active"><span>Appointment History</span></li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (!empty($_SESSION['msg'])): ?>
                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?></p>
                                <?php $_SESSION['msg'] = ""; ?>
                            <?php endif; ?>
                            <table class="table table-hover" id="appointmentTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Specialization</th>
                                        <th>Consultancy Fee</th>
                                        <th>Appointment Date / Time</th>
                                        <th>Created On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$query = "SELECT users.fullName AS fname, appointment.* 
          FROM appointment 
          JOIN users ON users.id = appointment.userId 
          WHERE appointment.doctorId = ?";
$stmt = mysqli_prepare($bd, $query);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$cnt = 1;
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?php echo $cnt; ?>.</td>
    <td><?php echo htmlentities($row['fname']); ?></td>
    <td><?php echo htmlentities($row['doctorSpecialization']); ?></td>
    <td><?php echo htmlentities($row['consultancyFees']); ?></td>
    <td><?php echo htmlentities($row['appointmentDate'] . ' / ' . $row['appointmentTime']); ?></td>
    <td><?php echo htmlentities($row['postingDate']); ?></td>
    <td>
        <?php
        if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1)
            echo "Active";
        else if ($row['userStatus'] == 0 && $row['doctorStatus'] == 1)
            echo "Canceled by Patient";
        else if ($row['userStatus'] == 1 && $row['doctorStatus'] == 0)
            echo "Canceled by You";
        ?>
    </td>
    <td>
        <?php if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1) { ?>
            <a href="appointment-history.php?id=<?php echo $row['id']; ?>&cancel=1" onClick="return confirm('Are you sure you want to cancel this appointment?')" class="btn btn-danger btn-xs">Cancel</a>
        <?php } else {
            echo "Canceled";
        } ?>
    </td>
</tr>
<?php $cnt++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/footer.php'); ?>
    <?php include('include/setting.php'); ?>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
