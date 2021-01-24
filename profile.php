<?php 
session_start();
include 'database3.php';
$conn=$obj->open();

$user=$_SESSION['user'];
$sql="SELECT id FROM table1 WHERE Username='$user'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$id=$row['id'];

$sql="SELECT Name,Gender,Age,Address FROM profile Where id='$id'";
$result=$conn->query($sql);
if ($result==true) {
    while($row=$result->fetch_assoc()){
        echo "Name:".$row['Name']."<br>";
        echo "Gender:".$row['Gender']."<br>";
        echo "Age:".$row['Age']."<br>";
        echo "Address:".$row['Address']."<br>";
    }
}
else {
    echo $conn->error;
}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .right{
            position: fixed;
            top: 0;
            right: 0;

        }
    
    </style>
</head>
<body>
    <div class="right">
        <a href="chat.php">Home</a>
        <a href="edit_profile.php">Edit profile</a>
        
    
    </div>
</body>
</html>