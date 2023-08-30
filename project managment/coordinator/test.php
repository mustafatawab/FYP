<!--==== Modal Start ====-->

<div class="modal fade" id="update_modal<?php echo $panel_data['panel_id'] ?>" aria-hidden="true">
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
                        <input name='id' type="text" value='<?php echo $panel_data['0'] ?>'>
                        <label for="name" class="">Panel No :</label>
                        <input type="text" name="up_panel_no" placeholder="Panel Number" value="<?php echo $panel_data['panel_no'] ?>" class="form-control mb-2" />
                        <label for="name" class="">Room :</label>
                        <select name="up_room" id="" required class="form-control mb-2">
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
                        <select name="up_evaluator" id="" required class="form-control mb-2">
                            <option value="<?php echo $panel_data['3'] ?>">
                                <?php echo $panel_data['3'] ?></option>
                            <?php
                            $room_select_query = "SELECT * FROM evaluator_tbl where dept='$dept'";
                            $room_res = mysqli_query($conn, $room_select_query);
                            while ($room = mysqli_fetch_array($room_res)) : ?>
                                <option value="<?php echo $room['evaluator_name'] ?>">
                                    <?php echo $room['evaluator_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                        <label for="name" class="">Evaluatoions :</label>
                        <select name="up_evaluation" id="" required class="form-control mb-2">
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
                    <button name="update" style="color:white;background: rgb(127, 29 ,29)" class="btn"><span class="glyphicon glyphicon-edit"></span>
                        Update</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>
                        Close</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<!-- model end -->