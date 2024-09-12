<?php

require_once "mysql_connection.php";
$sql = "CREATE TABLE examination (
    id int primary key auto_increment,
    department varchar(30) not null,
    program varchar(20) not null,
    semester varchar(20) not null,
    subject varchar(20) not null,
    exam_date varchar(20) not null,
    duration varchar(6) not null,
    exam_time varchar(10) not null)";

if($conn->query($sql)){
    echo "table created successfully";
}else{
    echo "table is not created ".$conn->error;
}

?>