             <?php 
session_start();
include 'database3.php';
$conn=$obj->open();

$user=$_SESSION['user'];

function create_table($conn,$name,$gender,$age,$address,$user){

    $conn=$conn;
    $name=$name;
    $gender=$gender;
    $age=$age;
    $address=$address;
    $user=$user;

    $sql="CREATE TABLE profile(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name varchar(30) not null,
        Gender varchar(30) not null,
        Age INT(3) UNSIGNED not null, 
        Address varchar(255) not null
    )";

    $result=$conn->query($sql);
    if ($result==true) {
        echo "table profile created<br>";
        insert_data($conn,$name,$gender,$age,$address,$user);
    }
    else {
        echo "table not created<br>";
        echo "connection failed".$conn->error."<br>";
    }
}

function insert_data($conn,$name,$gender,$age,$address,$user){

    $conn=$conn;
    $name=$name;
    $gender=$gender;
    $age=$age;
    $address=$address;
    $user=$user;

    $sql="SELECT id FROM table1 WHERE Username='$user'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $id=$row['id'];

    $check="SELECT * FROM profile";
    $result=$conn->query($check);
    if ($result==true) {
        echo "table exists<br>";



        $sql="UPDATE profile SET Name='$name', Gender='$gender', Age='$age', Address='$address' WHERE id='$id'";

        $result=$conn->query($sql);
        if ($result==true) {
            echo "data inserted<br>";
            header('location: profile.php');
        }
        else {
            echo "data not inserted<br>".$conn->connect_error."<br>";
        }
    }
    else {
        echo "table does not exists<br>";

        create_table($conn,$name,$gender,$age,$address,$user);
    }

}



if (isset($_POST['submit'])) {

    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $address=$_POST['address'];

    insert_data($conn,$name,$gender,$age,$address,$user);

}

$_POST=array();




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <form action="" method="post">
        Name: <input type="text" name="name"><br>
        Gender: <br>
        <input type="radio" name="gender" value="male"> Male<br>
        <input type="radio" name="gender" value="female">Female<br>
        <input type="radio" name="gender" value="other">Other<br>
        Age: <input type="number" name="age" id="age" min="18"><br>
        Address: <input type="text" name="address"><br>
        <input type="submit" name="submit" value="submit">
    
    </form>
</body>
</html>