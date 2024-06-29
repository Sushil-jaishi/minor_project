<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/header-sidebar-styles.css">
    <link rel="stylesheet" href="../assets/css/register_student_styles.css">
</head>

<body>
    <?php include_once "header-sidebar.php"; ?>

    <div id="heading-students">Student Registration</div>

     <!-- student added/error message -->
     <?php
    if(isset($_GET['success'])){
        echo '<div id='.$_GET['success'].'>'.$_GET['message'].'</div>';
    }
    ?>


    <?php
    require_once "../database/mysql_connection.php";
    if(isset($_GET['id'])){
        $id=$_GET['id'];  
        $sql= "select * from student where id='$id'";
        $result=$conn->query($sql);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
    ?>

            <div class="content-section">
                <form method="post" enctype="multipart/form-data" action="edit_student_handle.php">
                    <div>
                        Student Name
                        <div id="name">
                            <input type="text" name="first_name" placeholder="First Name" class="form-input" value="<?php echo $row['first_name'] ?>">
                            <input type="text" name="last_name" placeholder="Last Name" class="form-input" value="<?php echo $row['last_name'] ?>">
                        </div>
                    </div>
                    <div id="gender">
                        Gender<br>
                        <input type="radio" name="gender" value="male" id="male"<?php if($row['gender']=='male'){echo 'checked';} ?>>
                        <label for="male">male</label>
                        <input type="radio" name="gender" value="female" id="female"<?php if($row['gender']=='female'){echo 'checked';} ?>>
                        <label for="female">female</label>
                    </div>


                    <div class="form-label">
                        <div class="form-label-item">Date of Birth</div>
                        <div class="form-label-item">Program</div>
                    </div>
                    <div class="display-flex">
                        <input type="date" name="dob" class="form-input" value="<?php echo $row['dob'] ?>">
                        <Select name="program" class="form-input">
                            <option value="BSc." <?php if($row['program']=='BSc.'){echo 'selected';} ?>>BSc.</option>
                            <option value="BSc. CSIT" <?php if($row['program']=='BSc. CSIT'){echo 'selected';} ?>>BSc. CSIT</option>
                            <option value="BBA" <?php if($row['program']=='BBA'){echo 'selected';} ?>>BBA</option>
                            <option value="BBS" <?php if($row['program']=='BBS'){echo 'selected';} ?>>BBS</option>
                        </Select>
                    </div>
                    <div class="form-label">
                        <div class="form-label-item">Email</div>
                        <div class="form-label-item">Contact</div>
                    </div>
                    <div class="display-flex">
                        <input type="email" name="email" placeholder="user@example.com" class="form-input" value="<?php echo $row['email'] ?>">
                        <input type="tel" name="contact" class="form-input" value="<?php echo $row['contact'] ?>">
                    </div>
                    <div class="form-label">
                        <div class="form-label-item">Department</div>
                        <div class="form-label-item">Semester</div>
                    </div>
                    <div class="display-flex">
                        <Select name="department" class="form-input">
                            <option value="Science and Technology" <?php if($row['department']=='Science and Technology'){echo 'selected';} ?>>Science and Technology</option>
                            <option value="Engineering" <?php if($row['department']=='Engineering'){echo 'selected';} ?>>Engineering</option>
                            <option value="Management" <?php if($row['department']=='Management'){echo 'selected';} ?>>Management</option>
                            <option value="Education" <?php if($row['department']=='Education'){echo 'selected';} ?>>Education</option>
                        </Select>
                        <Select name="semester" class="form-input">
                            <option value="First" <?php if($row['semester']=='First'){echo 'selected';} ?>>First</option>
                            <option value="Second" <?php if($row['semester']=='Second'){echo 'selected';} ?>>Second</option>
                            <option value="Third" <?php if($row['semester']=='Third'){echo 'selected';} ?>>Third</option>
                            <option value="Fourth" <?php if($row['semester']=='Fourth'){echo 'selected';} ?>>Fourth</option>
                            <option value="Fifth" <?php if($row['semester']=='Fifth'){echo 'selected';} ?>>Fifth</option>
                            <option value="Sixth" <?php if($row['semester']=='Sixth'){echo 'selected';} ?>>Sixth</option>
                            <option value="Seventh" <?php if($row['semester']=='Seventh'){echo 'selected';} ?>>Seventh</option>
                            <option value="Eighth" <?php if($row['semester']=='Eighth'){echo 'selected';} ?>>Eighth</option>
                        </Select>
                    </div>
                    <div id="photo-upload-container">
                        Student Photo<br>
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
<script src="../assets/js/register_student.js"></script>

</html>