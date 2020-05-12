<?php
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reports</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q = "select * from tbl_student_detail";
                        $rs = mysqli_num_rows(mysqli_query($conn, $q));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs; ?></div>
                            <div>Total Students</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q1 = "select * from tbl_student_detail where status='Active'";
                        $rs1 = mysqli_num_rows(mysqli_query($conn, $q1));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs1; ?></div>
                            <div>Active Students</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
      
          <div class="col-lg-4 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q = "select * from tbl_student_detail where status='Deactive'";
                        $rs = mysqli_num_rows(mysqli_query($conn, $q));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs; ?></div>
                            <div>Deactive Students</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
      
    </div>
    
    
    
        <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q = "select * from tbl_faculty_detail";
                        $rs = mysqli_num_rows(mysqli_query($conn, $q));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs; ?></div>
                            <div>Total Faculty</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q1 = "select * from tbl_faculty_detail where status='Active'";
                        $rs1 = mysqli_num_rows(mysqli_query($conn, $q1));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs1; ?></div>
                            <div>Active Faculty</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
      
          <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q = "select * from tbl_faculty_detail where status='Deactive'";
                        $rs = mysqli_num_rows(mysqli_query($conn, $q));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs; ?></div>
                            <div>Deactive Faculty</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
      
    </div>

    
    
    
    
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q = "select * from tbl_event_detail";
                        $rs = mysqli_num_rows(mysqli_query($conn, $q));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs; ?></div>
                            <div>Total Events Done</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q1 = "select * from tbl_participant_detail";
                        $rs1 = mysqli_num_rows(mysqli_query($conn, $q1));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs1; ?></div>
                            <div>Total Participation</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
      
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q = "select * from tbl_participant_detail where status='Winner'";
                        $rs = mysqli_num_rows(mysqli_query($conn, $q));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs; ?></div>
                            <div>Total Winners</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
         <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <?php
                        $q = "select * from tbl_participant_detail where status='Runner-up'";
                        $rs = mysqli_num_rows(mysqli_query($conn, $q));
                        ?>
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $rs; ?></div>
                            <div>Total Runner-ups</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      
    </div>

    
      <div class="row">
          <form method="post" role="form">
          <div class="col-lg-10 col-md-6">
              <br>
                        <div class="form-group">
                            
                            <select name="event" class="form-control">
                                <?php
                                $sql = "SELECT * FROM tbl_subevent where typ='Individual'";
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
          </div>
          <div class="col-lg-2 col-md-6"><br>
              <input type="submit" name="sub" value="Search" class="btn btn-primary">
          </div>
              </form>
      </div>
    
    <?php
    
    
    if(isset($_POST['sub']))
    {
        $e=$_POST['event'];
        
        $q="select * from tbl_participant_detail where e_name='$e'";
        
        $rs= mysqli_query($conn, $q);
                
        $count= mysqli_num_rows($rs);
        ?>
        
      
    <div class="col-lg-3 col-md-6">
            <div class="panel panel">
                <div class="panel-heading">
                    <div class="row">
                        
                        <div class="col-xs-11 text-center">
                            <div class="huge"></div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    
    
     <div class="col-lg-6 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        
                        <div class="col-xs-11 text-center">
                            <div class="huge"><?php echo $count; ?></div>
                            <div>Total Participant</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    
        <div class="col-lg-3 col-md-6">
            <div class="panel panel">
                <div class="panel-heading">
                    <div class="row">
                        
                        <div class="col-xs-11 text-center">
                            <div class="huge"></div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    <?php } ?>
    
    
    
    
    
    
    
</div>


<?php require './footer.php'; ?>














