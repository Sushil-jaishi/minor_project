<?php
session_start();
if(!isset($_SESSION['user_admin'])){
    header("location:http://localhost/minor_project/login/login.php");
    exit();
}
?>