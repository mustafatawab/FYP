<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
$f_id = $_SESSION['id'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex  mb-4">
        <h1 class="h3 ">Dashboard</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <a href="#" style="text-decoration:none;">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Student</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?php

                                    $query = "SELECT * FROM student_tbl where faculty_id='$f_id'";
                                    $query_run = mysqli_query($conn, $query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h5> Total Students  : ' . $row . '</h5>';

                                    ?>
                                </div>
                        </a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <a href="All_student.php" style="text-decoration:none;">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Groups
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                                        <?php

                                        $query = "SELECT * FROM group_enrollment_tbl where faculty_id='$f_id'";
                                        $query_run = mysqli_query($conn, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h5> Total Groups  : ' . $row . '</h5>';

                                        ?>

                                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
        </div>
    </div>
</div>
</div>
</div>
</div>

<!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->

<?php
include('include/scripts.php');
include('include/footer.php');


?>