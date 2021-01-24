<?php

include 'database3.php';
$conn=$obj->open();

function data_insert($username,$password,$conn)
{   
    $conn=$conn;
    $sql="INSERT INTO table1(Username,Password)
    VALUES('$username',$password)";

    $result=$conn->query($sql);
    if ($result==true) {
        echo "data inserted <br>";
        header('location: index.php');
    }
    else {
        echo "data not inserted<br>".$conn->connect_error."<br>";
    }

    
}
function create_table($conn)
{
    $conn=$conn;
    $sql="CREATE TABLE table1(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username Varchar(30) NOT NULL,
        Password varchar(30) not null
    )";

    $result=$conn->query($sql);
    if ($result==true) {
        echo "table created<br>";
        data_insert($_POST['uname'],$_POST['upass'],$conn);
    }
    else {
        echo "table not created<br>";
        echo "connection failed".$conn->error."<br>";
    }
}

if (isset($_POST['submit'])) {


    $user=$_POST['uname'];
    $sql="SELECT Username FROM table1 WHERE Username='$user'";
    $result=$conn->query($sql);
    if ($result==true) {
        $row=$result->fetch_assoc();
        if($row!=NULL)
        {
            ?>
            <script>
                alert('username already taken choose different one.')
            </script>
            <?php
        }
        else {
            $sql="SELECT * FROM table1";
            $result=$conn->query($sql);
            if ($result==true) {
                echo "table already exists<br>";
                data_insert($_POST['uname'],$_POST['upass'],$conn);
        
            }   
            else {
                echo "table does not exists<br>";
                create_table($conn);
        
            }
        }
    }
    else {
        create_table($conn);

    }

}
elseif (isset($_POST['login'])) {
    header('location: index.php');
}





?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <form action="" method="post">
        Username: <input type="text" name="uname"><br>
        password: <input type="password" name="upass"><br>
        <input type="submit" name="submit" value="signup"><br>
        <input type="submit" name="login" value="login">
    
    
    </form>
</body>
</html>