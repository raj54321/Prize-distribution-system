<?php $connection = mysqli_connect('localhost', 'root', '', 'pds_db');?>


<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Certificate</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Enrollment No</th>
    <th>Student Name</th>
    <th>View Certificate</th>
  </tr>
<?php 
	$select_student = "SELECT * FROM tbl_student_detail";
	$select_student_exe = mysqli_query($connection, $select_student);
	while($row = mysqli_fetch_assoc($select_student_exe))
	{
		$student_id = $row['sid'];
		$enrollment_no = $row['enrollment_no'];
		$s_name = $row['s_name'];
?>
  <tr>
    <td><?php echo $student_id;?></td>
    <td><?php echo $enrollment_no;?></td>
    <td><?php echo $s_name;?></td>
    <td><a href="certificate.php?sid=<?php echo $student_id?>" target="_blank">Certificate</a></td>
    </tr>
 <?php } ?> 
</table>

</body>
</html>


 



