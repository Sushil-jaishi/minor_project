<?php

require_once "../database/mysql_connection.php";

session_start();

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];


    if(empty($email)){
        header("location:login.php?success=false&message=email is required");
        exit();
    }
    if(empty($password)){
        header("location:login.php?success=false&message=password is required");
        exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("location:login.php?success=false&message=Email is invalid");
        exit();
    }

    $password = md5($password);


    $sql = "select email,password from admin where email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        $sql = "select email,password from student where email='$email'";
        $result2 = $conn->query($sql);
        if($result2->num_rows == 0){
            header("location:login.php?success=false&message=user not found");
            exit();
        }else{
            $row = $result2->fetch_assoc();
            if($email==$row['email']&&$password==$row['password']){
                $_SESSION['user_student']=true;
                $_SESSION['email']=$row['email'];
                header("location:../student.php");
                exit();
            }else{
                header("location:login.php?success=false&message=email or password is wrong");
                exit();
            }
        }
    }else{
        $row = $result->fetch_assoc();
        if($email==$row['email']&&$password==$row['password']){
            $_SESSION['user_admin']=true;
            $_SESSION['email']=$row['email'];
            header("location:../admin/student_management/register_student/register_student.php");
            exit();
        }else{
            header("location:login.php?success=false&message=email or password is wrong");
            exit();
        }
    }

}

?>