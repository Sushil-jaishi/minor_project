<?php
session_start();
unset($_SESSION['user_admin']);
unset($_SESSION['user_student']);
unset($_SESSION['email']);
session_destroy();
header("location:http://localhost/minor_project/login/login.php");
exit();
?>

