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
    
   
    $qur11 = "update tbl_student_detail set status='Deactive' where uid='$usr'";
   mysqli_query($conn, $qur11) ;
 $_POST=NULL;
}

if ( isset($_POST['status1'])) 
{
    $usr = $_POST['stud'];
    $st= $_POST['st'];
    
    
    $qur1 = "update tbl_student_detail set status='Active' where uid='$usr'";
    
   mysqli_query($conn, $qur1);
   $_POST=NULL;
}


if (isset($_POST['del'])) {
    $usr = $_POST['s_usrid'];
    $quer1 = "delete from tbl_user where uid='$usr'";
    $quer2 = "delete from tbl_student_detail  where uid='$usr'";
    mysqli_query($conn, $quer1);
    mysqli_query($conn, $quer2);
}
if (isset($_POST['up'])) {

    $usr = $_POST['s_userid'];

    $s_eno = $_POST['s_eno'];
    $s_name = $_POST['s_name'];
    $s_address = $_POST['s_address'];
    $s_contact = $_POST['s_contact'];
    $s_email = $_POST['s_email'];
    $s_jyear = substr($s_eno, 0, 4);


    $query1 = "update tbl_user set username='$s_eno' where uid=$usr";
    $query2 = "update tbl_student_detail set enrollment_no='$s_eno',s_name='$s_name',s_address='$s_address',s_contact='$s_contact',s_email='$s_email',year='$s_jyear' where uid='$usr'";
    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Student Details</h1>
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
                        //    alert("Index: " + y[x].index + " is " + y[x].text);
                        if (y[x].index === 1)
                        {
                            document.write('<div class="form-group"><label>File input</label><br><input type="file"><br></div>');
                            
                            document.location.replace('./csv_student.php');
                            
                        } else if (y[x].index === 0)
                        {
                            document.location.replace('./Add_student.php');
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
                            <label>Enrollment No :</label>
                            <input type="text" placeholder="Enter Enrollment No" name="eno" class="form-control">     
                        </div>
                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label>E-mail :</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter E-mail Address">
                        </div>
                        <div class="form-group">
                            <label>Contact No :</label>
                            <input type="text" class="form-control" name="contact" placeholder="Enter Contact No">
                        </div>

                        <div class="form-group">
                            <label>Address :</label>
                            <textarea class="form-control" rows="3" name="address" placeholder="Enter Address"></textarea>
                        </div>                                       


                        <button type="submit" name="sub" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-success">Reset</button>

                        <?php
                        if (isset($_POST['sub'])) {

                            $eno = $_POST['eno'];
                            $name = $_POST['name'];
                            $name= ucwords($name);
                            $email = $_POST['email'];
                            $contact = $_POST['contact'];
                            $address = $_POST['address'];
                            $passwd = "qwerty";
                            $year = substr($eno, 0, 4);
                            $utype = "1";
                            if (!empty($eno) && !empty($name) && !empty($email) && !empty($contact) && !empty($address)) {
                                $sql = "select * from tbl_student_detail where enrollment_no='$eno'";
                                $rs = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($rs) > 0) {
                                    echo "<script>swal('Opps.!', 'User already exist.!', 'error');</script>";
                                } else {


                                    $q = "insert into tbl_user (username,password,u_type) values ('$eno','$passwd','$utype'); ";
                                    $q1 = "insert into tbl_student_detail (enrollment_no,s_name,s_address,s_contact,s_email,year,uid,status) values ('$eno','$name','$address','$contact','$email','$year',LAST_INSERT_ID(),'Active')";
                                    mysqli_query($conn, $q);
                                    mysqli_query($conn, $q1);
                                    
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
                    Student Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Enrollment No</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>E-mail</th>
                                
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $temp = NULL;
                            $que = "select * from tbl_student_detail";
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
                                                                <td><label>Enrollment No</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[1]" ?>" name="s_eno"><br><br></td> 
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td> <label>Name </label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td> <input type="text" class="form-control" value="<?php echo "$row[2]" ?>" name="s_name"><br><br></td>
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td> <label>Address</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td>  <input type="text" class="form-control" value="<?php echo "$row[3]" ?>" name="s_address"><br><br></td>
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td> <label>Contact No</label><br><br></td>
                                                                <td> <label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[4]" ?>" name="s_contact"><br><br></td>
                                                            </div>

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td> <label>E-mail</label><br><br></td>
                                                                <td><label>:&nbsp;</label><br><br></td>
                                                                <td><input type="text" class="form-control" value="<?php echo "$row[5]" ?>" name="s_email" ><br><br></td>
                                                            </div>  

                                                            </tr>
                                                            <tr>

                                                            <div class="form-group">
                                                                <td><label>Joining Year</label><br><br></td>
                                                                <td><label>:&nbsp;</label><br><br></td>

                                                                <td>
                                                                    <fieldset disabled="">
                                                                        <input type="text" class="form-control" value="<?php echo "$row[6]" ?> " name="s_jyear"><br><br>
                                                                    </fieldset>
                                                                </td>

                                                                <input type="hidden" class="form-control" value="<?php echo "$row[7]" ?> " name="s_userid">
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

                                    <input type="hidden" class="form-control" value="<?php echo "$row[7]" ?> " name="s_usrid">
                                    <button type="submit" name="del" class="btn btn-outline btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        Delete</button>
                                </form>
                            </center>        
                            </td>

                            
                             <td>
                            <center>
                                <form role="form" method="post">
                                    <?php if($row[8]=="Active"){?>
                                    <input type="hidden" class="form-control" value="<?php echo "$row[7]" ?> " name="stud">
                                    <input type="hidden" class="form-control" value="<?php echo "$row[8]" ?> " name="st">
                                    <button type="submit" name="status" class="btn btn-outline btn-success btn-sm">
                                        Active</button>
                                    <?php }?>
                                    <?php if($row[8]=="Deactive"){?>
                                    <input type="hidden" class="form-control" value="<?php echo "$row[7]" ?> " name="stud">
                                     <input type="hidden" class="form-control" value="<?php echo "$row[8]" ?> " name="st">
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