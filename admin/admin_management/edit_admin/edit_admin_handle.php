<?php

require_once "../../../database/mysql_connection.php";

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $email = strtolower($_POST['email']);
    $password = md5($dob);
    $old_image= $_POST['old_image'];
    $id=$_POST['id'];
    $old_email= $_POST['old_email'];

    //file handle
    if(is_uploaded_file($_FILES['photo']['tmp_name'])){ 
        $file_name = date('dmYHis').str_replace(" ","",basename($_FILES['photo']['name']));
        if($_FILES['photo']['error']>0){
            header("location:edit_admin.php?id=$id&success=false&message=Error occurred during image upload");
            exit();
        }
        if($_FILES['photo']['size']>5242880){
            header("location:edit_admin.php?id=$id&success=false&message=Photo size must be less than 5 MB");
            exit();
        }
        if($_FILES['photo']['type'] != 'image/png' && $_FILES['photo']['type'] != 'image/jpg' && $_FILES['photo']['type'] != 'image/jpeg'){
            header("location:edit_admin.php?id=$id&success=false&message=Invalid image format");
            exit();
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], "../../../assets/images/uploads/$file_name");
        unlink("../../../assets/images/uploads/$old_image");
    }else{
        $file_name = $old_image;
    }
    
    //check if any field is empty 
    $form_data=array(
        "first name" => $first_name,
        "last name" => $last_name,
        "email" => $email,
        "date of birth" => $dob,
        "contact" => $contact,
        "profile image" => $file_name
    );
    foreach ($form_data as $key => $value) {
        if(empty($form_data[$key])){
            header("location:edit_admin.php?id=$id&success=false&message=$key is required");
            exit();
        }
    }

    //check if the email is valid or not
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("location:edit_admin.php?id=$id&success=false&message=Email is invalid");
        exit();
    }
    
    // check if email is already exist
    $sql = "select email from admin where email='$email'";
    $result = $conn->query($sql);
 
    if(!($result->num_rows ==0 || ($result->num_rows ==1 && $email == $old_email))){
        header("location:edit_admin.php?id=$id&success=false&message=Email is already used");
        exit();
    }

    $sql="UPDATE admin SET photo = '$file_name', first_name='$first_name', last_name='$last_name', email= '$email', dob='$dob', contact='$contact', password='$password' where id='$id'";
    if($conn->query($sql)){
        //echo "query success";
        header('Location:../view_admin/view_admin.php?success=true&message=Admin records updated successfully');
        exit();
    }else{
        echo "query failed";
    }

}

?>