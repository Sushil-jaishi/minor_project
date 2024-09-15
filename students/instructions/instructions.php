<?php
include_once "../../login/student_session_check.php";
include_once "../../database/mysql_connection.php";
$user_email=$_SESSION['email'];

date_default_timezone_set('Asia/Kathmandu');
$sql = "select first_name,last_name,program,semester from student where email = '$user_email'";
$result = $conn -> query($sql);
$user_row= $result->fetch_assoc();

$program = $user_row['program'];
$semester = $user_row['semester'];

$currentDate = date('Y-m-d');
$sql = "select * from examination where program='$program' and semester='$semester' and exam_date = '$currentDate'";
$result = $conn -> query($sql);

if($result->num_rows==0){
    header("location:../no_exams_today/no_exams_today.html");
    exit();
}else{
    $exam_row= $result->fetch_assoc();
}
//exam time checking
$exam_start_time = $exam_row['exam_date'].' '.$exam_row['exam_time'].":00";
$exam_duration = $exam_row['duration'];
$duration = date('H:i:s', strtotime("00:00:00" . " + $exam_duration minutes"));
$exam_end_time = date('Y-m-d H:i:s', strtotime($exam_start_time . " + $exam_duration minutes"));
$current_date_time = date('Y-m-d H:i:s');
if(!($exam_end_time>=$current_date_time)){
    header("location:../../results/results.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Examination System</title>
    <link rel="stylesheet" href="instructions_styles.css">
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
                    <div>Starting Time:</div> <span><span id="remaining-time"><?php echo $duration;?></span></span>
                </div>
            </div>
        </div>        
    </div>
    <div class="main-content">
        <div class="instructions">
            <h2>Please read the instructions carefully</h2>
            <div class="general-instructions">
                <h3>General Instructions:</h3>
                <ol>
                    <li>Total duration of <?php echo $exam_row['subject'];?> is <?php echo $exam_row['duration'];?> min.</li>
                    <li>The clock will be set at the server. The countdown timer in the top right corner of the screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself and submitted.</li>
                    <li>The Questions Palette displayed on the right side of the screen will show the status of each question using one of the following symbols:</li>
                    <ul id="questions-palette">
                        <li><span class="not-visited-icon"></span> You have not visited the question yet.</li>
                        <li><span class="not-answered-icon"></span> You have not answered the question.</li>
                        <li><span class="answered-icon"></span> You have answered the question.</li>
                        <li><span class="marked-review-icon"></span> You have marked the question for review.</li>
                    </ul>
                </ol>
            </div>
            <div class="navigating-question">
                <h3>Navigating to a Question:</h3>
                <ol>
                    <li>To answer a question, do the following:</li>
                    <ol>
                        <li>Click on the question number in the Question Palette on the right of your screen to go to that numbered question directly.</li>
                        <li>Click on "Mark for Review" to save your answer for the current question, mark it for review, and then go to the next question.</li>
                    </ol>
                    <li>Procedure for answering a multiple choice type question:</li>
                    <ol>
                        <li>To select your answer, click on the button of one of the options.</li>
                        <li>To deselect your chosen answer, click on the "Clear Response" button.</li>
                        <li>To change your chosen answer, click on the button of another option.</li>
                        <li>To save your answer, just click to the "next" button or go to another question from question palette.</li>
                    </ol>
                    <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that question.</li>
                </ol>
            </div>
            <div class="proceed-button">
                <a href="../paper/paper.php" id="proceed"><button id="myButton" disabled>PROCEED</button></a>
            </div>
        </div>
    </div>
    <script>
        var current_time_server= new Date("<?php echo $current_date_time;?>").getTime();
        var end_time= new Date("<?php echo $exam_start_time;?>").getTime();
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
            
            if (remaining_time <= 1000) {
                clearInterval(timer);
                document.getElementById("remaining-time").innerHTML = "00:00:00";
            }
            if(document.getElementById("remaining-time").innerHTML=="00:00:00"){
                console.log("hello");
                document.getElementById("myButton").removeAttribute("disabled");
            }
        }, 1000);
    </script>
</body>
</html>
