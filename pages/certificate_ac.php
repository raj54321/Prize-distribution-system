<?php header("Content-Type: image/png");?>
<?php 
if (isset($_GET['tid'])) {

$connection = mysqli_connect('localhost', 'root', '', 'pds_db');
$tid = $_GET['tid'];
$select_student_fromid = "SELECT * FROM topper_detail WHERE tid = $tid";
$select_student_fromid_exe = mysqli_query($connection, $select_student_fromid);
while ($row = mysqli_fetch_assoc($select_student_fromid_exe))
{

		$enrollment_no = $row['enrollment_no'];
		$s_name = $row['name'];
                $ex=$row['exm'];
                $year = $row['year'];
}

// Create the image

$im = imagecreatefrompng('template/certificate.png');
$font = 'fonts/MTCORSVA.ttf';

$black = imagecolorallocate($im, 25, 25, 25);

$fontSize = 70; // Font size is in pixels.

$imageX = imagesx($im);


$textWidth = imagettfbbox($fontSize, 0,$font, $s_name);
 
$textWidth = $textWidth[0] + $textWidth[2];
 
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 2.8, 1280, $black, $font, "This is to certify that Mr./Ms." . $s_name );
// imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 2.5, 1500, $black, $font, "Mr./Ms. " . $s_name);
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 3.3, 1380, $black, $font, "of Babu Madhav Institute of information technology has");
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 2.9, 1480, $black, $font, "secured first rank at Uka Tarasadia University" );
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 3.3, 1580, $black, $font, "in ".$ex." examination held during academic year " . $year."." );


echo imagepng($im);


//save the image in a file

 

imagepng($im,"img/Aca/" . $tid . ".png" );

imagedestroy($im);

?>
<html lang=“en”>
<head>
<meta charset=“UTF-8”>
<title>Document</title>
</head>
<body>
<img src="img/Aca/<?php echo $tid?>.png" alt="academic certificate" height="100%"/>
</html>
<?php

}

?>