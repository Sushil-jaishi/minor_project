<?php
session_start();
if(!isset($_SESSION['user_student'])){
    header("location:http://localhost/minor_project/login/login.php");
    exit();
}
?>