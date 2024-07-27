<?php
include_once "../../login/student_session_check.php";
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
                    <div>Student Name:</div> <span>Manisha Badal</span>
                </div>
                <div class="info-row">
                    <div>Subject Name:</div> <span class="subject-name">Research and Methodology</span>
                </div>
                <div class="info-row">
                    <div>Starting Time:</div> <span><span id="remaining-time">02:59:39</span></span>
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
                    <li>Total duration of Research and Methodology is 180 min.</li>
                    <li>The clock will be set at the server. The countdown timer in the top right corner of the screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</li>
                    <li>The Questions Palette displayed on the right side of the screen will show the status of each question using one of the following symbols:</li>
                    <ul id="questions-palette">
                        <li><span class="not-visited-icon"></span> You have not visited the question yet.</li>
                        <li><span class="not-answered-icon"></span> You have not answered the question.</li>
                        <li><span class="answered-icon"></span> You have answered the question.</li>
                        <li><span class="marked-review-icon"></span> You have NOT answered the question, but have marked the question for review.</li>
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
                </ol>
            </div>
            <div class="answering-question">
                <h3>Answering a Question:</h3>
                <ol>
                    <li>Procedure for answering a multiple choice type question:</li>
                    <ol>
                        <li>To select your answer, click on the button of one of the options.</li>
                        <li>To deselect your chosen answer, click on the button of the chosen option again or click on the "Clear Response" button.</li>
                        <li>To change your chosen answer, click on the button of another option.</li>
                        <li>To save your answer, you MUST click on the "Save & Next" button.</li>
                        <li>To mark the question for review, click on the "Mark for Review & Next" button.</li>
                    </ol>
                    <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li>
                </ol>
            </div>
            <div class="navigating-sections">
                <h3>Navigating through sections:</h3>
                <ol>
                    <li>Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by clicking on the section name. The section you are currently viewing is highlighted.</li>
                    <li>After clicking the "Save & Next" button on the last question for a section, you will automatically be taken to the first question of the next section.</li>
                    <li>You can shuffle between sections and questions anytime during the examination as per your convenience only during the time stipulated.</li>
                    <li>The candidate can view the corresponding section summary as part of the legend that appears in every section above the question palette.</li>
                </ol>
            </div>
            <div class="note">
                <p>Please note all questions will appear in your default language. This language can be changed for a particular question later on.</p>
            </div>
            <div class="confirmation">
                <label>
                    <input type="checkbox"> I have read and understood the instructions. All computer hardware allotted to me is in proper working condition. I declare that I am not in possession of / not wearing / not carrying any prohibited gadget like mobile phone, Bluetooth devices etc. / any prohibited material with me into the Examination Hall. I agree that in case of not adhering to the instructions, I shall be liable to be debarred from this Test and/or to disciplinary action, which may include ban from future Tests / Examinations.
                </label>
            </div>
            <div class="proceed-button">
                <button>PROCEED</button>
            </div>
        </div>
    </div>
</body>
</html>
