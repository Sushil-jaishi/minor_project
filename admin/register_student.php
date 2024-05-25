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

    <div class="content-section">
        <form method="post" enctype="multipart/form-data" action="register_student_handle.php">
            <div>
                Student Name
                <div id="name">
                    <input type="text" name="first_name" placeholder="First Name" class="form-input" required>
                    <input type="text" name="last_name" placeholder="Last Name" class="form-input" required>
                </div>
            </div>
            <div id="gender">
                Gender<br>
                <input type="radio" name="gender" value="male" id="male" checked>
                <label for="male">male</label>
                <input type="radio" name="gender" value="female" id="female">
                <label for="female">female</label>
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
                <div class="form-label-item">Department</div>
            </div>
            <div class="display-flex">
                <input type="email" name="email" placeholder="user@example.com" class="form-input" required>
                <Select name="department" class="form-input">
                    <option value="Science and Technology">Science and Technology</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Management">Management</option>
                    <option value="Education">Education</option>
                </Select>
            </div>
            <div class="form-label">
                <div class="form-label-item">Program</div>
                <div class="form-label-item">Semester</div>
            </div>
            <div class="display-flex">
                <Select name="program" class="form-input">
                    <option value="BSc.">BSc.</option>
                    <option value="BSc. CSIT">BSc. CSIT</option>
                    <option value="BBA">BBA</option>
                    <option value="BBS">BBS</option>
                </Select>
                <Select name="semester" class="form-input">
                    <option value="First">First</option>
                    <option value="Second">Second</option>
                    <option value="Third">Third</option>
                    <option value="Fourth">Fourth</option>
                    <option value="Fifth">Fifth</option>
                    <option value="Sixth">Sixth</option>
                    <option value="Seventh">Seventh</option>
                    <option value="Eighth">Eighth</option>
                </Select>
            </div>
            <div id="photo-upload-container">
                Student Photo<br>
                <input type="file" name="photo" id="photo-upload">
            </div>
            <button type="submit" name="submit" value="submit" id="submit-btn">Submit</button>
        </form>
    </div>
    </div>
</body>
<script src="../assets/js/register_student.js"></script>

</html>