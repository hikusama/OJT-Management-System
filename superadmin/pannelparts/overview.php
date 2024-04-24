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
    <script src="../interaction//overview.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="../tp.css?v=<?php echo time(); ?>">

    <title>Document</title>
</head>

<body>
    <div class="bck"></div>

    <div class="outside">

        <div class="sideP">
            <div class="profSide">
                <img src="../../images/mali.png" id="sidepic" alt="">
                <h2>Marco J.</h2>
                <style>
                    .profSide h2::before {
                        content: 'SuperAdmin';
                    }
                </style>
            </div>
            <nav>
            <nav>
                <ul id="tabs">
                        
                        <a id="overviewbtn" class="on" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>
                        
                        <a id="coordinatorsbtn" href="coordinators.php"><i class="fas fa-users"></i>coordinators</a>
                        
                        <a id="adminsbtn" href="admins.php"><i class="fas fa-cogs"></i>admins</a>
                        
                        <a id="studentbtn" href="student.php"><i class="fas fa-user-graduate"></i>student</a>
                        
                        <a id="enrollbtn" href="enroll.php"><i class="fas fa-tasks"></i>enroll</a>
                        
                        <a id="mailsbtn" href="mails.php"><i class="fas fa-envelope"></i>mails</a>
                        
                        <a id="settingsbtn" href="settings.php"><i class="fas fa-cog"></i>settings</a>
                </ul>
            </nav>
            </nav>
        </div>
    </div>
    <label for="sideCheck" class="oberlay"></label>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Overview</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
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






</body>

</html>