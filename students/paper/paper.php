<?php
include_once "../../login/student_session_check.php";
include_once "../../database/mysql_connection.php";
$user_email=$_SESSION['email'];

$sql = "select first_name,last_name,program,semester from student where email = '$user_email'";
$result = $conn -> query($sql);
$user_row= $result->fetch_assoc();

$program = $user_row['program'];
$semester = $user_row['semester'];

$currentDate = date('Y-m-d');
$sql = "select * from examination where program='$program' and semester='$semester' and exam_date = '$currentDate'";
$result = $conn -> query($sql);

if($result->num_rows==0){
    header("location:../paper_not_found/paper_not_found.php");
    exit();
}
$exam_row= $result->fetch_assoc();
$exam_id = $exam_row['id'];

$sql = "select * from questions where examination_id='$exam_id'";
$result = $conn -> query($sql);
$number_of_questions = $result -> num_rows;
$questions = $result -> fetch_all(MYSQLI_ASSOC);

if(isset($_POST['question'])){
    $current_question = (int)$_POST["question"];
}else{
    $current_question = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Examination System</title>
    <link rel="stylesheet" href="paper_styles.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="../../assets/images/logo_with_text.png" alt="Far Western University">
        </div>
        <div class="candidate-info">
            <img src="../../assets/icons/user-solid.svg" alt="User Icon">
            <div class="info">
                <div class="info-row">
                    <div>Student Name:</div> <span><?php echo $user_row['first_name']." ".$user_row['last_name'];?></span>
                </div>
                <div class="info-row">
                    <div>Subject Name:</div> <span class="subject-name"><?php echo $exam_row['subject'];?></span>
                </div>
                <div class="info-row">
                    <div>Remaining Time:</div> <span ><span id="remaining-time">02:59:39</span></span>
                </div>
            </div>
        </div>        
    </div>
    <div class="main-content">
        <div class="left-section">
            <div class="question-section">
                <div class="question-header">
                    <h2>Question <?php echo $current_question ?>:</h2>
                </div>
                <div class="question-body">
                    <p><?php echo $questions[$current_question-1]['question']; ?></p>
                    <ul>
                        <li><input type="radio" name="answer" id="option1"><label for="option1"><?php echo $questions[$current_question-1]['option_1']; ?></label></li>
                        <li><input type="radio" name="answer" id="option2"><label for="option2"><?php echo $questions[$current_question-1]['option_2']; ?></label></li>
                        <li><input type="radio" name="answer" id="option3"><label for="option3"><?php echo $questions[$current_question-1]['option_3']; ?></label></li>
                        <li><input type="radio" name="answer" id="option4"><label for="option4"><?php echo $questions[$current_question-1]['option_4']; ?></label></li>
                    </ul>
                </div>
            </div>
            <div class="navigation-buttons">
                <div>
                    <form method="post">
                        <input type="hidden" name="question" value="<?php if($current_question==1)echo $current_question;else echo $current_question-1;?>">
                    <button class="previous">PREVIOUS</button>
                    </form>
                    <form method="post">
                        <input type="hidden" name="question" value="<?php if($current_question==$number_of_questions)echo $current_question;else echo $current_question+1;?>">
                    <button class="next">NEXT</button>
                    </form>
                    <span id="space"> </span>
                    <button class="mark-review">MARK FOR REVIEW</button>
                    <button class="clear-response">CLEAR RESPONSE</button>
                </div>
                <button class="submit">SUBMIT</button>
            </div>
        </div>
        <div class="right-section">
            <div class="status">
                <div class="status-item">
                    <span class="status-color not-visited"></span> Not Visited
                </div>
                <div class="status-item">
                    <span class="status-color not-answered"></span> Not Answered
                </div>
                <div class="status-item">
                    <span class="status-color answered"></span> Answered
                </div>
                <div class="status-item">
                    <span class="status-color marked-review"></span> Marked for Review
                </div>
            </div>
            <div class="question-nav">
                <form method="post">
                    <input type="hidden" name="question" value="1">
                    <button type="submit" class="question-number <?php if($current_question == 1) echo 'active'; ?>">1</button>
                </form>
                <?php
                for($i = 2; $i <= $number_of_questions; $i++){
                ?>
                <form method="post">
                    <input type="hidden" name="question" value="<?php echo $i; ?>">
                    <button type="submit" class="question-number <?php if($current_question == $i) echo 'active'; ?>"><?php echo $i; ?></button>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="paper_script.js"></script>
</body>
</html>