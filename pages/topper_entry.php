<?php
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>

<?php
if (isset($_GET['del'])) {
    $tid = $_GET['id'];

    $query123 = "delete from topper_detail where tid='$tid'";

    mysqli_query($conn, $query123);
}

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Topper Detail</h1>
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
                    <form  role="form" action="#" method="get">

                        <div class="form-group" id="div1">
                            <label>Batch :</label>
                            <select name="yr" id="yr" class="form-control"  >
                                <?php
                                $sql1 = "SELECT DISTINCT year FROM tbl_student_detail";
                                $result1 = mysqli_query($conn, $sql1);
                                ?>
                                <option value="None" selected="">None</option>
                                <?php
                                while ($row1 = mysqli_fetch_array($result1)) {
                                    ?>
                                    <option value="<?php echo $row1['year'] ?>"><?php echo $row1['year'] ?></option>
                                    <?php
                                }
                                ?>  
                            </select><br>
                            <button type="submit" name="sub" id="btnsub" class="btn btn-primary">Show</button>
                            
                        </div>  

                        

                        <?php
                        if (isset($_GET['sub'])) {

                            $yr = $_GET['yr'];
                            if ($yr != 'None') {
                                ?>  

                                <div class="form-group" id="load1">
                                    <label>Student :</label>
                                    <select name="yr" class="form-control" >
                                        <?php
                                        $q = "select * from tbl_student_detail where year='$yr'";
                                        $res = mysqli_query($conn, $q);
                                        ?>
                                        <option value="None" selected="">None</option>
                                        <?php
                                        while ($row1 = mysqli_fetch_array($res)) {
                                            ?>
                                            <option value="<?php echo $row1['enrollment_no'].$row1['s_name'] ?>"><?php echo $row1['enrollment_no'];
                                echo " (" . $row1['s_name'] . ") "
                                            ?></option>
                                            <?php
                                        }
                                        ?>  
                                    </select>
                                   
                                </div>  
                        
                        
                         <div class="form-group">
                            <label>Select Exam :</label>
                            <select  name="exm" class="form-control">

                                <option value="summer" selected="">Summer</option>
                                <option value="winter">Winter</option>

                            </select>

                        
                        
                        
                        <div class="form-group">
                            <label>Academic Year :</label>
                             <input type="text" name="year" placeholder="Enter year" class="form-control">
                        </div>
                        
                        <div class="form-group">
                             
                            <button type="submit" name="su" id="btnsub" class="btn btn-primary" class="form-control" >Submit</button>
                        </div>
                       
                        <script>
                        $(document).ready(function(){
                           
                           
                           //alert("DSC");
                           $("#btnsub").click(function(){
                        $("#div1").hide();
                               // $("#yr").hide();
                                //$("#btnsub").hide(); 
                           });
                           
                        });
                        
                        
                        </script>
                        
                                <?php
                            } else {
                                echo "<script>swal('Error!.', 'Please select batch.!', 'error');</script>";
                            }
                        }
                        ?>
                        
                        
                        <?php 
                        
                        if(isset($_GET['su']))
                        {
                            
                            $str=$_GET['yr'];
                            $stud = substr($str, 0, 15);
                            
                            $name= substr($str, 15);
                            
                            $year=$_GET['year'];
                            $e=$_GET['exm'];
                            
                            
                            $q="insert into topper_detail (tid,enrollment_no,name,year,exm) values ('','$stud','$name','$year','$e')";
                            mysqli_query($conn, $q);
                            $_GET[]=NULL;
                            echo "<script>swal('Added ', 'Successfully', 'success');</script>";
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
                    Topper Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>

                                <th>Enrollment No</th>
                                <th>Name</th>
                               
                                <th>Examination</th>
                                 <th>Academic Year</th>
                                <th>Delete</th>
                                <th>Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $que = "select * from topper_detail";
                            $result = mysqli_query($conn, $que);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                            <tr class="gradeC" style="text-align:center">
                                    <td><?php echo "$row[1]" ?></td>
                                    <td><?php echo "$row[2]" ?></td>
                                    <td><?php echo "$row[4]" ?></td>
                                    <td><?php echo "$row[3]" ?></td>
                                   
                            <td><center>
                                <form role="form" method="get">

                                    <input type="hidden" class="form-control" value="<?php echo "$row[0]" ?> " name="id">
                                    <button type="submit" name="del" class="btn btn-outline btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        Delete</button>
                                </form>
                        </center>
                            </td>
                            <td><center>
                                <form method="get" role="form">
                                    <div id="nav">
                                        <a href="certificate_ac.php?tid=<?php echo $row['tid'] ?>" target="_blank">Certificate</a>
                                
                                    </div>
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

                    
                    <style>
                        
                  
                        #nav a:hover{
                            background-color: blue;
                            color: white;
                        }	
	#nav a
	{
		background-color: none;
    color: black;
    border: 1px solid blue;
    padding: 6px 13px;
    text-align: center;
    text-decoration: none;
    display: inline-block ;
    border-radius: 3px;
    font-size: 12px;
    margin-left: 10px;
    
		background:none;
		 color: blue;
	}
	
                    </style>
                    
                    
                </div>


                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>




</div>

<?php require './footer.php'; ?>