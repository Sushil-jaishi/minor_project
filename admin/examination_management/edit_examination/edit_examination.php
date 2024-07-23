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

    <div id="heading-add-examination">Add Examination</div>

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
        $sql= "select * from examination where id='$id'";
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
<script src="../register_admin/register_admin.js"></script>

</html>


<!-- this is main secton above section should be removed -->

        <div class="content-section">
            <form method="post" enctype="multipart/form-data" action="edit_examination_handle.php">

                <div class="form-label">
                    <div class="form-label-item">Department</div>
                    <div class="form-label-item">Program</div>
                </div>
                <div class="display-flex">
                    <Select name="department" class="form-input">
                        <option value="Science and Technology" <?php if($row['department']=='Science and Technology'){echo 'selected';} ?>>Science and Technology</option>
                        <option value="Engineering" <?php if($row['department']=='Engineering'){echo 'selected';} ?>>Engineering</option>
                        <option value="Management" <?php if($row['department']=='Management'){echo 'selected';} ?>>Management</option>
                        <option value="Education" <?php if($row['department']=='Education'){echo 'selected';} ?>>Education</option>
                    </Select>
                    <Select name="program" class="form-input">
                        <option value="BSc." <?php if($row['program']=='BSc.'){echo 'selected';} ?>>BSc.</option>
                        <option value="BSc. CSIT" <?php if($row['program']=='BSc. CSIT'){echo 'selected';} ?>>BSc. CSIT</option>
                        <option value="BBA" <?php if($row['program']=='BBA'){echo 'selected';} ?>>BBA</option>
                        <option value="BBS" <?php if($row['program']=='BBS'){echo 'selected';} ?>>BBS</option>
                    </Select>
                </div>

                <div class="form-label">
                    <div class="form-label-item">Semester</div>
                    <div class="form-label-item">Subject</div>
                </div>
                <div class="display-flex">
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
                    <Select name="subject" class="form-input">
                        <option value="NM" <?php if($row['subject']=='NM'){echo 'selected';} ?>>NM</option>
                        <option value="SAD" <?php if($row['subject']=='SAD'){echo 'selected';} ?>>SAD</option>
                        <option value="TOC" <?php if($row['subject']=='TOC'){echo 'selected';} ?>>TOC</option>
                    </Select>
                </div>

                <div class="form-label">
                    <div class="form-label-item">Exam Date</div>
                    <div class="form-label-item">Exam Duration</div>
                </div>
                <div class="display-flex">
                    <input type="date" name="exam_date" class="form-input" value="<?php echo $row['exam_date'] ?>" required>
                    <input type="number" name="exam_duration" placeholder="1 hr" class="form-input" value="<?php echo $row['duration'] ?>" required>
                </div>
<!-- done till here but not tested -->
                <div id="add-question">
                    <div>
                        <fieldset>
                            <legend>Question 1</legend>
                            <div class="display-flex">
                                <textarea name="questions[]" rows="2" placeholder="Write your question" class="form-input questions"
                                    required></textarea>
                            </div>
                            
                            <div class="display-flex">
                                <input type="radio" name="correct[0]" value="1" required>
                                <input type="text" name="option_1[]" placeholder="Option 1" class="form-input answers" required>
                                
                                <input type="radio" name="correct[0]" value="2">
                                <input type="text" name="option_2[]" placeholder="Option 2" class="form-input answers" required>
                            </div>
                            
                            <div class="display-flex">
                                <input type="radio" name="correct[0]" value="3">
                                <input type="text" name="option_3[]" placeholder="Option 3" class="form-input answers" required>
                                
                                <input type="radio" name="correct[0]" value="4">
                                <input type="text" name="option_4[]" placeholder="Option 4" class="form-input answers" required>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="display-flex bottom-btn">
                    <button type="button" name="add_question" id="submit-btn" onclick="addQuestion()">Add Question</button>
                    <button type="submit" name="submit" value="submit" id="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
<script src="./register_student.js"></script>

</html>
