<?php error_reporting(E_ALL); // Set to E_ALL for debugging ?>
<header class="navbar navbar-default navbar-static-top">
    <!-- start: NAVBAR HEADER -->
    <div class="navbar-header">
        <!-- Mobile Toggle Button -->
        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
            <i class="ti-align-justify"></i>
        </a>
        <!-- Navbar Brand -->
        <a class="navbar-brand" href="#">
            <h2 style="padding-top:2% ">HMS</h2>
        </a>
        <!-- Sidebar Toggle Button for Larger Screens -->
        <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
            <i class="ti-align-justify"></i>
        </a>
        <!-- Mobile Menu Toggle -->
        <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="ti-view-grid"></i>
        </a>
    </div>
    <!-- end: NAVBAR HEADER -->

    <!-- start: NAVBAR COLLAPSE -->
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-right">
            <!-- Hospital Name Section -->
            <li style="padding-top:2%">
                <h2>Hospital Management System</h2>
            </li>
            <!-- User Profile Dropdown -->
            <li class="dropdown current-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/avatar-1.jpg" alt="Admin"> 
                    <span class="username">
                        Admin
                        <i class="ti-angle-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-dark">
                    <li>
                        <a href="change-password.php">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            Log Out
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end: USER OPTIONS DROPDOWN -->
        </ul>

        <!-- start: MOBILE MENU TOGGLER -->
        <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <div class="arrow-left"></div>
            <div class="arrow-right"></div>
        </div>
        <!-- end: MOBILE MENU TOGGLER -->
    </div>
    <!-- end: NAVBAR COLLAPSE -->
</header>

