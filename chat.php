<?php 
session_start();
include 'database3.php';
$conn=$obj->open();
function create_table($user,$msg,$conn)
{
    $conn=$conn;
    $user=$user;
    $msg=$msg;
    $sql="CREATE TABLE global_chat(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username varchar(30) not null,
        Message varchar(30) not null

    )";

    $result=$conn->query($sql);
    if ($result==true) {
        // echo "table global chat created successfully<br>";
        insert_data($user,$msg,$conn);
    }
    else {
        // echo "table not created<br>";
        // echo "connection failed".$conn->error."<br>";
    }
}
function insert_data($user,$msg,$conn)
{
    $conn=$conn;
    $user=$user;
    $msg=$msg;
    $check="SELECT * FROM global_chat";
    $result=$conn->query($check);
    if ($result==true) {
        // echo "table exists<br>";
        $sql="INSERT INTO global_chat(Username,Message)
        VALUES('$user','$msg')";

        $result=$conn->query($sql);
        if ($result==true) {
            // echo "data inserted<br>";
        }
        else {
            // echo "data not inserted<br>".$conn->connect_error."<br>";
        }
    }
    else {
        // echo "table does not exists<br>";
        //call create table
        create_table($user,$msg,$conn);
    }
}

if (isset($_POST['send'])){
            if ($_POST['msg']!=null) {
            $user=$_SESSION['user'];
            $msg=$_POST['msg'];
            insert_data($user,$msg,$conn);
        }

        $sql="SELECT *FROM global_chat";
        $result=$conn->query($sql);
        if($result==true)
        {
            while ($row=$result->fetch_assoc()) {
                echo "User:".$row['Username']."<br>";
                echo "Message:".$row['Message']."<br><br>";
            }
        }
        else {
            echo $conn->error;
        }

}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chatting app</title>
    <style>
        form{
            position: fixed;
            bottom:0;
            
        }

        .right{
            position: fixed;
            top:0;
            right:0;
        }
    </style>
</head>
<body>

<div class="right">
        <a href="profile.php">Profile</a><br>
        <a href="logout.php">logout</a>

</div>
    <form action="" method="post">
        Message: <input type="text" name="msg">
        <input type="submit" name="send" value="send">
    
    
    </form>
</body>
</html>