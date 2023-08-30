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
    if (isset($_POST['room_btn'])) {
        $room = $_POST['room'];
        $dept = $_POST['dept'];

        $query = "INSERT into room_tbl (room_name,dept)VALUES('$room','$dept')";
        $run = mysqli_query($conn, $query);
        if ($run) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hi!</strong> Room add Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            header("Refresh:1; url=room.php");
        }
    }
    ?>

    <!--================ Insertipion Code============= -->

    <!--================ Delete Code============= -->

    <?php
    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];

        $del_query = "DELETE from room_tbl where room_id='$del_id'";
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
            header("Refresh:1; url=room.php");
        }
    }
    ?>

    <!--================ Delete Code============= -->

    <!--================ Edit Code ================== -->

    <?php
    if (isset($_POST['update'])) :
        $updt_room_name = $_POST['updt_room_name'];
        $updt_location = $_POST['updt_location'];
        $room_id = $_POST['room_id'];

        $update_query = "UPDATE room_tbl SET room_name = '$updt_room_name',dept='$updt_location' WHERE room_id = '$room_id'";
        $run = mysqli_query($conn, $update_query); ?>
    <div class="container">
        <?php if ($run) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Wow!</strong> Room updated Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
                header("Refresh:2; url=room.php");
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
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Rooms</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Room</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---============Selection code ===========--->
                                    <?php
                                    $sno = 1;
                                    $query = "SELECT * from room_tbl";
                                    $run = mysqli_query($conn, $query);
                                    while ($room_data = mysqli_fetch_array($run)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td><?php echo $room_data['1'] ?></td>
                                        <td> <?php echo $room_data['2'] ?></td>

                                        <td><button class="btn btn-success btn-circle" data-toggle="modal" type="button"
                                                data-target="#update_modal<?php echo $room_data['room_id'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span> <i
                                                    class='fa fa-edit'></i></button>
                                            <a href="room.php?del_id=<?php echo $room_data['0']  ?>"
                                                class="btn btn-danger btn-circle "><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!--==== Modal Start ====-->

                                    <div class="modal fade" id="update_modal<?php echo $room_data['room_id'] ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="room.php">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="color: rgb(127, 29 ,29)">
                                                            <b>Update Room</b></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Room Name </label>
                                                                <input type="hidden" name="room_id"
                                                                    value="<?php echo $room_data['room_id'] ?>" />
                                                                <input type="text" name="updt_room_name"
                                                                    value="<?php echo $room_data['room_name'] ?>"
                                                                    class="form-control" required="required" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Location</label>
                                                                <input type="text" name="updt_location"
                                                                    value="<?php echo $room_data['dept'] ?>"
                                                                    class="form-control" required="required" />
                                                            </div>
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
                <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Add Rooms</h6>
                <div class="card-body">
                    <div class="">
                        <form method="post" action="room.php">
                            <label for="name" class="">Room Name :</label>
                            <input id="name" name="room" class="form-control mb-3" required
                                placeholder="Enter Room Name" />
                            <label for="date">location :</label>
                            <input type="text" name="dept" class="form-control" required
                                placeholder="Enter Department" />
                            <button class="btn btn mt-4" style="color:white;background: rgb(127, 29 ,29)"
                                name="room_btn">
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