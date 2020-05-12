<?php
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>


<?php
if (isset($_POST['del'])) {
    $id1 = $_POST['id1'];

    $query123 = "delete from tbl_event_detail where edid='$id1'";

    mysqli_query($conn, $query123);
}
if (isset($_POST['up'])) {

    $usr = $_POST['id'];



    $r2 = $_POST['r2'];
    $r3 = $_POST['r3'];
    $r4 = $_POST['r4'];
    $r5 = $_POST['r5'];


    $query2 = "update tbl_event_detail set date='$r2',edate='$r3',venue='$r4',discr='$r5' where edid='$usr'";

    mysqli_query($conn, $query2);
    $_POST=NULL;
}
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Event Detail</h1>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group">
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <form  role="form" method="post">


                        <div class="form-group">
                            <label>Select Event :</label>
                            <select name="type" class="form-control">
                                <?php
                                $sql = "SELECT * FROM tbl_subevent";
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <option value="None" selected="">None</option>

                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>

                                    <option value="<?php echo $row['esname'] ?>"><?php echo $row['esname'] ?></option>

                                    <?php
                                }
                                ?>  

                            </select>


                        </div>


                        <div class="form-group">
                            <label>Event Date :</label>
                            <input type="date" name="edate" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>End Date :</label>
                            <input type="date" name="etime" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Select Venue :</label>
                            <select name="evenue" class="form-control">
                                <?php
                                $s = "SELECT * FROM tbl_venue";
                                $r = mysqli_query($conn, $s);
                                ?>
                                <option value="None" selected="">None</option>

                                <?php
                                while ($row = mysqli_fetch_array($r)) {
                                    ?>

                                    <option value="<?php echo $row['vname'] ?>"><?php echo $row['vname'] ?></option>

                                    <?php
                                }
                                ?>  

                            </select>


                        </div>

                        <div class="form-group">
                            <label>Description :</label>
                            <textarea class="form-control" rows="3" name="descr" placeholder="Give Description"></textarea>
                        </div> 

                        <button type="submit" name="su" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-success">Reset</button>

                        <?php
                        if (isset($_POST['su'])) {

                            $edate = $_POST['edate'];
                            $etime = $_POST['etime'];
                            $evenue = $_POST['evenue'];
                            $esid = $_POST['type'];
                            $dis = $_POST['descr'];

                            if (!empty($edate) && !empty($etime) && !empty($evenue) && !empty($esid) && !empty($dis)) {
                                $q1 = "insert into tbl_event_detail (esname,date,edate,venue,discr) values ('$esid','$edate','$etime','$evenue','$dis')";
                                mysqli_query($conn, $q1);
                                $_POST=NULL;
                                echo "<script>swal('Added ', 'Successfully', 'success');</script>";
                            } else {
                                echo "<script>alert('Error In Inserting Data.Remember all fields are required.')</script>";
                            }
                        }
                        ?>

                    </form>
                </div>
                <!-- /.col-lg-6 (nested) -->

                <!-- /.col-lg-6 (nested) -->
            </div>
            <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Event Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>   
                                <th>Event</th>
                                <th>Date</th>
                                <th>End Date</th>
                                <th>venue</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $nme = NULL;
                            $que = "select * from tbl_event_detail";
                            $result = mysqli_query($conn, $que);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr class="gradeC" >



                                    <td style="text-align: center"><?php echo "$row[1]" ?></td>
                                    <td style="text-align: center"><?php echo "$row[2]" ?></td>
                                    <td style="text-align: center"><?php echo "$row[3]" ?></td>
                                    <td style="text-align: center"><?php echo "$row[4]" ?></td>
                                    <td style="text-align: center"><?php echo "$row[5]" ?></td>
                                    <td > 
                            <center>
                                <!-- /.panel-heading -->

                                <!-- Button trigger modal -->
                                <button class="btn btn-outline btn-primary btn-sm "   data-toggle="modal" data-target="#myModal<?php echo $count ?>">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?php echo $count ?>" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                                            </div>
                                            <div class="modal-body">


                                                <form  role="form" method="post">
                                                    <center>
                                                        <table >

                                                            <tr>
                                                            <div class="form-group">
                                                                <td><label>Name</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td>
                                                                    <fieldset disabled>
                                                                        <input type="text" id="disabledInput" class="form-control" value="<?php echo "$row[1]" ?>" name="r1"><br><br></td> 

                                                                        <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="id">
                                                                    </fieldset>
                                                            </div>

                                                            </tr>

                                                            <tr>
                                                            <div class="form-group">
                                                                <td><label>Date</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input style="width:100%" type="date" class="form-control" value="<?php echo "$row[2]" ?>" name="r2"><br><br></td> 

                                                            </div>

                                                            </tr>

                                                            </tr>

                                                            <tr>
                                                            <div class="form-group">
                                                                <td><label>End Date</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input style="width:100%" type="date" class="form-control" value="<?php echo "$row[3]" ?>" name="r3"><br><br></td> 

                                                            </div>

                                                            </tr>

                                                            </tr>

                                                            <tr>
                                                            <div class="form-group">
                                                                <td><label>Venue</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[4]" ?>" name="r4"><br><br></td> 

                                                            </div>

                                                            </tr>


                                                            <tr>
                                                            <div class="form-group">
                                                                <td><label>Description</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><textarea style="width:100%" class="form-control" rows="3" name="r5" ><?php echo "$row[5]" ?></textarea><br><br></td> 

                                                            </div>

                                                            </tr>


                                                        </table>
                                                    </center>


                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" name="up" class="btn btn-primary">Update</button>

                                            </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                            </center>
                            </td>
                            <td>
                            <center>
                                <form role="form" method="post">

                                    <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="id1">
                                    <button type="submit" name="del" class="btn btn-outline btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        Delete</button>
                                </form>
                            </center>
                            </td>

                            </tr>

                            <?php
                            $count++;
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div> 




</div>

<?php require './footer.php'; ?>