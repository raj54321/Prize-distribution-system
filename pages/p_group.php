<?php
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>

<?php
if (isset($_POST['del'])) {
    $did = $_POST['did'];

    $query123 = "delete from tbl_participant_detail where pid='$did'";

    mysqli_query($conn, $query123);
}
if (isset($_POST['up'])) {

    $usr = $_POST['id'];
    $e = $_POST['ddevent'];
    
    $query2 = "update tbl_participant_detail set e_name='$e' where pid='$usr'";

    mysqli_query($conn, $query2);
    $_POST=NULL;
}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Participant Detail</h1>
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
                    <form  action="p_group.php" role="form" method="post">

                        <div class="form-group">
                            <label>No Of Participant :</label>
                            <input type="number" min="2" name="no" class="form-control" >
                        </div>

                        <button type="submit" name="p_number" class="btn btn-primary">Next</button>

                        <?php
                        if (isset($_POST['p_number'])) {
                            if ($_POST['no'] == NULL) {
                                $no = 2;
                            } else {
                                $no = $_POST['no'];
                            }
                            ?>
                            <div class="form-group">
                                <br>
                                <label>Event :</label>
                                <select name="event" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM tbl_subevent where typ='Group'";
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
                                <label>Captain/Leader :</label>
                                <select name="caption" class="form-control">
                                    <?php
                                    $sql1 = "SELECT * FROM tbl_student_detail where status='Active'";
                                    $result1 = mysqli_query($conn, $sql1);
                                    ?>
                                    <option value="None" selected="">None</option>
                                    <?php
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        ?>
                                        <option value="<?php echo $row1['enrollment_no'] ?>"><?php
                                            echo $row1['enrollment_no'];
                                            echo " (" . $row1['s_name'] . ")";
                                            ?></option>
                                        <?php
                                    }
                                    ?>  
                                </select>

                            </div>  
                            <div class="form-group"><label>Team Members :</label></div>
                            <?php
                            for ($i = 0; $i < $no - 1; $i++) {
                                ?>
                                <div class="form-group">

                                    <select name="mem[]" class="form-control">
                                        <?php
                                        $sql1 = "SELECT * FROM tbl_student_detail where status='Active'";
                                        $result1 = mysqli_query($conn, $sql1);
                                        ?>
                                        <option value="None" selected="">None</option>
                                        <?php
                                        while ($row1 = mysqli_fetch_array($result1)) {
                                            ?>
                                            <option value="<?php echo $row1['enrollment_no'] ?>"><?php
                                                echo $row1['enrollment_no'];
                                                echo " (" . $row1['s_name'] . ")";
                                                ?></option>
                                            <?php
                                        }
                                        ?>  
                                    </select>
                                </div>  
                            <?php }
                            ?>

                            <button type="submit" name="su" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-success">Reset</button>                  
                            <?php
                        }
                        ?>


                        <?php
//                        if (isset($_POST['su'])) {
//
//                            $pevent = $_POST['event'];
//                            $peno = $_POST['student'];
//
//
//                            if ($pevent == "None" || $peno == "None") {
//                                echo "<script>alert('Error In Inserting Data.Remember all fields are required.')</script>";
//                            } else {
//                                $q1 = "insert into tbl_participant_detail (e_name,p_eno) values ('$pevent','$peno')";
//                                mysqli_query($conn, $q1);
//                                echo "<script>swal('Added ', 'Successfully', 'success');</script>";
//                            }
//                        }
                        ?>



                        <?php
                        if (isset($_POST['su'])) {

                            $ev = $_POST['event'];
                            $cp = $_POST['caption'];
                            $c=1;

                            if($ev=="None" || $cp=="None")
                            {
                                 echo "<script>swal('Error.!', 'All fields are required', 'error');</script>";    
                            }
                                
                                else{
                                    
                                    
                                  
                            $q1 = "insert into tbl_participant_detail (e_name,p_eno) values ('$ev','$cp')";
                            mysqli_query($conn, $q1);

                            //$temp = array();
                            foreach ($_POST['mem'] as $i) {
                                //$temp[] = $i;

                                $q12 = "insert into tbl_participant_detail (e_name,p_eno,parent_id) values ('$ev','$i',LAST_INSERT_ID())";
                                mysqli_query($conn, $q12);
                                
                            }
                         
                            $_POST=NULL;//print_r($temp);
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
                    Participant Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>   

                                <th>Enrollment No</th>
                                <th>Event</th>
<!--                                <th>Name</th>-->
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $nme = NULL;
                            $que = "select * from tbl_participant_detail";
                            $result12 = mysqli_query($conn, $que);
                            
                            while ($row = mysqli_fetch_array($result12)) {
                                ?>
                                <tr class="gradeC" >

                                    <td style="text-align: center"><?php echo "$row[1]" ?></td>
                                    <td style="text-align: center"><?php echo "$row[2]" ?></td> 
    <!--                                    <td style="text-align: center"><?php //echo "$row[3]"     ?></td>-->

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
                                                                <td><label>Enrollment No</label><br><br></td>
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
                                                                <td><label>Select Event</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>

                                                                <td> 
                                                                    <input type="hidden"  value="<?php echo "$row[0]" ?> " name="id">
                                                                    <select style="width:100%" name="ddevent" class="form-control"  >
                                                                        <?php
                                                                        $sql34 = "SELECT * FROM tbl_subevent where typ='Individual'";
                                                                        $rlt1 = mysqli_query($conn, $sql34);
                                                                        ?>
                                                                        <option value="<?php echo $row[2] ?>" selected=""><?php echo $row[2] ?></option>
                                                                        <?php
                                                                        while ($rw123 = mysqli_fetch_array($rlt1)) {
                                                                            ?>

                                                                            <option value="<?php echo $rw123['esname'] ?>" ><?php echo $rw123['esname'] ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>  
                                                                    </select><br><br></td>
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

                                    <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="did">
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