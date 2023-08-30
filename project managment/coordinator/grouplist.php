<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
$dept = $_SESSION['department'];
$f_id =  $_SESSION['id'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!--================ Insertipion Code============= -->


    <?php
    if (isset($_POST['group_btn'])) {
        $f_id =  $_SESSION['id'];
        $group_no = $_POST['group_no'];
        $project_title = $_POST['project_title'];
        $std_1 = $_POST['std_a'];
        $std_2 = $_POST['std_b'];
        $std_3 = $_POST['std_c'];


        $query = "INSERT into group_enrollment_tbl(faculty_id,group_no,project_title,std_a,std_b,std_c)
    VALUES('$f_id','$group_no','$project_title','$std_1','$std_2','$std_3')";
        $run = mysqli_query($conn, $query);
        if ($run) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hi!</strong> Panel add Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            header("Refresh:1; url=group.php");
        }
    }
    ?>

    <!--================ Insertipion Code============= -->

    <!--================ Delete Code============= -->

    <?php
    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];

        $del_query = "DELETE from group_enrollment_tbl where group_enrollment_id='$del_id'";
        $execute = mysqli_query($conn, $del_query);
        if ($execute) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Hi!</strong> Room Delete Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            header("Refresh:1; url=group.php");
        }
    }
    ?>

    <!--================ Delete Code============= -->

    <!--================ Edit Code ================== -->

    <?php
    if (isset($_POST['update'])) :
        $up_group_no = $_POST['up_group_no'];
        $up_project_title = $_POST['up_project_title'];
        $up_std_a = $_POST['up_std_a'];
        $up_std_b = $_POST['up_std_b'];
        $up_std_c = $_POST['up_std_c'];
        $id = $_POST['id'];

        $update_query = "UPDATE group_enrollment_tbl SET group_no='$up_group_no',project_title='$up_project_title',std_a='$up_std_a',std_b='$up_std_b',std_c='$up_std_c'
     WHERE group_enrollment_id='$id'";
        $run = mysqli_query($conn, $update_query); ?>
    <div class="container">
        <?php if ($run) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Wow!</strong> Panel updated Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
                header("Refresh:2; url=group.php");
            else : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Failed to update department, Try again!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!--================ Edit Code end============= -->

    <!-- status  -->
    <?php
    if (isset($_GET['status_id'])) {

        $id = $_GET['status_id'];




        $n = mysqli_query($conn, "SELECT * from group_enrollment_tbl where group_enrollment_id='$id'");
        $data = mysqli_fetch_array($n);
        $status = $data['status'];

        if ($status == 0) {
            $run = mysqli_query($conn, "UPDATE group_enrollment_tbl SET status='1' where group_enrollment_id='$id'");
            if ($run) {
                $result = mysqli_query($conn, "INSERT INTO result_tbl (group_enrollment_id) values('$id')");
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Accept Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            }
        }
        if ($status == 1) {
            $run = mysqli_query($conn, "UPDATE group_enrollment_tbl SET status='2' where group_enrollment_id='$id'");
            if ($run) {

            ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Reject Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            }
        }
        if ($status == 2) {
            $run = mysqli_query($conn, "UPDATE group_enrollment_tbl SET status='0' where group_enrollment_id='$id'");
            if ($run) {
            ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Pending Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            }
        }
    }

    ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Groups</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Group No</th>
                                        <th>Project Title</th>
                                        <th>Student 1 SAP</th>
                                        <th>Student 2 SAP</th>
                                        <th>Student 2 SAP</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---============Selection code ===========--->
                                    <?php
                                    $sno = 1;
                                    $query = "SELECT * from group_enrollment_tbl where faculty_id='$f_id'";
                                    $run = mysqli_query($conn, $query);
                                    while ($group_data = mysqli_fetch_array($run)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td><?php echo $group_data['2'] ?></td>
                                        <td> <?php echo $group_data['3'] ?></td>
                                        <td><?php $stda = $group_data['4'];
                                                $a = mysqli_query($conn, "SELECT * FROM student_tbl where std_id='$stda'");
                                                $d = mysqli_fetch_array($a);
                                                ?><?php echo  $d['name'] ?> | <?php echo  $d['sap_id']; ?></td>
                                        <td> <?php $stdb = $group_data['5'];
                                                    $ok = mysqli_query($conn, "SELECT * FROM student_tbl where std_id='$stdb'");
                                                    $d = mysqli_fetch_array($ok);
                                                    ?><?php echo  $d['name'] ?> | <?php echo  $d['sap_id']; ?></td>
                                        <td><?php $stdc = $group_data['6'];
                                                $ok = mysqli_query($conn, "SELECT * FROM student_tbl where std_id='$stdc'");
                                                $d = mysqli_fetch_array($ok);
                                                ?><?php echo  $d['name'] ?> | <?php echo  $d['sap_id'];
                                                                        ?></td>
                                        <td> <?php $status = $group_data['7'];
                                                    if ($status == 0) {
                                                    ?>
                                            <a href="grouplist.php?status_id=<?php echo $group_data['0']  ?>"
                                                class="btn btn-warning  ">
                                                Pending
                                            </a>
                                            <?php
                                                    }
                                                    if ($status == 1) { ?>
                                            <a href="grouplist.php?status_id=<?php echo $group_data['0']  ?>"
                                                class="btn btn-success  ">
                                                Accept
                                            </a>
                                            <?php
                                                    }
                                                    if ($status == 2) { ?>
                                            <a href="grouplist.php?status_id=<?php echo $group_data['0']  ?>"
                                                class="btn btn-danger  ">
                                                Reject
                                            </a>
                                            <?php
                                                    }
                                                ?>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
include('include/scripts.php');
include('include/footer.php');
?>