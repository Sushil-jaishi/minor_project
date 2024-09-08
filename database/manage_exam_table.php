<?php

require_once "mysql_connection.php";
$sql = "CREATE TABLE manage_exam (
    student_id int not null,
    question_id int not null,
    student_option int,
    status varchar(10),
    FOREIGN KEY (student_id) references student(id) on delete cascade,
    foreign key (question_id) references questions(id) on delete cascade)";

if($conn->query($sql)){
    echo "table created successfully";
}else{
    echo "table is not created ".$conn->error;
}

?>