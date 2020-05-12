<?php
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>
<?php

if (isset($_POST['status'])) 
{
    $usr = $_POST['stud'];
    $st= $_POST['st'];
    
   
    $qur11 = "update tbl_faculty_detail set status='Deactive' where fid='$usr'";
   mysqli_query($conn, $qur11) ;
 $_POST=NULL;
}

if ( isset($_POST['status1'])) 
{
    $usr = $_POST['stud'];
    $st= $_POST['st'];
    
    
    $qur1 = "update tbl_faculty_detail set status='Active' where fid='$usr'";
    
   mysqli_query($conn, $qur1);
   $_POST=NULL;
}




if (isset($_POST['del'])) {
    $usr = $_POST['s_usrid'];

    $query2 = "delete from tbl_faculty_detail  where fid='$usr'";

    mysqli_query($conn, $query2);
}
if (isset($_POST['up'])) {

    $usr = $_POST['s_userid'];


    $f_name = $_POST['f_name'];
    $f_address = $_POST['f_address'];
    $f_contact = $_POST['f_contact'];
    $f_email = $_POST['f_email'];
    $f_exp = $_POST['f_exp'];



    $query2 = "update tbl_faculty_detail set fname='$f_name',faddress='$f_address',fcontact='$f_contact',femail='$f_email',expertise='$f_exp' where fid='$usr'";

    mysqli_query($conn, $query2);
    $_POST=NULL;
}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Faculty Detail</h1>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group">
                <label>Input Mode</label>
                <select id="mySelect" class="form-control" onchange="myFunction()">
                    <option value="1" selected>Form</option>
                    <option value="2">CSV</option>
                </select>
                <script type="text/javascript">
                    function myFunction() {
                        var x = document.getElementById("mySelect").selectedIndex;
                        var y = document.getElementById("mySelect").options;
                        //alert("Index: " + y[x].index + " is " + y[x].text);
                        if (y[x].index === 1)
                        {
                            //    document.write('<div class="form-group"><label>File input</label><br><input type="file"><br></div>');

                            document.location.replace('./csv_faculty.php');

                        } else if (y[x].index === 0)
                        {
                            document.location.replace('./Add_faculty_detail.php');
                        }
                    }
                </script> 
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <form  role="form" method="post">

                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label>E-mail :</label>
                            <input type="email" name="femail" class="form-control" placeholder="Enter E-mail Address">
                        </div>
                        <div class="form-group">
                            <label>Contact No :</label>
                            <input type="number" minlength="10" maxlength="10" name="fcontact" class="form-control" placeholder="Enter Contact No">
                        </div>

                        <div class="form-group">
                            <label>Address :</label>
                            <textarea class="form-control" name="faddress" rows="3" placeholder="Enter Address"></textarea>
                        </div>                                       
                        <div class="form-group">
                            <label>Area Of Interest :</label>
                            <input type="text" class="form-control" name="exp" placeholder="Enter Area Of Interest">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-success">Reset</button>

                        <?php
                        if (isset($_POST['submit'])) {

                            $name = $_POST['fname'];
                            $name= ucwords($name);
                            $email = $_POST['femail'];
                            $contact = $_POST['fcontact'];
                            $address = $_POST['faddress'];
                            $exp = $_POST['exp'];

                            if (!empty($name) && !empty($email) && !empty($contact) && !empty($address) && !empty($exp)) {
                                $sql = "select * from tbl_faculty_detail where femail='$email'";
                                $rs = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($rs) > 0) {
                                    echo "<script>swal('Opps.!', 'User already exist.!', 'error');</script>";
                                } else {

                                    $qu1 = "insert into tbl_faculty_detail (fname,faddress,fcontact,femail,expertise,status) values ('$name','$address','$contact','$email','$exp','Active')";

                                    mysqli_query($conn, $qu1);
                                    $_POST=NULL;
                                    echo "<script>swal('Added ', 'Successfully', 'success');</script>";
                                }
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
                    Faculty Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>

                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>E-mail</th>
                                <th>Expertise</th>
                                <td>Edit</td>
                                <td>Delete</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $que = "select * from tbl_faculty_detail";
                            $result = mysqli_query($conn, $que);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr class="gradeC">
                                    <td><?php echo "$row[1]" ?></td>
                                    <td><?php echo "$row[2]" ?></td>
                                    <td><?php echo "$row[3]" ?></td>
                                    <td><?php echo "$row[4]" ?></td>
                                    <td><?php echo "$row[5]" ?></td>


                                    <td> 
                            <center>
                                <!-- Button trigger modal -->
                                <button class="btn btn-outline btn-primary btn-sm " data-toggle="modal" data-target="#myModal<?php echo $count ?>">
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
                                                                <td><label>Name</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[1]" ?>" name="f_name"><br><br></td> 
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td> <label>Address </label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td> <input type="text" class="form-control" value="<?php echo "$row[2]" ?>" name="f_address"><br><br></td>
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td> <label>Contact No</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td>  <input type="text" class="form-control" value="<?php echo "$row[3]" ?>" name="f_contact"><br><br></td>
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td> <label>E-mail</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[4]" ?>" name="f_email"><br><br></td>
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td><label>Area of Interest</label><br><br></td>
                                                                <td><label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[5]" ?> " name="f_exp"><br><br></td>
                                                                <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="s_userid">
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
                                <form role="form" method="post">

                                    <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="s_usrid">
                                    <button type="submit" name="del" class="btn btn-outline btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        Delete</button>
                                </form>
                            </td>
                            <td>
                                
                                <center>
                                <form role="form" method="post">
                                    <?php if($row[6]=="Active"){?>
                                    <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="stud">
                                    <input type="hidden" class="form-control" value="<?php echo "$row[6]" ?> " name="st">
                                    <button type="submit" name="status" class="btn btn-outline btn-success btn-sm">
                                        Active</button>
                                    <?php }?>
                                    <?php if($row[6]=="Deactive"){?>
                                    <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="stud">
                                     <input type="hidden" class="form-control" value="<?php echo "$row[6]" ?> " name="st">
                                    <button type="submit" name="status1" class="btn btn-outline btn-danger btn-sm">
                                        Deactive</button>
                                    <?php }?>
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