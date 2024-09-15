<?php
session_start();

if(isset($_SESSION['user_admin'])){
    header("location:../admin/student_management/register_student/register_student.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login_styles.css">
</head>

<body>
    <div class="nav">
        <div class="wrap">
            <div class="logo"><img src="../assets/images/logo_with_text.png" alt="Uni logo" width="200px"></div>
            <ul>
                <li><a href="../index.html" class="current">Home</a></li>
                <li><a href="../aboutusPage.html">About Us</a></li>
                <li><a href="../notice.html">Notice</a></li>
                <li><a href="../contactUs.html">Contact Us</a></li>
                <li><a href="../results/search_results.html">Results</a></li>
            </ul>
        </div>
    </div>
    <div id="outer-container">
        <div class="container">

            <?php
                if(isset($_GET['success'])){
                    echo '<div id='.$_GET['success'].'>'.$_GET['message'].'</div>';
                }
            ?>

            <div>
                <img src="../assets/images/fwu_logo.png" alt="FWU LOGO" id="login-logo">
            </div>
            <h1>online examination</h1>
            <form method="post" action="login_handle.php">
                <input class="form-input" type="email" name="email" placeholder="Email"><br>
                <input class="form-input" type="password" name="password" placeholder="Password"><br>
                <button id="login-btn" type="submit" name="submit" value="login">Login</button>
            </form>
            <a href="#" id="forgot-password">Forgot Password?</a>
        </div>
    </div>
    <div class="footer">@2024 Far Western University</div>
   
</body>
<script src="register_student.js"></script>

</html>