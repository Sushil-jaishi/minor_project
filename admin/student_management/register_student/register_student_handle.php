<?php

require_once "../../../database/mysql_connection.php";

if(isset($_POST['submit'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $email = strtolower($_POST['email']);
    $department = $_POST['department'];
    $program = $_POST['program'];
    $semester = $_POST['semester'];
    $password = md5($dob);

    //file handle
    if(is_uploaded_file($_FILES['photo']['tmp_name'])){ 
        $file_name = date('dmYHis').str_replace(" ","",basename($_FILES['photo']['name']));
        if($_FILES['photo']['error']>0){
            header("location:register_student.php?success=false&message=Error occurs during image upload");
            exit();
        }
        if($_FILES['photo']['size']>5242880){
            header("location:register_student.php?success=false&message=photo size must be less than 5 mb");
            exit();
        }
        if($_FILES['photo']['type'] != 'image/png' && $_FILES['photo']['type'] != 'image/jpg' && $_FILES['photo']['type'] != 'image/jpeg'){
            header("location:register_student.php?success=false&message=invalid image format");
            exit();
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], "../../../assets/images/uploads/$file_name");
    }else{
        $file_name = "";
    }
    
    //check if any field is empty 
    $form_data=array(
        "first name" => $first_name,
        "last name" => $last_name,
        "email" => $email,
        "gender" => $gender,
        "date of birth" => $dob,
        "contact" => $contact,
        "department" => $department,
        "program" => $program,
        "semester" => $semester,
        "profile image" => $file_name
    );
    foreach ($form_data as $key => $value) {
        if(empty($form_data[$key])){
            header("location:register_student.php?success=false&message=$key is required");
            exit();
        }
    }

    //check if the email is valid or not
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("location:register_student.php?success=false&message=Email is invalid");
        exit();
    }
    
    // check if email is already exist
    $sql = "select email from student where email='$email'";
    $result = $conn->query($sql);
    if(!$result->num_rows == 0){
        header('location:register_student.php?success=false&message=Email is already used');
        exit();
    }

    //add student
    $sql = "INSERT INTO student (first_name, last_name, gender, dob, email, contact, department, program, semester, password, photo) 
    VALUES ('$first_name', '$last_name', '$gender', '$dob', '$email', '$contact', '$department', '$program', '$semester', '$password', '$file_name')";

    if($conn->query($sql)){
        header('location:register_student.php?success=true&message=Student has been added successfully');
        exit();
    }else{
        echo "failed to add student record".$conn->error;
    }
}

?>