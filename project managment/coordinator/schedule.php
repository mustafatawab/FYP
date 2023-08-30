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
    if (isset($_POST['schedule_btn'])) {

        $panel_id = $_POST['panel_id'];
        $group_id = $_POST['group_id'];
        $date = $_POST['date'];
        $stime = $_POST['stime'];
        $etime = $_POST['etime'];
        $dept = $_POST['dept'];
        $f_id =  $_SESSION['id'];

        // checking repeat data
        $existing_Query = "SELECT * FROM `schedule_tbl` WHERE `panel_id`='$panel_id' ";
        $existing_Result = mysqli_query($conn, $existing_Query);
        if (0 < mysqli_num_rows($existing_Result)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Hi!</strong> This Panel is Already  Schedule!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>';
        } else {


            $query = "INSERT into schedule_tbl(panel_id,group_id,date,stime,etime,dept,faculty_id)
    VALUES('$panel_id','$group_id','$date','$stime','$etime','$dept','$f_id')";
            $run = mysqli_query($conn, $query);
            if ($run) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hi!</strong> Schedule add Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
                header("Refresh:1; url=schedule.php");
            }
        }
    }
    ?>

    <!--================ Insertipion Code============= -->

    <!--================ Delete Code============= -->

    <?php
    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];

        $del_query = "DELETE from schedule_tbl where schedule_id='$del_id'";
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
            header("Refresh:1; url=schedule.php");
        }
    }
    ?>

    <!--================ Delete Code============= -->

    <!--================ Edit Code ================== -->

    <?php
    if (isset($_POST['update'])) :
        $up_panel_id = $_POST['up_panel_id'];
        $up_group_id = $_POST['up_group_id'];
        $up_date = $_POST['up_date'];
        $up_stime = $_POST['up_stime'];
        $up_etime = $_POST['up_etime'];
        $id = $_POST['id'];


        $update_query = "UPDATE schedule_tbl SET panel_id='$up_panel_id',group_id='$up_group_id',date='$up_date',stime='$up_stime',etime='$up_etime'
     WHERE schedule_id='$id'";
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
                header("Refresh:2; url=schedule.php");
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

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Generate Schedule</h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <form method="post" action="schedule.php">
                                    <label for="name" class="">Panel :</label>
                                    <select name="panel_id" id="" required class="form-control mb-2">
                                        <option value="select_department">Select student</option>
                                        <?php
                                        $query = "SELECT * from panel_tbl";
                                        $panel_res = mysqli_query($conn, $query);
                                        while ($panel_d = mysqli_fetch_array($panel_res)) : ?>
                                        <option value="<?php echo $panel_d['panel_id'] ?>">
                                            <?php echo $panel_d['panel_no'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <label for="name" class="">Start Time :</label>
                                    <input type="time" name="stime" placeholder="Group Number"
                                        class="form-control mb-2" />
                                    <label for="name" class="">Date :</label>
                                    <input type="date" name="date" placeholder="Group Number"
                                        class="form-control mb-2" />
                            </div>
                            <div class="col-xl-6">
                                <label for="name" class="">Group :</label>
                                <select name="group_id" id="" required class="form-control mb-2">
                                    <option value="select_department">Select student</option>
                                    <?php
                                    $gp_select_query = "SELECT * FROM group_enrollment_tbl where status='1'";
                                    $gp_res = mysqli_query($conn, $gp_select_query);
                                    while ($gp_d = mysqli_fetch_array($gp_res)) : ?>
                                    <option value="<?php echo $gp_d['group_enrollment_id'] ?>">
                                        <?php echo $gp_d['group_no'] ?> | <?php echo $gp_d['project_title'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <label for="name" class="">End Time :</label>
                                <input type="time" name="etime" placeholder="Group Number" class="form-control mb-2" />
                                <input type="hidden" name="dept" value="<?php echo $_SESSION['department']; ?>"
                                    class="p-2" />
                                <button class="btn btn mt-4" style="color:white;background: rgb(127, 29 ,29)"
                                    name="schedule_btn">
                                    Submit
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Schedule</h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S no</th>
                                    <th>Panel</th>
                                    <th>Group No</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Deprtment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!---============Selection code ===========--->
                                <?php
                                $sno = 1;
                                $query = "SELECT * from schedule_tbl where faculty_id='$f_id'";
                                $run = mysqli_query($conn, $query);
                                while ($schedule_data = mysqli_fetch_array($run)) {
                                ?>
                                <tr>
                                    <td><?php echo $sno++; ?></td>
                                    <td><?php $stda = $schedule_data['1'];
                                            $a = mysqli_query($conn, "SELECT * FROM panel_tbl where panel_id='$stda'");
                                            $d = mysqli_fetch_array($a);
                                            ?><?php echo  $d['panel_no'] ?></td>
                                    <td> <?php $stdb = $schedule_data['2'];
                                                $ok = mysqli_query($conn, "SELECT * FROM group_enrollment_tbl where group_enrollment_id='$stdb'");
                                                $d = mysqli_fetch_array($ok);
                                                ?><?php echo  $d['group_no'] ?></td>
                                    <td><?php echo $schedule_data['date'] ?></td>
                                    <td> <?php echo $schedule_data['stime'] ?></td>
                                    <td><?php echo $schedule_data['etime']; ?></td>
                                    <td><?php echo $schedule_data['dept']; ?></td>
                                    <td><button class="btn btn-success btn-circle" data-toggle="modal" type="button"
                                            data-target="#update_modal<?php echo $schedule_data['0'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span> <i
                                                class='fa fa-edit'></i></button>
                                        <a href="schedule.php?del_id=<?php echo $schedule_data['0']  ?>"
                                            class="btn btn-danger btn-circle "><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!--==== Modal Start ====-->

                                <div class="modal fade" id="update_modal<?php echo $schedule_data['0'] ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="schedule.php">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" style="color: rgb(127, 29 ,29)"><b>Update
                                                            Group</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <input type="text" name='id'
                                                            value='<?php echo $schedule_data['0'] ?>'>
                                                        <label for="name" class="">Panel :</label>
                                                        <select name="up_panel_id" id="" required
                                                            class="form-control mb-2">
                                                            <option value="<?php echo $schedule_data['panel_id'] ?>">
                                                                <?php echo $schedule_data['0'] ?></option>
                                                            <?php
                                                                $query = "SELECT * from panel_tbl";
                                                                $panel_res = mysqli_query($conn, $query);
                                                                while ($panel_d = mysqli_fetch_array($panel_res)) : ?>
                                                            <option value="<?php echo $panel_d['panel_id'] ?>">
                                                                <?php echo $panel_d['panel_no'] ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        <label for="name" class="">Group :</label>
                                                        <select name="up_group_id" id="" required
                                                            class="form-control mb-2">
                                                            <option value="<?php echo $schedule_data['group_id'] ?>">
                                                                <?php echo $schedule_data['group_id'] ?></option>
                                                            <?php
                                                                $gp_select_query = "SELECT * FROM group_enrollment_tbl where status='1'";
                                                                $gp_res = mysqli_query($conn, $gp_select_query);
                                                                while ($gp_d = mysqli_fetch_array($gp_res)) : ?>
                                                            <option value="<?php echo $gp_d['group_enrollment_id'] ?>">
                                                                <?php echo $gp_d['group_no'] ?> |
                                                                <?php echo $gp_d['project_title'] ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        <label for="name" class="">Start Time :</label>
                                                        <input type="time" name="up_stime"
                                                            value="<?php echo $schedule_data['stime'] ?>"
                                                            placeholder="Group Number" class="form-control mb-2" />
                                                        <label for="name" class="">End Time :</label>
                                                        <input type="time" name="up_etime"
                                                            value="<?php echo $schedule_data['etime'] ?>"
                                                            placeholder="Group Number" class="form-control mb-2" />
                                                        <label for="name" class="">Date :</label>
                                                        <input type="date" name="up_date"
                                                            value='<?php echo $schedule_data['date'] ?>'
                                                            placeholder="Group Number" class="form-control mb-2" />
                                                    </div>

                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer">
                                                    <button name="update"
                                                        style="color:white;background: rgb(127, 29 ,29)"
                                                        class="btn"><span class="glyphicon glyphicon-edit"></span>
                                                        Update</button>
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal"><span
                                                            class="glyphicon glyphicon-remove"></span> Close</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                    </div>
                    <!-- model end -->

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