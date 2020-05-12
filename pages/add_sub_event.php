<?php
ob_start();
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>


<?php
if (isset($_POST['del'])) {
    $id1 = $_POST['id1'];

    $query123 = "delete from tbl_subevent where esid='$id1'";

    mysqli_query($conn, $query123);
}
if (isset($_POST['up'])) {

    $usr = $_POST['id'];
    $typ=$_POST['et1'];

    $n = $_POST['etname'];




    $query2 = "update tbl_subevent set esname='$n',typ='$typ' where esid='$usr'";

    mysqli_query($conn, $query2);
    $_POST=NULL;
}
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sub Event</h1>
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
                                $sql = "SELECT * FROM tbl_event";
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <option value="None" selected="">None</option>

                                <?php
                                while ($row = mysqli_fetch_array($result)) {

                                    if (!empty($_SESSION['etid'])) {
                                        if (strcmp($_SESSION['etid'], $row['ename']) == 0) {
                                            ?>
                                            <option value="<?php echo $row['ename'] ?>" selected=""><?php echo $row['ename'] ?></option>


                                            <?php
                                            $_SESSION['etid'] = "";
                                        } else {
                                            ?>

                                            <option value="<?php echo $row['ename'] ?>"><?php echo $row['ename'] ?></option>

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="<?php echo $row['ename'] ?>"><?php echo $row['ename'] ?></option>

                                        <?php
                                    }
                                }
                                ?>  

                            </select>


                        </div>

                        <div class="form-group">
                            <label>Select Type :</label>
                            <select  name="etype" class="form-control">

                                <option value="Individual" selected="">Individual</option>
                                <option value="Group">Group</option>

                            </select>


                        </div>

                        <div class="form-group">
                            <label>Add Sub Event :</label>
                            <input type="text" name="ename" class="form-control" placeholder="Enter Name">
                        </div>

                        <button type="submit" name="su" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-success">Reset</button>

                        <?php
                        if (isset($_POST['su'])) {
                            if (!empty($_POST['ename'])) {

                                $name = $_POST['ename'];
                                $etid = $_POST['type'];
                                $etype = $_POST['etype'];
                                $q1 = "insert into tbl_subevent (esname,ename,typ) values ('$name','$etid','$etype')";

                                mysqli_query($conn, $q1);
                                 echo "<script>swal('Added ', 'Successfully', 'success');</script>";
                                $_SESSION['etid'] = $_POST['type'];
                                header("Location:add_sub_event.php");
                                $_POST=NULL;
                                echo "<script>swal('Added ', 'Successfully', 'success');</script>";
                            } else {
                                echo "<script>swal('Error!.', 'All fields are required.!', 'error');</script>";
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
                    Sub Events
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>   

                                <th>Name</th>
                                <th>Sub Event</th>
                                <th>Type</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $nme = NULL;
                            $que = "select * from tbl_subevent";
                            $result = mysqli_query($conn, $que);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr class="gradeC" >

                                    </td>

                                    <td style="text-align: center">

                                        <?php echo "$row[2]" ?>
                                    </td>
                                    <td style="text-align: center"><?php echo "$row[1]" ?></td>
                                    <td style="text-align: center"><?php echo "$row[3]" ?></td>
                                    <td > 
                            <center>
                                <!-- /.panel-heading -->

                                <!-- Button trigger modal -->
                                <button class="btn btn-outline btn-primary btn-sm "   data-toggle="modal" data-target="#myModal<?php echo $count ?>">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?php echo $count ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                <td><label>Main event</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td>
                                                                    <fieldset disabled>
                                                                        <input type="text" id="disabledInput" class="form-control" value="<?php echo "$row[2]" ?>" name="etname"><br><br></td> 

                                                                        <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="id">
                                                                    </fieldset>
                                                            </div>

                                                            </tr>

                                                            <tr>
                                                            <div class="form-group">
                                                                <td><label>Event</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[1]" ?>" name="etname"><br><br></td> 

                                                            </div>

                                                            </tr>


                                                            <tr>
                                                                <?php
                                                                if ("$row[3]" == "Individual") {
                                                                    ?>
                                                                <div class="form-group">

                                                                    <td><label>Select Type</label><br><br></td>
                                                                    <td> <label>:&nbsp;</label><br><br></td>
                                                                    <td>
                                                                        <select style="width:100%"  name="et1" class="form-control">
                                                                            <option value="Individual" selected="">Individual</option>
                                                                            <option value="Group">Group</option>
                                                                        </select>
                                                                        <br><br></td> 
                                                                </div>
                                                                <?php
                                                            } else {
                                                                ?>

                                                                <div class="form-group">

                                                                    <td><label>Select Type</label><br><br></td>
                                                                    <td> <label>:&nbsp;</label><br><br></td>
                                                                    <td>
                                                                        <select style="width:100%"  name="et1" class="form-control">
                                                                            <option value="Individual" >Individual</option>
                                                                            <option value="Group" selected="">Group</option>
                                                                        </select>
                                                                        <br><br></td> 
                                                                </div>

                                                            <?php } ?>
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

<?php
require './footer.php';
ob_end_flush();
?>