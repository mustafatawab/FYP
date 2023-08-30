<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-primary accordion shadow" id="accordionSidebar"
    style="background-color:#f8f9fc; border-right:1px solid lightgray;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center "
        style="background-color:f8f9fc ; width:100%;height:100px;" href="index.php">
        <img src="assets/img/logo.png" alt="" style="width: 100%;" class="p-3">
    </a>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">
        <a class="nav-link" style="color:gray" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <b>Dashboard</b></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="student.php">
            <i class="fas fa-fw fa-user"></i>
            <b>Student</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="group.php">
            <i class="fas fa-fw fa-users"></i>
            <b>Group</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="document.php">
            <i class="fas fa-fw fa-file"></i>
            <b>Upload Documents</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="result.php">
            <i class="fas fa-fw fa-plus-square"></i>
            <b>Assign Marks</b></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="../logout.php">
            <i class="fas fa-angle-left"></i>
            <b>logOut</b></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- Sidebar Message -->
</ul>
<!-- End of Sidebar -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Content Wrapper -->
<div id="content-wrapper" class="">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-5 static-top shadow p-5"
            style="background-color:#f8f9fc; width:100%;height:110px">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow mx-1 mt-5">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter"><?php
                                                                        $query = "SELECT * from notification_tbl";
                                                                        $runquery = mysqli_query($conn, $query);
                                                                        $num = mysqli_num_rows($runquery);

                                                                        echo $num ?></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header" style="background-color: rgb(127, 29 ,29);">
                            Alerts Center
                        </h6>
                        <?php
                        $query = "SELECT * from notification_tbl";
                        $run = mysqli_query($conn, $query);
                        while ($room_data = mysqli_fetch_array($run)) {
                        ?>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle" style="background-color: rgb(127, 29 ,29);">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo $room_data['3'] ?></div>
                                <span class="font-weight-bold"><?php echo $room_data['1'] ?></span>
                            </div>
                        </a>
                        <?php
                        } ?>

                        <a class="dropdown-item text-center small text-gray-500" href="notification.php">Show All
                            Alerts</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <a style="margin-bottom: 60px;" class="dropdown-item " href="admin_logout.php"
                                data-toggle="modal" data-target="#logoutModal">
                                | <?php echo $_SESSION['name'] ?>
                                <i class="fas fa-user fa-lg fa-x text-gray-900"></i>
                            </a>

                        </span>

                    </a>
                    <!-- Dropdown - User Information -->

                </li>



            </ul>

        </nav>
        <!-- End of Topbar -->