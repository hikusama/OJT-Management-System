<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "SuperAdmin")) {
    header('location: ../index.php');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="tp.css?v=<?php echo time(); ?>">
    <!-- <script src="main.js?v=<?php echo time(); ?>"></script> -->

    <title>Document</title>
</head>

<body>
    <div class="bck"></div>

    <div class="outside">

        <div class="sideP">
            <div class="profSide">
                <img src="../images/mali.png" id="sidepic" alt="">
                <h2>Marco J.</h2>
                <style>
                    .profSide h2::before {
                        content: 'SuperAdmin';
                    }
                </style>
            </div>
            <nav>
                <ul id="tabs">
                    <label for="overviewbtn">
                        <i class="fas fa-tachometer-alt"></i>
                        <a id="overviewbtn" href="overview.php">overview</a>
                    </label>
                    <label for="coordinatorsbtn" class="on">
                        <i class="fas fa-users"></i>
                        <a id="coordinatorsbtn" href="coordinators.php">coordinators</a>
                    </label>
                    <label for="adminsbtn">
                        <i class="fas fa-cogs"></i>
                        <a id="adminsbtn" href="admins.php">admins</a>
                    </label>
                    <label for="studentbtn">
                        <i class="fas fa-user-graduate"></i>
                        <a id="studentbtn" href="student.php">student</a>
                    </label>
                    <label for="enrollbtn">
                        <i class="fas fa-tasks"></i>
                        <a id="enrollbtn" href="enroll.php">enroll</a>
                    </label>
                    <label for="mailsbtn">
                        <i class="fas fa-envelope"></i>
                        <a id="mailsbtn" href="mails.php">mails</a>
                    </label>
                    <label for="settings">
                        <i class="fas fa-cog"></i>
                        <a id="settingsbtn" href="settings.php">settings</a>
                    </label>
                </ul>
            </nav>
        </div>
    </div>
    <label for="sideCheck" class="oberlay"></label>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Overview</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
            <div id="content-inner">

                <div id="overview">
                    <div class="cards">
                        <li>
                            <i class="fas fa-user-graduate"></i>
                            <div class="mgs">
                                <h4 id="studnum">0</h4>
                                <p>students</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-users"></i>
                            <div class="mgs">
                                <h4 id="coor">0</h4>
                                <p>coordinator</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-users"></i>
                            <div class="mgs">
                                <h4 id="trainees">0</h4>
                                <p>trainees</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-users"></i>
                            <div class="mgs">
                                <h4 id="ad">0</h4>
                                <p>admins</p>
                            </div>
                        </li>
                    </div>

                    <div class="middleC">
                        <canvas id="myChart" style="color: #fff;display: block; width: 100%; max-width: 620px;"></canvas>

                        <div class="status">
                            <h3>Status</h3>
                            <div class="headStatus">
                                <label for="#">Students</label>
                                <label for="#">Trainees</label>
                                <label for="#">Coordinators</label>
                                <label for="#">Admins</label>
                            </div>
                        </div>
                        <div class="calendar">
                            <div id="month" class="date"></div>
                            <div id="day" class="date"></div>
                            <div id="weekday" class="date"></div>
                            <div class="mNy">
                                <div id="year" class="date"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>





        <script src="ajax.js?v=<?php echo time(); ?>"></script>

</body>

</html>