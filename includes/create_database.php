<?php

require_once "mysql_connection.php";

$sql="create database $database";
if($conn->query($sql)==true){
    echo "database created successfully";
}else{
    echo "failed to create database".$conn->error;
}

?>