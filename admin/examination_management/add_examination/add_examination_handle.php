<?php

require_once "../../../database/mysql_connection.php";

if(isset($_POST['submit'])){

    $department = $_POST['department'];
    $program = $_POST['program'];
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];
    $exam_date = $_POST['exam_date'];
    $exam_duration = $_POST['exam_duration'];

    //check if any field is empty 
    $form_data=array(
        "department" => $department,
        "program" => $program,
        "semester" => $semester,
        "subject" => $subject,
        "exam date" => $exam_date,
        "exam duration" => $exam_duration
    );
    foreach ($form_data as $key => $value) {
        if(empty($form_data[$key])){
            header("location:add_examination.php?success=false&message=$key is required");
            exit();
        }
    }

    $questions = $_POST['questions'];
    $options_1 = $_POST['option_1'];
    $options_2 = $_POST['option_2'];
    $options_3 = $_POST['option_3'];
    $options_4 = $_POST['option_4'];
    $corrects = $_POST['correct'];

    for($i=0; $i<count($questions); $i++){
        $question = $questions[$i];
        $option_1 = $options_1[$i];
        $option_2 = $options_2[$i];
        $option_3 = $options_3[$i];
        $option_4 = $options_4[$i];
        $correct = $corrects[$i];

        //check if any field is empty 
        $form_data=array(
            "Question ".$i+1 => $question,
            "Option 1 of Question ".$i+1 => $option_1,
            "Option 2 of Question ".$i+1 => $option_2,
            "Option 3 of Question ".$i+1 => $option_3,
            "Option 4 of Question ".$i+1 => $option_4,
            "Correct answer of Question ".$i+1 => $correct,
        );
        foreach ($form_data as $key => $value) {
            if(empty($form_data[$key])){
                header("location:add_examination.php?success=false&message=$key is required");
                exit();
            }
        }

        //adding examination
        if($i==0){
            $sql = "INSERT INTO examination (department, program, semester, subject, exam_date, duration)
            VALUES ('$department', '$program', '$semester', '$subject', '$exam_date', '$exam_duration')";

            if($conn->query($sql)){
                //examination has been added successfully
            }else{
                echo "failed to add examination".$conn->error;
                exit();
            }

            //getting examination id
            $sql = "SELECT id FROM examination ORDER BY id DESC LIMIT 1";
            $results = $conn->query($sql);
            $row = $results->fetch_assoc();
            $examination_id = (int)$row['id'];
        }

        //adding questions
        $sql = "INSERT INTO questions (question, option_1, option_2, option_3, option_4, correct, examination_id)
        VALUES ('$question', '$option_1', '$option_2', '$option_3', '$option_4', $correct, $examination_id)";

        if($conn->query($sql)){
            //examination has been added successfully
        }else{
            echo "failed to add question".$conn->error;
            exit();
        }
    }
    //redirect to the frontend part after successfully added examination
    header("location:add_examination.php?success=true&message=Examination has been added successfully");
    exit();
}

?>