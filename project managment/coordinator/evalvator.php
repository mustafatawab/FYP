<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
 $dept = $_SESSION['department'];
?>
 <!-- Begin Page Content -->
 <div class="container-fluid">
     <!--================ Update ============= -->
     <?php
if(isset($_GET['status_id'])){
  
    $id = $_GET['status_id'];
    $n =mysqli_query($conn,"SELECT * from faculty_tbl where faculty_id='$id'");
    $data= mysqli_fetch_array($n);
    $status =$data['status'];

    if($status==0){
        $run = mysqli_query($conn,"UPDATE faculty_tbl SET status='1' where faculty_id='$id'");
        if($run){
            ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Accept  Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
            <?php
        }
    }
    if($status==1){
        $run = mysqli_query($conn,"UPDATE faculty_tbl SET status='2' where faculty_id='$id'");
        if($run){
            ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Reject  Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
            <?php
        }
    }
    if($status==2){
        $run = mysqli_query($conn,"UPDATE faculty_tbl SET status='0' where faculty_id='$id'");
        if($run){
            ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Wow!</strong> Pending  Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
            <?php
        }
    }
}

?>



<!--================ Update Code End============= -->

     <div class="row">
         <div class="col-xl-12">
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold" style="color: rgb(127, 29 ,29)">All Evalvator</h6>
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
                                         <th>Evalvator Selection</th>
                                         
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
                                         <td> <?php $status = $faculty_data['status'];
                                         if($status==0){
                                            ?>
                                            <a href="evalvator.php?status_id=<?php echo $faculty_data['0']  ?>" class="btn btn-warning  ">
                                            Pending
                                        </a>
                                        <?php
                                         }
                                         if($status==1){?>
                                            <a href="evalvator.php?status_id=<?php echo $faculty_data['0']  ?>" class="btn btn-success  ">
                                            Evalvator
                                         </a>
                                        <?php
                                         }
                                         if($status==2){?>
                                            <a href="evalvator.php?status_id=<?php echo $faculty_data['0']  ?>" class="btn btn-danger  ">
                                            Reject
                                         </a>
                                        <?php
                                         }
                                         ?></td>
                                        
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