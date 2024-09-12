your project should be inside xampp/htdocs folder in order to run it by php
your project name should be minor_project because in some areas such as login session management we use absolute path (http://localhost/minor_project/)
you have to create database and tables in the following sequences
    1. create_database.php
    2. admin_table.php
    3. student_table.php
    4. examination_table.php
    5. questions_table.php
    6. manage_exam_table.php
tables are referenced with each other so the order of the table creation is required.
