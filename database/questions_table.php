<?php

require_once "mysql_connection.php";
$sql = "CREATE TABLE questions (
    id int primary key auto_increment,
    question varchar(255) not null,
    option_1 varchar(255) not null,
    option_2 varchar(255) not null,
    option_3 varchar(255) not null,
    option_4 varchar(255) not null,
    correct int not null,
    examination_id int not null, 
    FOREIGN KEY (examination_id) REFERENCES examination(id) ON DELETE CASCADE)";

if($conn->query($sql)){
    echo "table created successfully";
}else{
    echo "table is not created ".$conn->error;
}

?>