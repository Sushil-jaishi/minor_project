<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/admin_styles.css">
    <link rel="stylesheet" href="../assets/css/register_student_styles.css">
</head>

<body>
    <?php include_once "admin.php"; ?>

        <div id="heading-students">Student Registration</div>
        <div class="content-section">
            <div>
                Student Name
                <div id="name">
                    <input type="text" name="first_name" placeholder="First Name" class="form-input">
                    <input type="text" name="last_name" placeholder="Last Name" class="form-input">
                </div>
            </div>
            <div id="gender">
                Gender<br>
                <input type="radio" name="gender" value="male" id="male" checked>
                <label for="male">male</label>
                <input type="radio" name="gender" value="female" id="female">
                <label for="female">female</label>
            </div>
            <div>
                Date of Birth
                <div class="display-flex">
                    <input type="date" name="DOB" class="form-input">
                    <div class="form-input" id="hidden-form-input"></div>
                </div>
            </div>
            <div class="form-label">
                <div class="form-label-item">Email</div>
                <div class="form-label-item">Contact</div>
            </div>
            <div class="display-flex">
                <input type="email" name="emali" placeholder="user@example.com" class="form-input">
                <input type="tel" name="contact" class="form-input">
            </div>
            <div class="form-label">
                <div class="form-label-item">Department</div>
                <div class="form-label-item">Semester</div>
            </div>
            <div class="display-flex">
                <Select name="Department" class="form-input">
                    <option value="Science and Technology">Science and Technology</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Management">Management</option>
                    <option value="Education">Education</option>
                </Select>
                <Select name="Semester" class="form-input">
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
                <input type="file" name="Photo" id="photo-upload">
            </div>
            <button type="submit" name="submit" value="submit" id="submit-btn">Submit</button>
        </div>
    </div>
</body>

</html>