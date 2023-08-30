<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
 $dept = $_SESSION['department'];
?>
 <!-- Begin Page Content -->
 <div class="container-fluid">

<!--================ Insertion Code============= -->

<?php
if (isset($_POST['signup-btn'])) :
    $name = $_POST['name'];
    $dept = $_POST['dept'];
    $email = $_POST['email'];
    $phone = $_POST['contact'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $confirm_password = $_POST['confirm_password'];


    if ($password !== $confirm_password) : ?>
<div class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Passwords didn't match.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<?php elseif ($dept == 'select_department') : ?>
<div class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Please select department.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<?php else :
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO faculty_tbl(name,department, email, phone_no,role ,password) 
        VALUES('$name','$dept','$email','$phone','$role','$password')";
        $run = mysqli_query($conn, $query); ?>
<div class="container">
    <?php if ($run) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Hi!</strong> Faculty add Successfully
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
    <?php else : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Failed to add teacher, try again!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php endif; ?>
<!--================ Insertion Code End============= -->

     <!--================ Delete Code============= -->

     <?php
       if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
    
        $del_query = "DELETE from faculty_tbl where faculty_id='$del_id'";
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
                 header("Refresh:1; url=faculty.php");
            }
        }
        ?>

     <!--================ Delete Code============= -->

     <!--================ Update Student============= -->

<?php if (isset($_POST['update'])) :
    $id = $_POST['id'];
      $name = $_POST['up_name'];
      $email = $_POST['up_email'];
      $phone = $_POST['up_contact'];
      $password = $_POST['up_password'];
      $confirm_password = $_POST['up_confirm_password'];
    $password_updated = $password !== "" && $confirm_password !== "" ? true : false;
    if ($password !== $confirm_password) : ?>
<div class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Passwords didn't match.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<?php else :
        $password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "";
        if ($password_updated) {
            $update_query = "UPDATE faculty_tbl SET name = '$name', email = '$email',phone_no='$phone', 
            password = '$password' WHERE faculty_id ='$id'";
        } else {
            $update_query = "UPDATE faculty_tbl SET name = '$name', email = '$email',phone_no='$phone' WHERE faculty_id ='$id'";
        }
        $run = mysqli_query($conn, $update_query);

    ?>

    <?php if ($run) :
            ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Faculty updated successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php else : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Failed to update profile, try again!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; 
    endif; 
endif; 
?>



<!--================ Update Code End============= -->

     <div class="row">
         <div class="col-xl-8">
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Faculty</h6>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table class="table " id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr>
                                         <th>S no</th>
                                         <th>Name</th>
                                         <th>Department</th>
                                         <th>Email</th>
                                         <th>Phone No</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <!---============Selection code ===========--->
                                                                <?php
                                $sno = 1;
                                
                                $query = "SELECT * from faculty_tbl where  role='Supervisor'";
                                $run = mysqli_query($conn, $query);
                                while ($faculty_data = mysqli_fetch_array($run)) {
                                ?>
                                     <tr>
                                         <td><?php echo $sno++; ?></td>
                                         <td><?php echo $faculty_data['1'] ?></td>
                                         <td> <?php echo $faculty_data['2'] ?></td>
                                         <td> <?php echo $faculty_data['3'] ?></td>
                                         <td> <?php echo $faculty_data['4'] ?></td>
                                         <td><button class="btn btn-success btn-circle" data-toggle="modal" type="button" 
					                       data-target="#update_modal<?php echo $faculty_data['0']?>">
                                           <span class="glyphicon glyphicon-edit"></span> <i class='fa fa-edit'></i></button>
                                             <a href="faculty.php?del_id=<?php echo $faculty_data['0']  ?>" class="btn btn-danger btn-circle "><i
                                                     class="fa fa-trash"></i></a>
                                         </td>
                                     </tr>

                                    <!--==== Modal Start ====-->

                                <div class="modal fade" id="update_modal<?php echo $faculty_data['faculty_id']?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="faculty.php">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" style="color: rgb(127, 29 ,29)"><b>Update Room</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                                
                                                <input type="hidden" name="id" value="<?php echo $faculty_data['0']; ?>" />
                                                <input type="text" name="up_name" value="<?php echo $faculty_data['name']; ?>" placeholder="Enter Username "
                                                class="form-control mb-3"required />
                                                <input type="email" name="up_email" value="<?php echo $faculty_data['3']; ?>" placeholder="Enter Email"
                                                class="form-control mb-3" required />
                                                <input type="number" name="up_contact" value="<?php echo $faculty_data['4']; ?>" placeholder="Enter Contact"
                                                class="form-control mb-3" required />
                                                <small class="form-text text-muted w-2/3 m-auto p-2 outline-none">Keep the password field blank if you don't
                                                want to
                                                change the password.</small>
                                                <input type=" password" name="up_password" placeholder="********* " 
                                                class="form-control mb-3"
                                                 />
                                                <input type="password" name="up_confirm_password" placeholder=" Conform Password "
                                                class="form-control mb-3"  />                                               
                                               </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer">
                                                    <button name="update" class="btn" style="color:white;background: rgb(127, 29 ,29)">
                                                        <span class="glyphicon glyphicon-edit"></span> Update</button>
                                                    <button class="btn btn-secondary" type="submit" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
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
                     <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Add Faculty</h6>
                     <div class="card-body">
                         <div class="">
                             <form method="post" action="faculty.php">
                                  <!-- <label for="name" class="">Room Name :</label> -->
                                <!-- <input type="text" name="name" placeholder="Enter Username " class="form-control mb-3" required /> -->
                              
                                <input type="text" name="name" placeholder="Enter Username " class="form-control mb-3" required />

                                <input type="hidden" name="dept" value="<?php echo $_SESSION['department']; ?>" class="p-2" />
                                <input type="email" name="email" placeholder="Enter Email" class="form-control mb-3" required />
                                <input type="number" name="contact" placeholder="Enter Contact" class="form-control mb-3"
                                    required />
                                <input type="hidden" name="role" value="Supervisor" placeholder=" Enter Password "
                                    class="w-2/3 m-auto p-2 outline-none" required />
                                <input type="password" name="password" placeholder="  Password " class="form-control mb-3"
                                    required />
                                <input type="password" name="confirm_password" placeholder=" Conform Password "
                                class="form-control mb-3" required />

                                <button type="submit" name="signup-btn"
                                class="btn mt-4" style="color:white;background: rgb(127, 29 ,29)">
                                Add </button>
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