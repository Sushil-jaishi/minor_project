<?php
include_once "../login/student_session_check.php";
include_once "../database/mysql_connection.php";
$user_email=$_SESSION['email'];

date_default_timezone_set('Asia/Kathmandu');
$sql = "select * from student where email = '$user_email'";
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
}else{
    $row= $result->fetch_assoc();
}

//fetching all the questions
$exam_id = $row['id'];
$sql = "select * from questions where examination_id='$exam_id' ORDER BY id ASC";
$result = $conn -> query($sql);
$number_of_questions = $result -> num_rows;
$questions = $result -> fetch_all(MYSQLI_ASSOC);

$first_question_id = $questions[0]['id'];
$sql = "select * from manage_exam where student_id='$student_id' and question_id='$first_question_id'";
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

$marks=0;
for($i=0;$i<$number_of_questions;$i++){
    if($questions[$i]['correct']==$manage_exam[$i]['student_option']){
        $marks++;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
    <link rel="stylesheet" href="results_styles.css">
</head>
<body>
    <div class="results-container">
        <h1>Exam Results</h1>
        
        <div class="student-info">
            <p><strong>Student Name:</strong> <?php echo $user_row['first_name'].' '.$user_row['last_name']; ?></p>
            <p><strong>Program:</strong> <?php echo $user_row['program']; ?></p>
            <p><strong>Semester:</strong> <?php echo $user_row['semester']; ?></p>
            <p><strong>Subject:</strong> <?php echo $row['subject']; ?></p>
            <p><strong>Date:</strong> <?php echo $row['exam_date']; ?></p>
        </div>

        <div class="results-summary">
            <h2>Summary</h2>
            <p><strong>Total Questions:</strong> <?php echo $number_of_questions;?></p>
            <p><strong>Correct Answers:</strong> <?php echo $marks; ?></p>
            <p><strong>Percentage:</strong> <?php echo $marks*100/$number_of_questions;?>%</p>
            <p><strong>Status:</strong> <?php if(($marks*100/$number_of_questions)<40){?><span class="failed">failed</span><?php }else{ ?><span class="passed">passed</span><?php }?></p>
        </div>

        <div class="question-results">
            <h2>Question-wise Performance</h2>
            <table>
                <thead>
                    <tr>
                        <th>Q. No</th>
                        <th>Question</th>
                        <th>Your Answer</th>
                        <th>Correct Answer</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    for($i=0;$i<$number_of_questions;$i++){
                    ?>
                    <tr>
                        <td><?php echo $i+1;?></td>
                        <td><?php echo $questions[$i]["question"]?></td>
                        <td><?php if(isset($questions[$i]["option_".$manage_exam[$i]['student_option']]))echo $questions[$i]["option_".$manage_exam[$i]['student_option']];?></td>
                        <td><?php echo $questions[$i]["option_".$questions[$i]['correct']];?></td>
                        <td><?php if($manage_exam[$i]['student_option']==$questions[$i]['correct']){?><span class="correct">Correct</span><?php }else{?><span class="wrong">Wrong</span><?php }?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
