<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

// Connect to database using mysqli
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
if (!$bd) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle user deletion
if (isset($_GET['del']) && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize ID input

    $stmt = mysqli_prepare($bd, "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['msg'] = "User deleted successfully!";
    } else {
        $_SESSION['msg'] = "Failed to delete user.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Manage Patients</title>
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
                                <h1 class="mainTitle">Admin | Manage Patients</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Admin</span></li>
                                <li class="active"><span>Manage Patients</span></li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Patients</span></h5>
                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); $_SESSION['msg'] = ""; ?></p>

                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Creation Date</th>
                                            <th>Updation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$query = "SELECT * FROM users";
$result = mysqli_query($bd, $query);
$cnt = 1;

while ($row = mysqli_fetch_assoc($result)) {
?>
                                        <tr>
                                            <td class="center"><?php echo $cnt; ?>.</td>
                                            <td><?php echo htmlentities($row['fullName']); ?></td>
                                            <td><?php echo htmlentities($row['address']); ?></td>
                                            <td><?php echo htmlentities($row['city']); ?></td>
                                            <td><?php echo htmlentities($row['gender']); ?></td>
                                            <td><?php echo htmlentities($row['email']); ?></td>
                                            <td><?php echo htmlentities($row['regDate']); ?></td>
                                            <td><?php echo htmlentities($row['updationDate']); ?></td>
                                            <td>
                                                <a href="manage-users.php?id=<?php echo $row['id']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove">
                                                    <i class="fa fa-times fa fa-white"></i>
                                                </a>
                                            </td>
                                        </tr>
<?php
    $cnt++;
}
mysqli_close($bd);
?>
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

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
        });
    </script>
</body>
</html>
