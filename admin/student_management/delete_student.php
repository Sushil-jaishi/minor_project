<?php

require_once "../../database/mysql_connection.php";
$id = $_GET['id'];

//delete profile photo form server
$sql="select photo from student where id='$id'";
if($result=$conn->query($sql)){
    if($result->num_rows==1){
        $row=$result->fetch_assoc();
        echo "reached to unlink";
        $photo = $row['photo'];
        unlink("../../assets/images/uploads/$photo");
    }else{
        header("location:view_students/view_student.php?success=false&message=Error while delete student photo from server");
        exit();
    }
}else{
    header("location:view_students/view_student.php?success=false&message=Error while delete student photo from server");
    exit();
}

//delete student from database
$sql = "delete from student where id='$id'";
if($conn->query($sql)){
    header("location:view_students/view_student.php?success=false&message=Student deleted successfully");
    exit();
}else{
    echo "error occurs during student delete".$conn->error;
}
?>