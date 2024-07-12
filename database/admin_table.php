<?php

require_once "mysql_connection.php";
$sql = "CREATE TABLE admin (
    id int(6) primary key auto_increment,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    dob varchar(20) not null,
    email varchar(50) not null unique,
    contact varchar(15) not null,
    photo varchar(100),
    password varchar(35) not null) ";

if($conn->query($sql)){
    echo "table created successfully";
}else{
    echo "table is not created ".$conn->error;
}

?>