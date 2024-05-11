<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/admin_styles.css">
    <link rel="stylesheet" href="../assets/css/view_student_styles.css">
</head>

<body>
    <?php include_once "admin.php"; ?>

        <div id="heading-students">Students </div>
        <div class="content-section">
            <div id="search-filter-heading">
                <div>
                    Show
                    <select id="num-of-entries">
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                    Entries
                </div>
                <div>
                    <button type="button" id="filter"><img src="../assets/icons/arrow-up-wide-short-solid.svg"
                            alt="filter icon" id="filter-icon"> Filter</button>
                    <button type="button" id="search"><img src="../assets/icons/magnifying-glass-solid.svg"
                            alt="search icon" id="search-icon"> Search</button>
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
                <tbody>
                    <tr>
                        <td><img src="../assets/images/profile.png" alt="sushil jaishi" id="student-profile-image"></td>
                        <td>sushil jaishi</td>
                        <td>male</td>
                        <td>Science and technology</td>
                        <td>BSc. CSIT</td>
                        <td>sixth</td>
                        <td>
                            <a href="#"><img src="../assets/icons/pen-to-square-regular.svg" alt="edit" id="edit"></a>
                            <a href="#"><img src="../assets/icons/trash-can-regular.svg" alt="delete" id="delete"></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="../assets/images/profile.png" alt="sushil jaishi" id="student-profile-image"></td>
                        <td>sushil jaishi</td>
                        <td>male</td>
                        <td>Science and technology</td>
                        <td>BSc. CSIT</td>
                        <td>sixth</td>
                        <td>
                            <a href="#"><img src="../assets/icons/pen-to-square-regular.svg" alt="edit" id="edit"></a>
                            <a href="#"><img src="../assets/icons/trash-can-regular.svg" alt="delete" id="delete"></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="../assets/images/profile.png" alt="sushil jaishi" id="student-profile-image"></td>
                        <td>sushil jaishi</td>
                        <td>male</td>
                        <td>Science and technology</td>
                        <td>BSc. CSIT</td>
                        <td>sixth</td>
                        <td>
                            <a href="#"><img src="../assets/icons/pen-to-square-regular.svg" alt="edit" id="edit"></a>
                            <a href="#"><img src="../assets/icons/trash-can-regular.svg" alt="delete" id="delete"></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="../assets/images/profile.png" alt="sushil jaishi" id="student-profile-image"></td>
                        <td>sushil jaishi</td>
                        <td>male</td>
                        <td>Science and technology</td>
                        <td>BSc. CSIT</td>
                        <td>sixth</td>
                        <td>
                            <a href="#"><img src="../assets/icons/pen-to-square-regular.svg" alt="edit" id="edit"></a>
                            <a href="#"><img src="../assets/icons/trash-can-regular.svg" alt="delete" id="delete"></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="entries-footer">
            <div>Showing 1 to 10 of 50 entries</div>
            <div>
                <button type="button" class="footer-btn">previous</button>
                <button type="button" class="footer-btn" id="active">1</button>
                <button type="button" class="footer-btn">2</button>
                <button type="button" class="footer-btn">3</button>
                <button type="button" class="footer-btn">Next</button>
            </div>
        </div>
    </div>
</body>


</html>