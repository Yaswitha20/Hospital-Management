<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    // Retrieve form data
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];

    // Prepare and execute UPDATE query
    $stmt = mysqli_prepare($bd, "UPDATE users SET fullName = ?, address = ?, city = ?, gender = ? WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "sssss", $fname, $address, $city, $gender, $_SESSION['login']);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Your Profile updated Successfully');</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Edit Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
                                <h1 class="mainTitle">User | Edit Profile</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>User </span></li>
                                <li class="active"><span>Edit Profile</span></li>
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
                                                <h5 class="panel-title">Edit Profile</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php
                                                $stmt = mysqli_prepare($bd, "SELECT * FROM users WHERE email = ?");
                                                mysqli_stmt_bind_param($stmt, "s", $_SESSION['login']);
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);
                                                while ($data = mysqli_fetch_array($result)) {
                                                ?>
                                                    <form role="form" name="edit" method="post">
                                                        <div class="form-group">
                                                            <label for="fname">User Name</label>
                                                            <input type="text" name="fname" class="form-control" value="<?php echo htmlentities($data['fullName']); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <textarea name="address" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="city">City</label>
                                                            <input type="text" name="city" class="form-control" required value="<?php echo htmlentities($data['city']); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <input type="text" name="gender" class="form-control" required value="<?php echo htmlentities($data['gender']); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="uemail">User Email</label>
                                                            <input type="email" name="uemail" class="form-control" readonly value="<?php echo htmlentities($data['email']); ?>">
                                                        </div>

                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">Update</button>
                                                    </form>
                                                <?php
                                                }
                                                mysqli_stmt_close($stmt);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php include('include/footer.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('include/setting.php'); ?>
        </div>

        <!-- Scripts -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>
</html>
