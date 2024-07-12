<?php

require_once "../../database/mysql_connection.php";
$id = $_GET['id'];

//delete profile photo form server
$sql="select photo from admin where id='$id'";
if($result=$conn->query($sql)){
    if($result->num_rows==1){
        $row=$result->fetch_assoc();
        $photo = $row['photo'];
        unlink("../../assets/images/uploads/$photo");
    }else{
        header("location:view_admin/view_admin.php?success=false&message=Error while delete admin photo from server");
        exit();
    }
}else{
    header("location:view_admin/view_admin.php?success=false&message=Error while delete admin photo from server");
    exit();
}

//delete admin from database
$sql = "delete from admin where id='$id'";
if($conn->query($sql)){
    header("location:view_admin/view_admin.php?success=false&message=admin deleted successfully");
    exit();
}else{
    echo "error occurs during admin delete".$conn->error;
}
?>