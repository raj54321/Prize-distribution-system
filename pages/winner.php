<?php
require './session_admin.php';
require './connection.php';
require './header.php';
require './A_menu.php';
?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Winners</h1>
        </div>
    </div>
  
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Winner Certificate
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>

                                <th>Enrollment No</th>
                                <th>Event Name</th>
                                <th>Status</th>
                               
                                <th>Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                           
                            $que = "select * from tbl_participant_detail where status='Winner'";
                            $result = mysqli_query($conn, $que);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                            <tr class="gradeC" style="text-align:center">
                                    <td><?php echo "$row[1]" ?></td>
                                    <td><?php echo "$row[2]" ?></td>
                                    <td><?php echo "$row[4]" ?></td>
                                   
                            
                            <td><center>
                                <form method="get" role="form">
                                    <div id="nav">
                                        <a href="certificate_o.php?pid=<?php echo $row['pid'] ?>" target="_blank">Certificate</a>
                                
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