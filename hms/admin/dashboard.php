<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway|Crete+Round" rel="stylesheet" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
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
                            <h1 class="mainTitle">Admin | Dashboard</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Admin</span></li>
                            <li class="active"><span>Dashboard</span></li>
                        </ol>
                    </div>
                </section>

                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <!-- Patients -->
                        <div class="col-sm-4">
                            <div class="panel panel-white no-radius text-center">
                                <div class="panel-body">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                                        <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <h2 class="StepTitle">Manage Patients</h2>
                                    <p class="links cl-effect-1">
                                        <a href="manage-users.php">
                                            <?php
                                            $query = mysqli_query($bd, "SELECT * FROM users");
                                            $num_rows = mysqli_num_rows($query);
                                            echo "Total Patients : " . htmlentities($num_rows);
                                            ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Doctors -->
                        <div class="col-sm-4">
                            <div class="panel panel-white no-radius text-center">
                                <div class="panel-body">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                                        <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <h2 class="StepTitle">Manage Doctors</h2>
                                    <p class="cl-effect-1">
                                        <a href="manage-doctors.php">
                                            <?php
                                            $query1 = mysqli_query($bd, "SELECT * FROM doctors");
                                            $num_rows1 = mysqli_num_rows($query1);
                                            echo "Total Doctors : " . htmlentities($num_rows1);
                                            ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Appointments -->
                        <div class="col-sm-4">
                            <div class="panel panel-white no-radius text-center">
                                <div class="panel-body">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                                        <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <h2 class="StepTitle">Appointments</h2>
                                    <p class="links cl-effect-1">
                                        <a href="appointment-history.php">
                                            <?php
                                            $query2 = mysqli_query($bd, "SELECT * FROM appointment");
                                            $num_rows2 = mysqli_num_rows($query2);
                                            echo "Total Appointments : " . htmlentities($num_rows2);
                                            ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER & SETTINGS -->
    <?php include('include/footer.php'); ?>
    <?php include('include/setting.php'); ?>
</div>

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
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
