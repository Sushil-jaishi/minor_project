<?php

$host = 'localhost';
$username = 'root';
$password = ' ';
$database = 'online_examination_system';

$conn = new mysqli($host,$username,$password);

if($conn->connect_error==true){
    echo "connection failed".$conn->connect_error;
}else{
    echo 'mysql connection successful!!';
}

?>