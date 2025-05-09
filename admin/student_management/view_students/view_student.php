<?php
include_once "../../../login/admin_session_check.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../includes/header-sidebar/header-sidebar-styles.css">
    <link rel="stylesheet" href="view_student_styles.css">
</head>

<body>
    <?php include_once "../../../includes/header-sidebar/header-sidebar.php"; ?>


        <div id="heading-students">Students</div>

        <!-- student edit/delete message -->
        <?php
        if(isset($_GET['success'])){
            echo '<div id='.$_GET['success'].'>'.$_GET['message'].'</div>';
        }
        ?>
        
        <div class="content-section">
            <div id="search-filter-heading">
                <div>
                    Show
                    <select id="num-of-entries">
                        <option>10</option>
                    </select>
                    Entries
                </div>
            </div>
            <hr>
            <table id="student-list">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Program</th>
                        <th>Semester</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <?php
                require_once "../../../database/mysql_connection.php";


                // $pages refers to the total number of pages of the record and $page refers to specific page to be displayed

                $sql= "SELECT count(id) as count_id from student";
                $count_id_result = $conn->query($sql);
                $num_rows = $count_id_result->fetch_assoc()["count_id"];
                $limit = 10;
                
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                }
                
                $pages = ceil($num_rows/$limit);
                $offset = ($page-1)*$limit;


                $sql = "select * from student limit $limit offset $offset";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                ?>

                        <tbody>
                            <tr>
                                <td><img src="../../../assets/images/uploads/<?php echo $row['photo']; ?>" alt="Profile" id="student-profile-image"></td>
                                <td><?php echo $row['first_name']. ' ' . $row['last_name']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['program']; ?></td>
                                <td><?php echo $row['semester']; ?></td>
                                <td>
                                    <a href="../edit_student/edit_student.php?id=<?php echo $row['id']; ?>"><img src="../../../assets/icons/pen-to-square-regular.svg" alt="edit" id="edit"></a>
                                    <a href="../delete_student.php?id=<?php echo $row['id']; ?>" onclick= "return confirm('are you sure want to delete')"><img src="../../../assets/icons/trash-can-regular.svg" alt="delete" id="delete"></a>
                                </td>
                            </tr>
                        </tbody>

                <?php
                    }
                }
                ?>


            </table>
        </div>
        <div id="entries-footer">
            <div>Showing <?php echo $offset+1 ?> to <?php echo $offset+$result -> num_rows; ?> of <?php echo $num_rows; ?> entries</div>
            <div>
                <a class="footer-btn" href="?page=<?php if($page>1){echo $page-1;} else {echo $page;} ?>">previous</a>

                <?php
                for($i=1;$i<=$pages;$i++){
                ?>
                <a class="footer-btn" id="<?php if($i==$page){echo "active";} ?>" href="?page=<?php echo $i ?>"><?php echo $i; ?></a>
                <?php
                }
                ?>

                <!-- <button type="button" class="footer-btn" id="active">1</button>
                <button type="button" class="footer-btn">2</button>
                <button type="button" class="footer-btn">3</button> -->
                
                <a class="footer-btn" href="?page=<?php if($page<$pages){echo $page+1;} else {echo $page;} ?>">Next</a>
            </div>
        </div>
    </div>
</body>
<script src="view_student.js"></script>

</html>