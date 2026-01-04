<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $specilization = $_POST['Doctorspecialization'];
    $doctorid = $_POST['doctor'];
    $userid = $_SESSION['id'];
    $fees = $_POST['fees'];
    $appdate = $_POST['appdate'];
    $time = $_POST['apptime'];
    $userstatus = 1;
    $docstatus = 1;

    $query = "INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($bd, $query);
    mysqli_stmt_bind_param($stmt, 'siisssii', $specilization, $doctorid, $userid, $fees, $appdate, $time, $userstatus, $docstatus);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Your appointment has been successfully booked');</script>";
    } else {
        echo "<script>alert('There was an error booking your appointment. Please try again.');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Book Appointment</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Lato|Raleway|Crete+Round" rel="stylesheet" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <link href="vendor/select2/select2.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <script src="vendor/jquery/jquery.min.js"></script>
    <script>
        function getdoctor(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: { specilizationid: val },
                success: function (data) {
                    $("#doctor").html(data);
                }
            });
        }

        function getfee(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: { doctor: val },
                success: function (data) {
                    $("#fees").html(data);
                }
            });
        }
    </script>
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
                                <h1 class="mainTitle">User | Book Appointment</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>User</span></li>
                                <li class="active"><span>Book Appointment</span></li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Book Appointment</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="book" method="post">
                                                    <div class="form-group">
                                                        <label for="DoctorSpecialization">Doctor Specialization</label>
                                                        <select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required>
                                                            <option value="">Select Specialization</option>
                                                            <?php
                                                            $ret = mysqli_query($bd, "SELECT * FROM doctorspecilization");
                                                            while ($row = mysqli_fetch_array($ret)) {
                                                            ?>
                                                                <option value="<?php echo htmlentities($row['specilization']); ?>">
                                                                    <?php echo htmlentities($row['specilization']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctor">Doctors</label>
                                                        <select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required>
                                                            <option value="">Select Doctor</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="consultancyfees">Consultancy Fees</label>
                                                        <select name="fees" class="form-control" id="fees" readonly></select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="AppointmentDate">Date</label>
                                                        <input class="form-control" name="appdate" type="date" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Appointmenttime">Time</label>
                                                        <input class="form-control" name="apptime" type="time" required>
                                                    </div>

                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- col-lg-8 -->
                                </div> <!-- row -->
                            </div> <!-- col-md-12 -->
                        </div> <!-- row -->
                    </div> <!-- container -->
                </div>
            </div>
        </div>

        <?php include('include/footer.php'); ?>
        <?php include('include/setting.php'); ?>
    </div>

    <!-- JavaScript Files -->
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
