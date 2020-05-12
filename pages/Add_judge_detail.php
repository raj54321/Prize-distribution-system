<?php
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>


<?php
if (isset($_POST['del'])) {
    $id1 = $_POST['id1'];

    $query123 = "delete from tbl_judge_detail where jid='$id1'";

    mysqli_query($conn, $query123);
}
if (isset($_POST['up'])) {

    $usr = $_POST['id'];

    $jn = $_POST['j_name'];
    $en = $_POST['e_name1'];





    $query2 = "update tbl_judge_detail set jname='$jn',ename='$en' where jid='$usr'";

    mysqli_query($conn, $query2);
    $_POST=NULL;
}
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Judge Detail</h1>
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
                            <label>Select Judge :</label>
                            <select name="jname" class="form-control" onchange="fn()" >
                                <?php
                                $sql = "SELECT * FROM tbl_faculty_detail where status='Active'";
                                $rslt = mysqli_query($conn, $sql);
                                ?>
                                <option value="None" >None</option>
                                <?php
                                while ($row = mysqli_fetch_array($rslt)) {
                                    ?>

                                    <option value="<?php echo $row['fname'] ?>" ><?php echo $row['fname'] ?></option>

                                    <?php
                                }
                                ?>  
                            </select>
                        </div>

                        <!--                        <fieldset disabled="">
                                                    <div class="form-group">
                                                        <label>Area Of Interest :</label>
                                                        <script type="text/javascript">
                                                            function fn() {
                        
                                                                var x = document.getElementById("jname").selectedIndex;
                                                                var y = document.getElementById("jname").options;
                                                                alert("Index: " + y[x].index + " is " + y[x].text);
                                                            }
                                                        </script>
                        <?php
//
//                                
//                                    $f = $_POST['jname'];
//
//                                    $sql11 = "SELECT * FROM tbl_faculty_detail where fname='$f'";
//                                    $rslt1 = mysqli_query($conn, $sql11);
//                                    while ($row1 = mysqli_fetch_array($rslt1)) {
//                                        $tmp = $row1[5];
//                                    }
//                              
                        ?>  
                        
                                                        <input type="text" value="<?php ?>" name="fcontact" class="form-control" >
                                                    </div>
                                                </fieldset>-->

                        <div class="form-group">
                            <label>Select Event :</label>
                            <select name="ename" class="form-control">
                                <?php
                                $sql = "SELECT * FROM tbl_subevent";
                                $result23 = mysqli_query($conn, $sql);
                                ?>
                                <option value="None" >None</option>
                                <?php
                                while ($row = mysqli_fetch_array($result23)) {
                                    ?>

                                    <option value="<?php echo $row['esname'] ?>"><?php echo $row['esname'] ?></option>

                                    <?php
                                }
                                ?>  
                            </select>
                        </div>      

                        <button type="submit" name="su" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-success">Reset</button>

                        <?php
                        if (isset($_POST['su'])) {


                            $jname = $_POST['jname'];
                            $ename = $_POST['ename'];

                            if ($jname == "None" || $ename == "None") {
                                echo "<script>swal('Error!.', 'All fields are required.!', 'error');</script>";
                            } else {
                                $q1 = "insert into tbl_judge_detail (jname,ename) values ('$jname','$ename')";

                                mysqli_query($conn, $q1);
                                $_POST=NULL;
                                echo "<script>swal('Added ', 'Successfully', 'success');</script>";
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
                    Judge Detail
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>   

                                <th>Name</th>
                                <th>Event</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $nme = NULL;
                            $que = "select * from tbl_judge_detail";
                            $result = mysqli_query($conn, $que);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr class="gradeC" >



                                    <td style="text-align: center"><?php echo "$row[1]" ?></td>
                                    <td style="text-align: center"><?php echo "$row[2]" ?></td>
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
                                                                <td><label>Select Judge</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td> <select style="width:100%" name="j_name" class="form-control"  >
                                                                        <?php
                                                                        $sql123 = "SELECT * FROM tbl_faculty_detail";
                                                                        $rslt1 = mysqli_query($conn, $sql123);
                                                                        ?>
                                                                        <option value="<?php echo $row[1] ?>" selected=""><?php echo $row[1] ?></option>
                                                                        <?php
                                                                        while ($row123 = mysqli_fetch_array($rslt1)) {
                                                                            ?>

                                                                            <option value="<?php echo $row123['fname'] ?>" ><?php echo $row123['fname'] ?></option>

                                                                            <?php
                                                                        }
                                                                        ?>  
                                                                    </select><br><br></td>
                                                            </div>

                                                            </tr>

                                                            <tr>
                                                            <div class="form-group">
                                                                <td><label>Select Event</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>

                                                                <td> 
                                                                    <input type="hidden"  value="<?php echo "$row[0]" ?> " name="id">
                                                                    <select style="width:100%" name="e_name1" class="form-control"  >
                                                                        <?php
                                                                        $sql34 = "SELECT * FROM tbl_subevent";
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

                                    <input type="hidden"  value="<?php echo "$row[0]" ?> " name="id1">
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