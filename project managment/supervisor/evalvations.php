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
if (isset($_POST['evalvation_btn'])) {
    $evalvation = $_POST['evalvation'];
    $semester = $_POST['semester'];
    $description = $_POST['description'];
    $fyp = $_POST['fyp'];

    $query = "INSERT into evalvations_tbl (evalvation,semester,description,fyp)VALUES('$evalvation','$semester','$description','$fyp')";
    $run = mysqli_query($conn, $query);
    if ($run) {
?>
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Hi!</strong> Evaluation add Successfully
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
     <?php
                 header("Refresh:1; url=evalvations.php");
            }
        }
        ?>

     <!--================ Insertipion Code============= -->

     <!--================ Delete Code============= -->

     <?php
       if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
    
        $del_query = "DELETE from evalvations_tbl where evalvations_id='$del_id'";
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
                 header("Refresh:1; url=evalvations.php");
            }
        }
        ?>

     <!--================ Delete Code============= -->

     <!--================ Edit Code ================== -->

<?php
if (isset($_POST['update'])) :
    $up_evalvation = $_POST['up_evalvation'];
    $up_semester = $_POST['up_semester'];
    $up_description = $_POST['up_description'];
    $up_fyp = $_POST['up_fyp'];
    $id=$_POST['id'];

    $update_query = "UPDATE evalvations_tbl SET evalvation = '$up_evalvation',semester='$up_semester',description = '$up_description',fyp='$up_fyp'
     WHERE evalvations_id = '$id'";
    $run = mysqli_query($conn, $update_query); ?>
<div class="container">
    <?php if ($run) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Evalvations updated Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    header("Refresh:2; url=evalvations.php");
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
                     <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Evalvations</h6>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table class="table " id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr>
                                         <th>S no</th>
                                         <th>Evaluation</th>
                                         <th>Semester</th>
                                         <th>Description</th>
                                         <th>FYP</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <!---============Selection code ===========--->
                                                                <?php
                                $sno = 1;
                                $query = "SELECT * from evalvations_tbl";
                                $run = mysqli_query($conn, $query);
                                while ($evalvation_data = mysqli_fetch_array($run)) {
                                ?>
                                     <tr>
                                         <td><?php echo $sno++; ?></td>
                                         <td><?php echo $evalvation_data['1'] ?></td>
                                         <td> <?php echo $evalvation_data['2'] ?></td>
                                         <td><?php echo $evalvation_data['3'] ?></td>
                                         <td> <?php echo $evalvation_data['4'] ?></td>
                                         
                                         <td><button class="btn btn-success btn-circle" data-toggle="modal" type="button" 
					                       data-target="#update_modal<?php echo $evalvation_data['evalvations_id']?>">
                                           <span class="glyphicon glyphicon-edit"></span> <i class='fa fa-edit'></i></button>
                                             <a href="evalvations.php?del_id=<?php echo $evalvation_data['0']  ?>" class="btn btn-danger btn-circle "><i
                                                     class="fa fa-trash"></i></a>
                                         </td>
                                     </tr>

                                    <!--==== Modal Start ====-->

                                <div class="modal fade" id="update_modal<?php echo $evalvation_data['evalvations_id']?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="evalvations.php">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" style="color: rgb(127, 29 ,29)"><b>Update Evalvations</b></h4>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $evalvation_data['0'] ?>">
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                    <label for="name" class="">Evalvation :</label>                  
                                                <select name="up_evalvation" id="" class='form-control'>
                                                    <option value="<?php echo $evalvation_data['1'] ?>"><?php echo $evalvation_data['1'] ?></option>
                                                    <option value="Evaluation1">Evaluation1</option>
                                                    <option value="Evaluation2">Evaluation2</option>
                                                </select>
                                                <label for="date">Semester :</label>
                                                <select name="up_semester" id="" class='form-control'>
                                                    <option value="<?php echo $evalvation_data['2'] ?>"><?php echo $evalvation_data['2'] ?></option>
                                                    <option value="Fall 2020">Fall 2020</option>
                                                    <option value="Spring 2020">Spring 2020</option>
                                                    <option value="Fall 2021">Fall 2021</option>
                                                    <option value="Spring 2021">Spring 2021</option>
                                                    <option value="Fall 2022">Fall 2022</option>
                                                    <option value="Spring 2022">Spring 2022</option>
                                                    <option value="Fall 2023">Fall 2023</option>
                                                    <option value="Spring 2023">Spring 2023</option> 
                                                </select>
                                                <label for="date">Description :</label>
                                                <textarea name="up_description" id="" cols="30" rows="4" placeholder=' Enter Description' class='form-control'>
                                                <?php echo $evalvation_data['3'] ?>
                                                </textarea>
                                                <div class='flex justify-center items-center'>
                                                    <input type="radio" id="fyp1"  name="up_fyp" value="FYP 1">
                                                    <label for="fyp1" class='px-2 font-semibold text-gray-600'> FYP 1</label>
                                                    <input type="radio" id="fyp2" name="up_fyp"value="FYP 2">
                                                    <label for="fyp2" class='px-2 font-semibold text-gray-600'> FYP 2</label>
                                                    </div>

                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer">
                                                    <button name="update" style="color:white;background: rgb(127, 29 ,29)" class="btn"><span class="glyphicon glyphicon-edit"></span> Update</button>
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
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
                     <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">Add Evalvations</h6>
                     <div class="card-body">
                         <div class="">
                             <form method="post" action="evalvations.php">
                                 <label for="name" class="">Evalvation :</label>                  
                                <select name="evalvation" id="" class='form-control'>
                                    <option value="Select" disabled> Select Evaluatoins</option>
                                    <option value="Evaluation1">Evaluation1</option>
                                    <option value="Evaluation2">Evaluation2</option>
                                </select>
                                 <label for="date">Semester :</label>
                                <select name="semester" id="" class='form-control'>
                                    <option value="Select" > Select Semester</option>
                                    <option value="Fall 2020">Fall 2020</option>
                                    <option value="Spring 2020">Spring 2020</option>
                                    <option value="Fall 2021">Fall 2021</option>
                                    <option value="Spring 2021">Spring 2021</option>
                                    <option value="Fall 2022">Fall 2022</option>
                                    <option value="Spring 2022">Spring 2022</option>
                                    <option value="Fall 2023">Fall 2023</option>
                                    <option value="Spring 2023">Spring 2023</option> 
                                </select>
                                <label for="date">Description :</label>
                                <textarea name="description" id="" cols="30" rows="4" placeholder=' Enter Description' class='form-control'></textarea>
                                <div class='flex justify-center items-center'>
                                    <input type="radio" id="fyp1" name="fyp" value="FYP 1">
                                    <label for="fyp1" class='px-2 font-semibold text-gray-600'> FYP 1</label>
                                    <input type="radio" id="fyp2" name="fyp" value="FYP 2">
                                    <label for="fyp2" class='px-2 font-semibold text-gray-600'> FYP 2</label>
                                </div>
                                 <button class="btn btn mt-4"style="color:white;background: rgb(127, 29 ,29)" name="evalvation_btn">
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