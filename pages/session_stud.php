<?php
session_start();
if(!empty($_SESSION['stud']))
{
    $student=$_SESSION['stud'];
}
 else {
    header("Location:login.php");
}
?>
