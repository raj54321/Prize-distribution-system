<?php ob_start();
session_start();?>
<?php require './connection.php';?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  
  <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  <script src="sweetalert.min.js"></script>
</head>

<body>

    <div class="wrapper">
        <br><br><br><br>
        <form class="form-signin" method="post">       
      <h2 class="form-signin-heading">Login</h2>
      <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
      <br>
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
      
      <button class="btn btn-lg btn-primary btn-block" name="sub" type="submit">Login</button>   
    </form>
  </div>
  <?php
  if(isset($_POST['sub']))
  {
      $un=$_POST['username'];
      $pw=$_POST['password'];
      
    $query = "select * from tbl_user where username='$un' and password='$pw'";
    $rs=mysqli_query($conn, $query);
    
    while ($t= mysqli_fetch_assoc($rs))
    {
        $tt=$t['u_type'];
    }
    
    $query1 = "select * from tbl_student_detail where enrollment_no='$un' and status='Active'";
    $rs1=mysqli_query($conn, $query1);
   
if(!empty($un) and !empty($pw))
{
  if(mysqli_num_rows($rs)>0)
  {
      if($tt==0)
      {
          $_SESSION['admin']=$un;
          header("Location:index.php");
      }
      if($tt==1)
      {
          if(mysqli_num_rows($rs1)>0)
          {
              $_SESSION['stud']=$un;
          header("Location:s_home.php");
      }
      else 
      {
          echo "<script>swal('Error.!', 'User is not active user.!', 'error');</script>"; 
      }
      }
      
  }
}
 else {
    echo "<script>swal('Error.!', 'User doesn't exist.!', 'error');</script>";    
    }
    
    
  }
  
  ?>
  

</body>

</html>
<?php ob_flush(); ?>