<?php 
session_start();
include 'database3.php';
$conn=$obj->open();


if (isset($_POST['login'])) {
  $user=$_POST['uname'];

  $sql="SELECT Username,Password FROM table1 WHERE Username='$user'";
  $result=$conn->query($sql);
  if ($result==true) {
    $row=$result->fetch_assoc();
    if ($row!=null) {
      if ($row['Password']===$_POST['upass']) {
        $_SESSION['user']=$_POST['uname'];
        header('location: chat.php');
      }
      else {
        ?>
        <script>alert('Wrong password')</script>
        <?php
      }
    }
    else {
      ?>
      <script>alert('Username not found plz signup')</script>
      <?php
    }
  }
  else {
      echo "sql error".$conn->error;
  }
}
elseif (isset($_POST['signup'])) {
  header('location: signup.php');
}








?>









<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
</head>
<body>

  <h3>Welcome to Chatify</h3><br>
  <form action="" method="post">
    Username: <input type="text" name="uname"><br>
    Password: <input type="password" name="upass"><br>
    <input type="submit" name="login" value="login"><br>
    <input type="submit" name="signup" value="signup">
  
  
  </form>
</body>
</html>