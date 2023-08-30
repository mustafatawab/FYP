<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
$gp_id = $_GET['gp_id'];

$f_id = $_SESSION['id'];

$url = "group_document.php?gp_id=$gp_id";
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    $a = mysqli_query($conn, "SELECT * FROM group_enrollment_tbl where group_enrollment_id='$gp_id'");
    $b = mysqli_fetch_array($a);


    ?>

    <!--================ Insertipion Code============= -->

    <?php
    if (isset($_POST['document_btn'])) {
        $gp_id = $_POST['gp_id'];
        $doc_name = $_POST['name'];

        $image = $_FILES['img']['name'];
        $path = '../file/' . $image;
        $file = $_FILES['img']['tmp_name'];
        move_uploaded_file($file, $path);
        $f_id = $_POST['f_id'];

        $query = "INSERT into upload_document_tbl (group_enrollment_id,document_name,document,faculty_id)VALUES('$gp_id','$doc_name','$image','$f_id')";

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
                        <?php echo $b['3']; ?> Documents</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Document Name</th>
                                        <th>File</th>
                                        <th>Download</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---============Selection code ===========--->
                                    <?php
                                    $sno = 1;
                                    $query = "SELECT * from upload_document_tbl where group_enrollment_id='$gp_id' and faculty_id='$f_id'";
                                    $run = mysqli_query($conn, $query);
                                    while ($std_data = mysqli_fetch_array($run)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td> <?php echo $std_data['2'] ?></td>
                                        <td><?php echo $std_data['3'] ?></td>
                                        <td>
                                            <a href="../file/<?php echo $std_data['3']  ?>" download
                                                class="btn btn-success btn-circle "><i class="fa fa-download"></i></a>
                                        </td>
                                        <td>
                                            <a href="student.php?del_id=<?php echo $std_data['0']  ?>"
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
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Upload Document</h6>
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
                                <label for="name" class=""> Upload Document :</label>
                                <input type="file" name="img" placeholder="contact" class="form-control" />

                                <input type="hidden" name="f_id" value="<?php echo $f_id ?>" class="p-2" />
                                <input type="hidden" name="gp_id" value="<?php echo $gp_id; ?>" class="p-2" />
                                <button class="btn btn mt-4" style="color:white;background: rgb(127, 29 ,29)"
                                    name="document_btn">
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