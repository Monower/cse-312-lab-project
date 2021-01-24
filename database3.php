<?php
class database{


private $servername="localhost";
private $username="root";
private $password="";
protected $conn;

public function open(){
    $conn1=new mysqli($this->servername,$this->username,$this->password);

    if ($conn1->connect_error) {
        echo "connection error".$conn->connect_error;
    }
    else{
        // echo "connection with server success<br>";
    }

    $check="CREATE DATABASE IF NOT EXISTS db1";
    if ($conn1->query($check)==true) {
        // echo "database created successfully<br>";
    }
    else {
        echo "database already exists and not created<br>";
    }

    $conn2=new mysqli($this->servername,$this->username,$this->password,"db1");

    if ($conn2->connect_error) {
        echo "connection error".$conn2->connect_error;
    }
    else {
        // echo "connection with database successful<br>";
    }

    return $conn2;
}


}
$obj=new database();




?>