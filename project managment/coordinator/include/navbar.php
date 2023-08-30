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
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="room.php">
            <i class="fas fa-fw fa-plus-square"></i>
            <b>Room</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="faculty.php">
            <i class="fas fa-fw fa-user"></i>
            <b>Facuty</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="evalvator.php">
            <i class="fas fa-fw fa-plus-square"></i>
            <b>Evalvator</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="evalvations.php">
            <i class="fas fa-fw fa-plus-square"></i>
            <b>Evalvations</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="panels.php">
            <i class="fas fa-fw fa-plus-square"></i>
            <b>Panels</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="grouplist.php">
            <i class="fas fa-fw fa-users"></i>
            <b>Group List</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="schedule.php">
            <i class="fas fa-fw fa-plus-square"></i>
            <b>Schedule</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="result.php">
            <i class="fas fa-fw fa-plus-square"></i>
            <b>Result</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="notification.php">
            <i class="fas fa-fw fa-bell"></i>
            <b>Notification</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" style="color:gray;padding:7px 1rem" href="../logout.php">
            <i class="fa fa-angle-left"></i>
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
                <li class="nav-item">
                    <a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <a style="margin-bottom: 60px;" class="dropdown-item " href="admin_logout.php"
                                data-toggle="modal" data-target="#logoutModal">
                                | <?php echo $_SESSION['name'] ?>
                                <i class="fas fa-user fa-lg fa-2x text-gray-900"></i>
                            </a>

                        </span>

                    </a>
                    <!-- Dropdown - User Information -->

                </li>



            </ul>

        </nav>
        <!-- End of Topbar -->