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
if (isset($_POST['std_btn'])) {
    $name = $_POST['name'];
    $sap_id = $_POST['sap_id'];
    $contact = $_POST['contact'];
    $dept = $_POST['dept'];
    $faculty_id = $_POST['faculty_id'];
    
  
    $query = "INSERT into student_tbl (name,sap_id,dept,faculty_id,contact)VALUES('$name','$sap_id','$dept','$faculty_id','$contact')";
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
                 header("Refresh:1; url=student.php");
            }
        }
        ?>

    <!--================ Insertipion Code============= -->

    <!--================ Delete Code============= -->

    <?php
       if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
    
        $del_query = "DELETE from student_tbl where std_id='$del_id'";
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

    $update_query = "UPDATE student_tbl SET name = '$upd_name',sap_id='$upd_sap_id',contact='$upd_contact' WHERE std_id = '$std_id'";
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
                    <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Student</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Name</th>
                                        <th>SAP ID</th>
                                        <th>Department </th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---============Selection code ===========--->
                                    <?php
                                $sno = 1;
                                $query = "SELECT * from student_tbl where faculty_id='$f_id'";
                                $run = mysqli_query($conn, $query);
                                while ($std_data = mysqli_fetch_array($run)) {
                                ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td><?php echo $std_data['1'] ?></td>
                                        <td> <?php echo $std_data['2'] ?></td>
                                        <td><?php echo $std_data['3'] ?></td>
                                        <td> <?php echo $std_data['5'] ?></td>
                                        <td><button class="btn btn-success btn-circle" data-toggle="modal" type="button"
                                                data-target="#update_modal<?php echo $std_data['std_id']?>">
                                                <span class="glyphicon glyphicon-edit"></span> <i
                                                    class='fa fa-edit'></i></button>
                                            <a href="student.php?del_id=<?php echo $std_data['std_id']  ?>"
                                                class="btn btn-danger btn-circle "><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!--==== Modal Start ====-->

                                    <div class="modal fade" id="update_modal<?php echo $std_data['std_id']?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="student.php">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="color: rgb(127, 29 ,29)">
                                                            <b>Update Student</b></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <label for="name" class=""> Name :</label>
                                                            <input type="text" name='std_id'
                                                                value='<?php echo $std_data['std_id']?>'>
                                                            <input type="text" name="upd_name"
                                                                value='<?php echo $std_data['name']?>'
                                                                placeholder=" Name" class="form-control" />
                                                            <label for="name" class="">SAP ID :</label>
                                                            <input type="text" name="upd_sap_id"
                                                                value='<?php echo $std_data['sap_id']?>'
                                                                placeholder=" SAP_id" class="form-control" />
                                                            <label for="name" class="">Contact :</label>
                                                            <input type="text" name="upd_contact"
                                                                value='<?php echo $std_data['contact']?>'
                                                                placeholder="contact" class="form-control" />
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
                <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Add Student</h6>
                <div class="card-body">

                    <div class="">
                        <form method="post" action="student.php">
                            <label for="name" class=""> Name :</label>
                            <input type="text" name="name" placeholder=" Name" class="form-control" />
                            <label for="name" class="">SAP ID :</label>
                            <input type="text" name="sap_id" placeholder=" SAP_id" class="form-control" />
                            <label for="name" class="">Contact :</label>
                            <input type="text" name="contact" placeholder="contact" class="form-control" />

                            <input type="hidden" name="faculty_id" value="<?php echo $f_id ?>" class="p-2" />
                            <input type="hidden" name="dept" value="<?php echo $_SESSION['department']; ?>"
                                class="p-2" />
                            <button class="btn btn mt-4" style="color:white;background: rgb(127, 29 ,29)"
                                name="std_btn">
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