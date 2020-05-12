<?php
$connect = mysqli_connect("localhost", "root", "", "pds_db");
$output = '';
if(isset($_POST["import"]))
{
    try {
        
    $xy=explode(".", $_FILES["excel"]["name"]);
 $extension = end($xy); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel/IOFactory.php");
   include("PHPExcel.php");// Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $email = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
     $type = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $query = "INSERT INTO login(username,password,type) VALUES ('".$name."', '".$email."','".$type."')";
    mysqli_query($connect, $query);
    $output .= '<td>'.$name.'</td>';
    $output .= '<td>'.$email.'</td>';
    $output .= '</tr>';
   }
  } 
  $output .= '</table>';
   echo '<script>alert("insert success")</script>';

 }
 else
 {
      echo '<script>alert("insert Failed")</script>';
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
 
 
 } catch (Exception $ex) {
        
    }
}
?>

 
<form method="post" enctype="multipart/form-data" class="form-horizontal">
                        
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Information</h4>
            </div>
     <div class="modal-body">
         
                
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtid">ID</label>
                            <div class="col-sm-6">
                                <input type="file" name="excel" />                          </div>
                        </div>
                    </div>
                
     </div>
    
   <div class="modal-footer">
        <input type="submit" name="import" class="btn btn-info" value="Import" />
                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> </a>
                
            </div>
       </div>
  
</form>
 
   <?php
   echo $output;
   ?>
 
