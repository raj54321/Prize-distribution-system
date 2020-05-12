<?php
require './session_admin.php';
require './connection.php';
require './header.php';
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a  class="navbar-brand" href="index.php"><span ><img src="../logo.png" style=" height:30px; width:30px " alt="logo"/></span> BMIIT PDS</a>
    </div>
    <!-- /.navbar-header -->

   
    <!-- /.navbar-top-links -->

      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                </li>
                



                <li>
                    <a href="#">Master Entry<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        
                        <li>
                            <a href="Add_student.php">Student</a>
                        </li>
                        <li>
                            <a href="csv_faculty.php"></i>Faculty</a>
                        </li>
                        <li>
                            <a href="Add_new_venue.php">New Venue</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                
                <li>
                    <a href="#">Event<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="add_event_type.php">Event Type</a>
                        </li>
                        <li>
                            <a href="add_main_event.php">Main Event</a>
                        </li>
                        <li>
                            <a href="add_sub_event.php">Sub Event</a>
                        </li>
                        <li>
                            <a href="add_event_detail.php">Event Detail</a>
                        </li>
                        <li>
                    <a href="Add_judge_detail.php">Judge Detail</a>
                </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="#">Participant<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="p_individual.php">Individual</a>
                        </li>
<!--
                        <li>
                            <a href="p_group.php">Group</a>
                        </li>-->
                    </ul>
                    </li>
                    <!-- /.nav-second-level -->
               
                    <li>
                    <a href="#">Achievers<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="winner.php">Winners</a>
                        </li>

                        <li>
                            <a href="runner-up.php">Runner-up</a>
                        </li>
                         <li>
                             <a href="topper_entry.php">Topper</a>
                        </li>
                    </ul>
                    </li>
                    
                    
                
<li>
    <a href="change_pwd.php">Change Password</a>
                </li>

                <li>
                    <a href="logout.php">Logout</a>
                </li>
                
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Faculty Details</h1>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group">
                <label>Input Mode</label>
                <select id="mySelect" class="form-control" onchange="myFunction()">
                    <option value="1">Form</option>
                    <option value="2" selected>CSV</option>
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
                    <?php
                    $connect = mysqli_connect("localhost", "root", "", "pds_db");
                    
                    if (isset($_POST["import"])) {
                        try {

                            $xy = explode(".", $_FILES["excel"]["name"]);
                            $extension = end($xy); // For getting Extension of selected file
                            $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
                            if (in_array($extension, $allowed_extension)) { //check selected file extension is present in allowed extension array
                                $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
                                include("PHPExcel/IOFactory.php");
                                include("PHPExcel.php"); // Add PHPExcel Library in this code
                                $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

                                
                                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                                    $highestRow = $worksheet->getHighestRow();
                                    for ($row = 2; $row <= $highestRow; $row++) {
                                        
                                        $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                                         $address = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                                        $contact = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                                        $email = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                                        $exp = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                                        $query = "INSERT INTO tbl_faculty_detail(fname,faddress,fcontact,femail,expertise,status) values ('$name','$address','$contact','$email','$exp','Active')";
                                        mysqli_query($connect, $query);
                                      
                                        
                                    }
                                }
                                
                                echo "<script>swal('Added ', 'Successfully', 'success');</script>";
                            } else {
                               echo "<script>swal('Error!.', 'error in uploading file.!', 'error');</script>";
                            }
                        } catch (Exception $ex) {
                            
                        }
                    }
                    ?>

                    
                    
                    
                     <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <form  method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="txtid">File :</label>
                            <input type="file" class="form-control" name="excel" /> 
                        </div>
                    
             

                        <input type="submit" name="import" class="btn btn-primary" value="Upload" />

                    </form>
                </div>
            </div>
                     </div>
                

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