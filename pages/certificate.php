<?php header("Content-Type: image/png");?>
<?php 
if (isset($_GET['sid'])) {

$connection = mysqli_connect('localhost', 'root', '', 'pds_db');
$sid = $_GET['sid'];
$select_student_fromid = "SELECT * FROM tbl_student_detail WHERE sid = $sid";
$select_student_fromid_exe = mysqli_query($connection, $select_student_fromid);
while ($row = mysqli_fetch_assoc($select_student_fromid_exe))
{

		$enrollment_no = $row['enrollment_no'];
		$s_name = $row['s_name'];
                $game = "Freedom-run 2018";
		$date = "13/08/2017";
}


//$q_game="select * from tbl_participant_detail where enrollment_no='$enrollment_no'";
//$rs1=mysqli_query($connection, $q_game);


// Create the image

$im = imagecreatefrompng('template/certificate.png');
$font = 'fonts/MTCORSVA.ttf';

$black = imagecolorallocate($im, 25, 25, 25);

$fontSize = 70; // Font size is in pixels.

$imageX = imagesx($im);


$textWidth = imagettfbbox($fontSize, 0,$font, $s_name);
 
$textWidth = $textWidth[0] + $textWidth[2];
 
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 2.9, 1280, $black, $font, "This is to certify that Mr./Ms." . $s_name );
// imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 2.5, 1500, $black, $font, "Mr./Ms. " . $s_name);
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 3.3, 1380, $black, $font, "of Babu Madhav Institute of information technology has");
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 2.4, 1480, $black, $font, "participated in " . $game);
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 3.7, 1580, $black, $font, "compitation held on " . $date . " at Uka Tarasadia University.");



echo imagepng($im);


//save the image in a file

 

imagepng($im,"img/certi/" . $sid . ".png" );

imagedestroy($im);

?>
<html lang=“en”>
<head>
<meta charset=“UTF-8”>
<title>Document</title>
</head>
<body>
<img src="img/certi/<?php echo $sid?>.png" alt="Your generated image" height="100%"/>
</html>
<?php

}

?>