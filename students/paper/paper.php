<?php
include_once "../../login/student_session_check.php";
include_once "../../database/mysql_connection.php";
$user_email=$_SESSION['email'];

date_default_timezone_set('Asia/Kathmandu');
$sql = "select id,first_name,last_name,program,semester from student where email = '$user_email'";
$result = $conn -> query($sql);
$user_row= $result->fetch_assoc();

$student_id = $user_row['id'];
$program = $user_row['program'];
$semester = $user_row['semester'];

$currentDate = date('Y-m-d');
$sql = "select * from examination where program='$program' and semester='$semester' and exam_date = '$currentDate'";
$result = $conn -> query($sql);

if($result->num_rows==0){
    header("location:../no_exams_today/no_exams_today.html");
    exit();
}
$exam_row= $result->fetch_assoc();
$exam_id = $exam_row['id'];
//exam time checking
$exam_start_time = $exam_row['exam_date'].' '.$exam_row['exam_time'].":00";
$exam_duration = $exam_row['duration'];
$exam_end_time = date('Y-m-d H:i:s', strtotime($exam_start_time . " + $exam_duration minutes"));
$current_date_time = date('Y-m-d H:i:s');
if(!($exam_start_time<=$current_date_time && $exam_end_time>=$current_date_time)){
    header("location:../../results/results.php");
    exit();
}

//fetch all questions from the database
$sql = "select * from questions where examination_id='$exam_id' ORDER BY id ASC";
$result = $conn -> query($sql);
$number_of_questions = $result -> num_rows;
$questions = $result -> fetch_all(MYSQLI_ASSOC);

if(isset($_POST['question'])){
    $current_question = (int)$_POST["question"];
}else if(isset($_POST['question_review'])){
    $current_question = (int)$_POST["question_review"];
    $status="review";
}else{
    $current_question = 1;
}
if(isset($_POST['current_question_id'])){
    $question_id_for_database = $_POST['current_question_id'];
}
if(isset($_POST['answer'])){
    $answer = $_POST['answer'];
    if(isset($status)){
        $sql = "update manage_exam set student_option='$answer', status='$status' where student_id='$student_id' and question_id = '$question_id_for_database'";
    }else{
        $sql = "update manage_exam set student_option='$answer', status='answered' where student_id='$student_id' and question_id = '$question_id_for_database'";
    }
    $conn->query($sql);
}

if(isset($_POST['current_question_id'])&&!isset($_POST['answer'])){
    if(isset($status)){
        $sql = "update manage_exam set student_option=NULL, status='$status' where student_id='$student_id' and question_id = '$question_id_for_database'";
    }else{
        $sql = "update manage_exam set student_option=NULL, status='not_answered' where student_id='$student_id' and question_id = '$question_id_for_database'";
    }
    $conn->query($sql);
}

$current_question_id = $questions[$current_question-1]['id'];
$sql = "select * from manage_exam where student_id='$student_id' and question_id='$current_question_id'";
$students_data_initialization_result = $conn -> query($sql);

if($students_data_initialization_result->num_rows==0){
    //initialize the database for student
    for($i=1;$i<=$number_of_questions;$i++){
        $question_id = $questions[$i-1]['id'];
        $sql = "insert into manage_exam (student_id,question_id) values ('$student_id','$question_id')";
        $conn -> query($sql);
    }
}

$sql="select DISTINCT manage_exam.* from manage_exam inner join questions on manage_exam.question_id=questions.id where questions.examination_id='$exam_id' and manage_exam.student_id='$student_id' ORDER BY manage_exam.question_id ASC;";
$manage_exam_result = $conn->query($sql);
$manage_exam = $manage_exam_result -> fetch_all(MYSQLI_ASSOC);

