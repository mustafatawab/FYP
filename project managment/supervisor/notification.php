<?php
ob_start();
include('include/header.php');
include('include/navbar.php');
 $dept = $_SESSION['department'];
?>
 <!-- Begin Page Content -->
 <div class="container-fluid">



     <div class="row">
         <div class="col-xl-12">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold h4" style="color: rgb(127, 29 ,29)">All Notification</h6>
                                     <!---============Selection code ===========--->
                                                                <?php   
                                $query = "SELECT * from notification_tbl";
                                $run = mysqli_query($conn, $query);
                                while ($room_data = mysqli_fetch_array($run)) {
                                ?>
         <div class="row">
             <div class="col-xl-4">
                <div class="card shadow mb-4 ">
                     <div class="card-header    ">
                     <h6 class="m-0 font-weight-bold h5" style="color: rgb(127, 29 ,29)">Title: <?php echo $room_data['1'] ?>  <p class='float-right'><?php echo $room_data['3'] ?></p></h6>
                    </div>
                    <h6 class="m-0 font-weight-bold px-3" style="color: rgb(127, 29 ,29)">Description:</h6>
                     <div class="card-body">          
                            <p> <?php echo $room_data['2'] ?></p>
                                </div>   
                                </div>  
                         </div>
                     </div>               
                                     <?php
                                         }
                                        ?>  
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