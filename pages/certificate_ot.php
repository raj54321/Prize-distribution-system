<?php header("Content-Type: image/png");?>
<?php 
if (isset($_GET['pid'])) {

$connection = mysqli_connect('localhost', 'root', '', 'pds_db');
$tid = $_GET['pid'];
$select_student_fromid = "SELECT * FROM tbl_participant_detail WHERE pid = $tid";
$select_student_fromid_exe = mysqli_query($connection, $select_student_fromid);
while ($row = mysqli_fetch_assoc($select_student_fromid_exe))
{

		$enrollment_no = $row['p_eno'];
		$s_name = $row['e_name'];
               
}

$yr= date("Y");
$q="select * from tbl_student_detail where enrollment_no='$enrollment_no'";
$rs= mysqli_query($connection, $q);

while ($r= mysqli_fetch_array($rs))
        {
            $nme=$r['s_name'];
    
        }

        
        
        $q1="select * from tbl_subevent where esname='$s_name'";
$rs1= mysqli_query($connection, $q1);

while ($r1= mysqli_fetch_array($rs1))
        {
            $main=$r1['ename'];
    
        }
        
        $s_name= strtolower($s_name);
        
        
// Create the image

$im = imagecreatefrompng('template/certificate.png');
$font = 'fonts/MTCORSVA.ttf';

$black = imagecolorallocate($im, 25, 25, 25);

$fontSize = 70; // Font size is in pixels.

$imageX = imagesx($im);


$textWidth = imagettfbbox($fontSize, 0,$font, $s_name);
 
$textWidth = $textWidth[0] + $textWidth[2];
 
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 4.5, 1280, $black, $font, "This certificate of exellence has conferred to Mr./Ms." . $nme );
// imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 2.5, 1500, $black, $font, "Mr./Ms. " . $s_name);
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 3.5, 1380, $black, $font, "of Babu Madhav Institute of information technology for");
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 3.5, 1480, $black, $font, "securing runner-up position in " .$s_name." compitition" );
imagettftext($im, $fontSize, 0, ($imageX - $textWidth) / 3.1, 1580, $black, $font, "of " .$main. " held during academic year " .$yr. "." );


echo imagepng($im);


//save the image in a file

 

imagepng($im,"img/other/" . $tid . ".png" );

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