$sql="select student_option from manage_exam where student_id = '$student_id' and question_id = '$current_question_id'";
$option_result = $conn -> query($sql);
$student_option_array = $option_result->fetch_assoc();
$student_option = $student_option_array['student_option'];
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
                    <div>Remaining Time:</div> <span ><span id="remaining-time"><?php if(isset($_POST["previous_time_before_submission"]))echo $_POST['previous_time_before_submission']; else echo "00:00:00"; ?></span></span>
                </div>
            </div>
        </div>        
    </div>
    <form method="post">
        <div class="main-content">
            <div class="left-section">
                <div class="question-section">
                    <div class="question-header">
                        <h2>Question <?php echo $current_question ?>:</h2>
                    </div>
                    <div class="question-body">
                        <p><?php echo $questions[$current_question-1]['question']; ?></p>
                        <input type="hidden" name="current_question_id" value="<?php echo $questions[$current_question-1]['id']; ?>">
                        <ul>
                            <li><input type="radio" name="answer" id="option1" value="1" <?php if($student_option=='1'){echo 'checked';} ?>><label for="option1"><?php echo $questions[$current_question-1]['option_1']; ?></label></li>
                            <li><input type="radio" name="answer" id="option2" value="2" <?php if($student_option=='2'){echo 'checked';} ?>><label for="option2"><?php echo $questions[$current_question-1]['option_2']; ?></label></li>
                            <li><input type="radio" name="answer" id="option3" value="3" <?php if($student_option=='3'){echo 'checked';} ?>><label for="option3"><?php echo $questions[$current_question-1]['option_3']; ?></label></li>
                            <li><input type="radio" name="answer" id="option4" value="4" <?php if($student_option=='4'){echo 'checked';} ?>><label for="option4"><?php echo $questions[$current_question-1]['option_4']; ?></label></li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="previous_time_before_submission" id="remaining_time_2" value="<?php if(isset($_POST["previous_time_before_submission"]))echo $_POST["previous_time_before_submission"];?>">
                <div class="navigation-buttons">
                    <div>
                        <button type="submit" class="previous" name="question" value="<?php if($current_question==1)echo $current_question;else echo $current_question-1;?>">PREVIOUS</button>
                        <button type="submit" class="next" name="question" value="<?php if($current_question==$number_of_questions)echo $current_question;else echo $current_question+1;?>">NEXT</button>
                        <span id="space"> </span>
                        <button type="submit" class="mark-review" name="question_review" value="<?php if($current_question==$number_of_questions)echo $current_question;else echo $current_question+1;?>">MARK FOR REVIEW</button>
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
                    <button type="submit" class="question-number <?php if($current_question == 1) echo 'active'; else if($manage_exam[0]['status']=='answered') echo 'answered'; else if($manage_exam[0]['status']=='not_answered') echo 'not_answered'; else if($manage_exam[0]['status']=='review') echo 'review';?>" name="question" value="1">1</button>
                    <?php
                    for($i = 2; $i <= $number_of_questions; $i++){
                    ?>
                    <button type="submit" class="question-number <?php if($current_question == $i) echo 'active'; else if($manage_exam[$i-1]['status']=='answered') echo 'answered'; else if($manage_exam[$i-1]['status']=='not_answered') echo 'not_answered'; else if($manage_exam[$i-1]['status']=='review') echo 'review';?>" name="question" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
    <script>
        var current_time_server= new Date("<?php echo $current_date_time;?>").getTime();
        var end_time= new Date("<?php echo $exam_end_time;?>").getTime();
        var current_time_client= new Date().getTime();
        var time_difference = current_time_client-current_time_server;
        var timer = setInterval(function() {
            var now = new Date().getTime();
            var remaining_time=end_time-now-time_difference;

            var hours = Math.floor((remaining_time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((remaining_time % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remaining_time % (1000 * 60)) / 1000);
            
            hours = hours.toString().padStart(2, '0');
            minutes = minutes.toString().padStart(2, '0');
            seconds = seconds.toString().padStart(2, '0');
            
            document.getElementById("remaining-time").innerHTML = hours + ":" + minutes + ":" + seconds;
            document.getElementById("remaining_time_2").value = hours + ":" + minutes + ":" + seconds;
            
            if (remaining_time <= 1000) {
                clearInterval(timer);
                document.getElementById("remaining-time").innerHTML = "00:00:00";
            }
        }, 1000);
    </script>
</body>
</html>