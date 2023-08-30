<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
$gp_id = $_GET['gp_id'];

$f_id = $_SESSION['id'];

$url = "document_result.php?gp_id=$gp_id";
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    $a = mysqli_query($conn, "SELECT * FROM group_enrollment_tbl where group_enrollment_id='$gp_id'");
    $b = mysqli_fetch_array($a);


    ?>

    <!--================ Insertipion Code============= -->

    <?php
    if (isset($_POST['document_result'])) {
        $gp_id = $_POST['gp_id'];
        $name = $_POST['name'];
        $marks = $_POST['marks'];
        $f_id = $_POST['f_id'];

        // checking repeat data
        $existing_Query = "SELECT * FROM `result_tbl` WHERE `document`='$name' ";
        $existing_Result = mysqli_query($conn, $existing_Query);
        if (0 < mysqli_num_rows($existing_Result)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Hi!</strong> Your Entry is Already in Database!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        } else {

            $query = "INSERT into result_tbl (group_enrollment_id,faculty_id,document,marks)VALUES('$gp_id','$f_id','$name','$marks')";

            $run = mysqli_query($conn, $query);
            if ($run) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hi!</strong> Student add Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
                header("Refresh:1; url=$url");
            }
        }
    }
    ?>

    <!--================ Insertipion Code============= -->

    <!--================ Delete Code============= -->

    <?php
    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];

        $del_query = "DELETE from upload_document_tbl where std_id='$del_id'";
        $execute = mysqli_query($conn, $del_query);
        if ($execute) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Hi!</strong> Student Delete Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            header("Refresh:1; url=student.php");
        }
    }
    ?>

    <!--================ Delete Code============= -->

    <!--================ Edit Code ================== -->

    <?php
    if (isset($_POST['update'])) :
        $eval_ma = $_POST['Add_eval_ma'];
        $eval_mb = $_POST['Add_eval_mb'];
        $id = $_POST['result_id'];

        $update_query = "UPDATE result_tbl SET eval_a_m = '$eval_ma',eval_b_m='$eval_mb' WHERE result_id = '$id'";
        $run = mysqli_query($conn, $update_query); ?>
    <div class="container">
        <?php if ($run) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Wow!</strong> Evalvator Marks Add Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
                header("Refresh:2; url=$url;");
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
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)"><?php echo $b['2']; ?> |
                        <?php echo $b['3']; ?> Documents Result</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Document Name</th>
                                        <th>Marks</th>
                                        <th>Evalvator 1</th>
                                        <th>Evalvator 2</th>
                                        <th>Tolal</th>

                                        <th>Add Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---============Selection code ===========--->
                                    <?php
                                    $sno = 1;
                                    $query = "SELECT * from result_tbl where group_enrollment_id='$gp_id'";
                                    $run = mysqli_query($conn, $query);
                                    while ($std_data = mysqli_fetch_array($run)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td><?php echo $std_data['3'] ?></td>
                                        <td>30 / <?php echo $std_data['4'] ?></td>
                                        <td>35 / <?php echo $std_data['5'] ?></td>
                                        <td>35 / <?php echo $std_data['6'] ?></td>
                                        <td>
                                            <?php echo $total =  $std_data['4'] + $std_data['5'] + $std_data['6'];
                                                ?>
                                        </td>
                                        <td><button class="btn btn-success btn-circle" data-toggle="modal" type="button"
                                                data-target="#update_modal<?php echo $std_data['0'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span> <i
                                                    class='fa fa-edit'></i></button>

                                        </td>
                                    </tr>

                                    <!--==== Modal Start ====-->

                                    <div class="modal fade" id="update_modal<?php echo $std_data['0'] ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="<?php echo $url ?>">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="color: rgb(127, 29 ,29)">
                                                            <b>Add Marks</b>
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Add Evalvator 1 Marks </label>
                                                                35/
                                                                <input type="hidden" name="result_id"
                                                                    value="<?php echo $std_data['0'] ?>" />
                                                                <input type="text" name="Add_eval_ma"
                                                                    value="<?php echo $std_data['5'] ?>"
                                                                    class="form-control" required="required" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Add Evalvator 2 Marks </label>
                                                                <input type="text" name="Add_eval_mb"
                                                                    value="<?php echo $std_data['6'] ?>"
                                                                    class="form-control" required="required" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div style="clear:both;"></div>
                                                    <div class="modal-footer">
                                                        <button name="update" type="submit"
                                                            style="color:white;background: rgb(127, 29 ,29)"
                                                            class="btn"><span class="glyphicon glyphicon-edit"></span>
                                                            Add</button>
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
</div>
</div>
<?php
include('include/scripts.php');
include('include/footer.php');
?>