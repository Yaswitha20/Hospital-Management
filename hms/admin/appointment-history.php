<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

// Cancel appointment logic
if (isset($_GET['id']) && isset($_GET['cancel']) && $_GET['cancel'] == "update") {
    $id = intval($_GET['id']);
    $query = "UPDATE appointment SET userStatus='0' WHERE id=?";
    $stmt = mysqli_prepare($bd, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $_SESSION['msg'] = "Appointment canceled !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patients | Appointment History</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="vendor/switchery/switchery.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
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
                            <h1 class="mainTitle">Patients | Appointment History</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Patients</span></li>
                            <li class="active"><span>Appointment History</span></li>
                        </ol>
                    </div>
                </section>

                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color:red;">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php $_SESSION['msg'] = ""; ?>
                            </p>
                            <table class="table table-hover" id="sample-table-1">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="hidden-xs">Doctor Name</th>
                                    <th>Patient Name</th>
                                    <th>Specialization</th>
                                    <th>Consultancy Fee</th>
                                    <th>Appointment Date / Time</th>
                                    <th>Appointment Creation Date</th>
                                    <th>Current Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT doctors.doctorName as docname, users.fullName as pname, appointment.*  
                                          FROM appointment 
                                          JOIN doctors ON doctors.id = appointment.doctorId 
                                          JOIN users ON users.id = appointment.userId";
                                $sql = mysqli_query($bd, $query);
                                $cnt = 1;
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $cnt; ?>.</td>
                                        <td class="hidden-xs"><?php echo htmlentities($row['docname']); ?></td>
                                        <td><?php echo htmlentities($row['pname']); ?></td>
                                        <td><?php echo htmlentities($row['doctorSpecialization']); ?></td>
                                        <td><?php echo htmlentities($row['consultancyFees']); ?></td>
                                        <td><?php echo htmlentities($row['appointmentDate']) . ' / ' . htmlentities($row['appointmentTime']); ?></td>
                                        <td><?php echo htmlentities($row['postingDate']); ?></td>
                                        <td>
                                            <?php
                                            if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1) echo "Active";
                                            elseif ($row['userStatus'] == 0 && $row['doctorStatus'] == 1) echo "Cancelled by Patient";
                                            elseif ($row['userStatus'] == 1 && $row['doctorStatus'] == 0) echo "Cancelled by Doctor";
                                            else echo "Cancelled";
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1) { ?>
                                                <a href="appointment-history.php?id=<?php echo $row['id']; ?>&cancel=update"
                                                   onClick="return confirm('Are you sure you want to cancel this appointment?')"
                                                   class="btn btn-transparent btn-xs tooltips"
                                                   title="Cancel Appointment">Cancel</a>
                                            <?php } else {
                                                echo "Canceled";
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php $cnt++;
                                } ?>
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

<!-- JS Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/modernizr/modernizr.js"></script>
<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>
<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="vendor/autosize/autosize.min.js"></script>
<script src="vendor/selectFx/classie.js"></script>
<script src="vendor/selectFx/selectFx.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/form-elements.js"></script>
<script>
    jQuery(document).ready(function () {
        Main.init();
        FormElements.init();
    });
</script>
</body>
</html>
