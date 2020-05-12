<?php
require './session_stud.php';
require './connection.php';
require './header.php';
require './s_menu.php';
?>
    

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Password</h1>
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
                            <label>Old Password :</label>
                            <input type="password" name="old" class="form-control" placeholder="Enter old password">
                        </div>

                        <div class="form-group">
                            <label>New Password :</label>
                            <input type="password" name="new" class="form-control" placeholder="Enter new password">
                        </div>
                        
                        <div class="form-group">
                            <label>Password Again:</label>
                            <input type="password" name="new1" class="form-control" placeholder="Enter new password again">
                        </div>
                        
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-success">Reset</button>

                        <?php

if(isset($_REQUEST['update']))
	{
		$old=$_REQUEST['old'];
		$new=$_REQUEST['new'];
                $new1=$_REQUEST['new1'];
		
		$test="select * from tbl_user where username='$student' and password='$old'";
                $st= mysqli_query($conn, $test);
                if(!empty($old) and !empty($new) and !empty($new1))
                {
                    if(mysqli_num_rows($st)>0 and ($new==$new1))
                        {
                         $update="update tbl_user set password='$new' where username='$student'";
                         $r=mysqli_query($conn,$update);
                          echo "<script>swal('Done ', 'Successfully changed', 'success');</script>";
                    }
 else {
     echo "<script>swal('Error!.', 'Updation failed.!', 'error');</script>";
 }
                }
                else {
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



</div>

<?php require './footer.php'; ?>