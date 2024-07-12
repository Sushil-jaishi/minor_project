<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../includes/header-sidebar/header-sidebar-styles.css">
    <link rel="stylesheet" href="../register_admin/register_admin_styles.css">
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


    <?php
    require_once "../../../database/mysql_connection.php";
    if(isset($_GET['id'])){
        $id=$_GET['id'];  
        $sql= "select * from admin where id='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
    ?>

            <div class="content-section">
                <form method="post" enctype="multipart/form-data" action="edit_admin_handle.php">
                    <div>
                        Admin Name
                        <div id="name">
                            <input type="text" name="first_name" placeholder="First Name" class="form-input" value="<?php echo $row['first_name'] ?>">
                            <input type="text" name="last_name" placeholder="Last Name" class="form-input" value="<?php echo $row['last_name'] ?>">
                        </div>
                    </div>
                    
                    <div class="form-label">
                        <div class="form-label-item">Date of Birth</div>
                        <div class="form-label-item">Contact</div>
                    </div>
                    <div class="display-flex">
                        <input type="date" name="dob" class="form-input" value="<?php echo $row['dob'] ?>">
                        <input type="tel" name="contact" class="form-input" value="<?php echo $row['contact'] ?>">
                    </div>
                    <div class="form-label">
                        <div class="form-label-item">Email</div>
                    </div>
                    <div class="display-flex">
                        <input type="email" name="email" placeholder="user@example.com" class="form-input" value="<?php echo $row['email'] ?>">
                        <div class="form-input" id="hidden-form-input"></div>
                    </div>
                    <div id="photo-upload-container">
                        Admin Photo<br>
                        <input type="file" name="photo" id="photo-upload">
                        <input type="hidden" name="old_image" value="<?php echo $row['photo'] ?>">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="old_email" value="<?php echo $row['email'] ?>">
                    <button type="submit" name="submit" value="submit" id="submit-btn">Submit</button>
                </form>
            </div>
    <?php
        }
    }
    ?>
    </div>
</body>
<script src="../register_admin/register_admin.js"></script>

</html>