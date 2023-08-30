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

        $del_query = "DELETE from result_tbl where result_id='$del_id'";
        $execute = mysqli_query($conn, $del_query);
        if ($execute) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Hi!</strong> Document Delete Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
            header("Refresh:1; url=$url");
        }
    }
    ?>

    <!--================ Delete Code============= -->

    <!--================ Edit Code ================== -->

    <?php
    if (isset($_POST['update'])) :
        $upd_name = $_POST['upd_name'];
        $upd_sap_id = $_POST['upd_sap_id'];
        $upd_contact = $_POST['upd_contact'];
        $std_id = $_POST['std_id'];

        $update_query = "UPDATE upload_document_tbl SET name = '$upd_name',sap_id='$upd_sap_id',contact='$upd_contact' WHERE std_id = '$std_id'";
        $run = mysqli_query($conn, $update_query); ?>
    <div class="container">
        <?php if ($run) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Wow!</strong> Student updated Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
                header("Refresh:2; url=student.php");
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

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---============Selection code ===========--->
                                    <?php
                                    $sno = 1;
                                    $query = "SELECT * from result_tbl where group_enrollment_id='$gp_id' and faculty_id='$f_id'";
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

                                        <td>
                                            <a href="<?php echo $url; ?>?del_id=<?php echo $std_data['0']  ?>"
                                                class="btn btn-danger btn-circle "><i class="fa fa-trash"></i></a>
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

        <div class="col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Result Document</h6>
                    <div class="card-body">

                        <div class="">
                            <form method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
                                <label for="name" class=""> Doument Name :</label>
                                <select name="name" id="" class="form-control">
                                    <option value="">... Select ...</option>
                                    <option value="Proposal">Proposal</option>
                                    <option value="SRS">SRS</option>
                                    <option value="Progress Report">Progress Report</option>
                                    <option value="Final Report">Final Report</option>
                                </select>
                                <label for="name" class="mt-2"> Upload Document :</label>
                                <input type="text" name="marks" placeholder="Enter marks" class="form-control" />

                                <input type="hidden" name="f_id" value="<?php echo $f_id ?>" class="p-2" />
                                <input type="hidden" name="gp_id" value="<?php echo $gp_id; ?>" class="p-2" />
                                <button class="btn btn mt-4" style="color:white;background: rgb(127, 29 ,29)"
                                    name="document_result">
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