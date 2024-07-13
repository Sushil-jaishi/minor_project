<?php
include_once "../../../login/admin_session_check.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../includes/header-sidebar/header-sidebar-styles.css">
    <link rel="stylesheet" href="./register_admin_styles.css">
</head>

<body>

    <?php include_once "../../../includes/header-sidebar/header-sidebar.php"; ?>

    <div id="heading-students">Admin Registration</div>

    <!-- student added/error message -->
    <?php
    if(isset($_GET['success'])){
        echo '<div id='.$_GET['success'].'>'.$_GET['message'].'</div>';
    }
    ?>

        <div class="content-section">
            <form method="post" enctype="multipart/form-data" action="register_admin_handle.php">
                <div>
                    Admin Name
                    <div id="name">
                        <input type="text" name="first_name" placeholder="First Name" class="form-input" required>
                        <input type="text" name="last_name" placeholder="Last Name" class="form-input" required>
                    </div>
                </div>
                <div class="form-label">
                    <div class="form-label-item">Date of Birth</div>
                    <div class="form-label-item">Contact</div>
                </div>
                <div class="display-flex">
                    <input type="date" name="dob" class="form-input" required>
                    <input type="tel" name="contact" placeholder="9876543210" class="form-input" required>
                </div>
                <div class="form-label">
                    <div class="form-label-item">Email</div>

                </div>
                <div class="display-flex">
                    <input type="email" name="email" placeholder="user@example.com" class="form-input" required>
                    <div class="form-input" id="hidden-form-input"></div>
                </div>
                <div id="photo-upload-container">
                    Admin Photo<br>
                    <input type="file" name="photo" id="photo-upload" required>
                </div>
                <button type="submit" name="submit" value="submit" id="submit-btn">Submit</button>
            </form>
        </div>
    </div>
    </div>
</body>
<script src="./register_admin.js"></script>

</html>