<?php
require_once "../database/mysql_connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);




    $sql = "select * from student where email='$email'";
    $result2 = $conn->query($sql);
    if($result2->num_rows == 0){
        header("location:search_resutls.html?message=no result found");
        exit();
    }else{
        $row = $result2->fetch_assoc();
        if($email==$row['email']&&$password==$row['password']){
            $program = $row['program'];
            $semester = $row["semester"];
            $student_id = $row['id'];
            $sql="select * from examination where program='$program' and semester='$semester'";
            $result=$conn->query($sql);
            $exams = $result -> fetch_all(MYSQLI_ASSOC);
        }else{
            header("location:search_results.html?message=email or password is wrong");
            exit();
        }
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marksheet</title>
    <link rel="stylesheet" href="marksheet_styles.css">
</head>
<body>

    <div class="container">
        <div class="details">
            <div class="details-left">
                <p><strong>Name:</strong> <?php echo $row['first_name'].' '.$row['last_name'];?></p>
                <p><strong>Department:</strong> <?php echo $row['department'];?></p>
                <p><strong>Semester:</strong> <?php echo $row['semester'];?></p>
                <p><strong>Program:</strong> <?php echo $row['program'];?></p>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Subject</th>
                        <th>Total Marks</th>
                        <th>Obtained Marks</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    for($i=0;$i<count($exams);$i++){
                    $exam_id=$exams[$i]['id'];
                    $sql="select DISTINCT * from manage_exam inner join questions on manage_exam.question_id=questions.id where questions.examination_id='$exam_id' and manage_exam.student_id='$student_id' ORDER BY manage_exam.question_id ASC";
                    $manage_exam_result = $conn->query($sql);
                    $manage_exam = $manage_exam_result -> fetch_all(MYSQLI_ASSOC);
   
                    $marks=0;
                    for($j=0;$j<count($manage_exam);$j++){
                        if($manage_exam[$j]['correct']==$manage_exam[$j]['student_option']){
                            $marks++;
                        }
                    }
                    if(count($manage_exam)!=0){
                    ?>
                    <tr>
                        <td><?php echo $i+1;?></td>
                        <td><?php echo $exams[$i]['subject'];?></td>
                        <td><?php echo count($manage_exam);?></td>
                        <td><?php echo $marks; ?></td>
                        <td><?php if($marks*100/count($manage_exam)>40) echo "Pass"; else echo "Fail";?></td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>&copy; 2024 Far Western University. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
