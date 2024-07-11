<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/header-sidebar-styles.css">
    <link rel="stylesheet" href="../assets/css/add_examination.css">
</head>

<body>

    <?php include_once "header-sidebar.php"; ?>

    <div id="heading-add-examination">Add Examination</div>








    <!-- student added/error message -->
    <?php
    if(isset($_GET['success'])){
        echo '<div id='.$_GET['success'].'>'.$_GET['message'].'</div>';
    }
    ?>

    <div class="content-section">
        <form method="post" enctype="multipart/form-data" action="add_examination_handle.php">


            <div class="form-label">
                <div class="form-label-item">Department</div>
                <div class="form-label-item">Program</div>
            </div>
            <div class="display-flex">
                <Select name="department" class="form-input">
                    <option value="Science and Technology">Science and Technology</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Management">Management</option>
                    <option value="Education">Education</option>
                </Select>
                <Select name="program" class="form-input">
                    <option value="BSc.">BSc.</option>
                    <option value="BSc. CSIT">BSc. CSIT</option>
                    <option value="BBA">BBA</option>
                    <option value="BBS">BBS</option>
                </Select>
            </div>

            <div class="form-label">
                <div class="form-label-item">Semester</div>
                <div class="form-label-item">Subject</div>
            </div>
            <div class="display-flex">
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
                <Select name="subject" class="form-input">
                    <option value="NM">NM</option>
                    <option value="SAD">SAD</option>
                    <option value="TOC">TOC</option>
                </Select>
            </div>

            <div class="form-label">
                <div class="form-label-item">Exam Date</div>
                <div class="form-label-item">Exam Duration</div>
            </div>
            <div class="display-flex">
                <input type="date" name="exam_date" class="form-input" required>
                <input type="number" name="exam_duration" placeholder="1 hr" class="form-input" required>
            </div>

            <div>
                Question 1 
                <div class="display-flex">
                    <textarea name="first_name" rows="2" placeholder="Write your question" class="form-input questions"
                        required></textarea>
                </div>
            </div>

            <div class="display-flex">
                <input type="radio" name="gender" value="male">
                <input type="email" name="email" placeholder="Option 1" class="form-input answers" required>
            
                <input type="radio" name="gender" value="male">
                <input type="email" name="email" placeholder="Option 2" class="form-input answers" required>
            </div>

            <div class="display-flex">
                <input type="radio" name="gender" value="male">
                <input type="email" name="email" placeholder="Option 3" class="form-input answers" required>
            
                <input type="radio" name="gender" value="male">
                <input type="email" name="email" placeholder="Option 4" class="form-input answers" required>
            </div>

            <div class="display-flex bottom-btn">
                <button type="button" name="add_question" id="submit-btn">Add Question</button>
                <button type="submit" name="submit" value="submit" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
    </div>
</body>
<script src="../assets/js/register_student.js"></script>

</html>