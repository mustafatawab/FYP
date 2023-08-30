<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
$dept = $_SESSION['department'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!--================ Insertipion Code============= -->


    <?php
    if (isset($_POST['evalvations_btn'])) {
        $panel_no = $_POST['panel_no'];
        $room = $_POST['room'];
        $evaluator = $_POST['evaluator'];
        $evaluation = $_POST['evaluation'];
        $dept = $_POST['dept'];

        $query = "INSERT into panel_tbl (panel_no,room,evaluator,evalvations_id,dept)
    VALUES('$panel_no','$room','$evaluator','$evaluation','$dept')";
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
            header("Refresh:1; url=panels.php");
        }
    }
    ?>

    <!--================ Insertipion Code============= -->

    <!--================ Delete Code============= -->

    <?php
    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];

        $del_query = "DELETE from panel_tbl where panel_id='$del_id'";
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
            header("Refresh:1; url=panels.php");
        }
    }
    ?>

    <!--================ Delete Code============= -->

    <!--================ Edit Code ================== -->

    <?php
    if (isset($_POST['update'])) :
        $up_panel_no = $_POST['up_panel_no'];
        $up_room = $_POST['up_room'];
        $up_evaluator = $_POST['up_evaluator'];
        $up_evaluation = $_POST['up_evaluation'];
        $id = $_POST['id'];



        $update_query = "UPDATE panel_tbl SET panel_no='$up_panel_no',room='$up_room',evaluator='$up_evaluator',evalvations_id='$up_evaluation' WHERE panel_id='$id'";
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
                header("Refresh:2; url=panels.php");
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
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Panel</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Panel</th>
                                        <th>Room</th>
                                        <th>Evaluator</th>
                                        <th>Evaluation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---============Selection code ===========--->
                                    <?php
                                    $sno = 1;
                                    $query = "SELECT * from panel_tbl";
                                    $run = mysqli_query($conn, $query);
                                    while ($panel_data = mysqli_fetch_array($run)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td><?php echo $panel_data['1'] ?></td>
                                        <td> <?php echo $panel_data['2'] ?></td>
                                        <td><?php $F_ID = $panel_data['3'];
                                                $a = mysqli_query($conn, "SELECT * FROM faculty_tbl where faculty_id='$F_ID'");
                                                $D = mysqli_fetch_array($a);
                                                echo  $D['1'] ?></td>
                                        <td> <?php $id = $panel_data['4'];
                                                    $a = mysqli_query($conn, "SELECT * FROM evalvations_tbl where evalvations_id='$id'");
                                                    $d = mysqli_fetch_array($a);
                                                    echo  $d['1'] ?></td>
                                        <td><button class="btn btn-success btn-circle" data-toggle="modal" type="button"
                                                data-target="#update_modal<?php echo $panel_data['panel_id'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span> <i
                                                    class='fa fa-edit'></i></button>
                                            <a href="panels.php?del_id=<?php echo $panel_data['0']  ?>"
                                                class="btn btn-danger btn-circle "><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!--==== Modal Start ====-->

                                    <div class="modal fade" id="update_modal<?php echo $panel_data['panel_id'] ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="panels.php">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="color: rgb(127, 29 ,29)">
                                                            <b>Update Panel</b>
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <input name='id' type="text"
                                                                value='<?php echo $panel_data['0'] ?>'>
                                                            <label for="name" class="">Panel No :</label>
                                                            <input type="text" name="up_panel_no"
                                                                placeholder="Panel Number"
                                                                value="<?php echo $panel_data['panel_no'] ?>"
                                                                class="form-control mb-2" />
                                                            <label for="name" class="">Room :</label>
                                                            <select name="up_room" id="" required
                                                                class="form-control mb-2">
                                                                <option value="<?php echo $panel_data['room'] ?>">
                                                                    <?php echo $panel_data['room'] ?></option>
                                                                <?php
                                                                    $room_select_query = "SELECT * FROM room_tbl where dept='$dept'";
                                                                    $room_res = mysqli_query($conn, $room_select_query);
                                                                    while ($room = mysqli_fetch_array($room_res)) : ?>
                                                                <option value="<?php echo $room['room_name'] ?>">
                                                                    <?php echo $room['room_name'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                            <label for="name" class="">Evaluator :</label>
                                                            <select name="up_evaluator" id="" required
                                                                class="form-control mb-2">
                                                                <option value="<?php echo $panel_data['3'] ?>">
                                                                    <?php echo $panel_data['3'] ?></option>
                                                                <?php
                                                                    $room_select_query = "SELECT * FROM faculty_tbl where status='1'";
                                                                    $room_res = mysqli_query($conn, $room_select_query);
                                                                    while ($room = mysqli_fetch_array($room_res)) : ?>
                                                                <option value="<?php echo $room['evaluator_name'] ?>">
                                                                    <?php echo $room['evaluator_name'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                            <label for="name" class="">Evaluatoions :</label>
                                                            <select name="up_evaluation" id="" required
                                                                class="form-control mb-2">
                                                                <option value="<?php echo $panel_data['4'] ?>">
                                                                    <?php echo $panel_data['4'] ?></option>
                                                                <?php
                                                                    $room_select_query = "SELECT * FROM evalvations_tbl";
                                                                    $room_res = mysqli_query($conn, $room_select_query);
                                                                    while ($room = mysqli_fetch_array($room_res)) : ?>
                                                                <option value="<?php echo $room['0'] ?>">
                                                                    <?php echo $room['evalvation'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
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
                                                                class="glyphicon glyphicon-remove"></span>
                                                            Close</button>
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

    <div class="col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Add Panel</h6>
                <div class="card-body">
                    <div class="">
                        <form method="post" action="panels.php">
                            <div class="col-md-12">
                                <label for="name" class="">Panel No :</label>
                                <input type="text" name="panel_no" placeholder="Panel Number"
                                    class="form-control mb-2" />
                                <label for="name" class="">Room :</label>
                                <select name="room" id="" required class="form-control mb-2">
                                    <option value="select_department">Select Room</option>
                                    <?php
                                    $room_select_query = "SELECT * FROM room_tbl";
                                    $room_res = mysqli_query($conn, $room_select_query);
                                    while ($room = mysqli_fetch_array($room_res)) : ?>
                                    <option value="<?php echo $room['room_name'] ?>"><?php echo $room['room_name'] ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>
                                <label for="name" class="">Evaluator :</label>
                                <select name="evaluator" id="" required class="form-control mb-2">
                                    <option value="select_department">Select Evaluator</option>
                                    <?php
                                    $faculty_select_query = "SELECT * FROM faculty_tbl where status='1'";
                                    $faculty_res = mysqli_query($conn, $faculty_select_query);
                                    while ($fdata = mysqli_fetch_array($faculty_res)) : ?>
                                    <option value="<?php echo $fdata['0'] ?>">
                                        <?php echo $fdata['1'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <label for="name" class="">Evaluatoions :</label>
                                <select name="evaluation" id="" required class="form-control mb-2">
                                    <option value="select_department">Select Evaluatoions</option>
                                    <?php
                                    $room_select_query = "SELECT * FROM evalvations_tbl";
                                    $room_res = mysqli_query($conn, $room_select_query);
                                    while ($room = mysqli_fetch_array($room_res)) : ?>
                                    <option value="<?php echo $room['0'] ?>"><?php echo $room['evalvation'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <input type="hidden" name="dept" value="<?php echo $_SESSION['department']; ?>"
                                    class="p-2" />
                            </div>
                            <button class="btn btn mt-4" style="color:white;background: rgb(127, 29 ,29)"
                                name="evalvations_btn">
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
<?php
include('include/scripts.php');
include('include/footer.php');
?>