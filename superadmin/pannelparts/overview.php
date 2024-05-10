<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "SuperAdmin")) {
    header('location: ../../index.php');
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
    <link rel="stylesheet" href="../tp.css?v=<?php echo time(); ?>">
    <style>
        .profSide h2::before {
            content: '<?php echo $_SESSION['user_role'] ?>';
        }

    </style>


    <title>Overview</title>
</head>

<body>
    <div class="bck"></div>

    <div class="outside">

        <div class="sideP">
            <div class="profSide" >

                <div class="profsideCont" id="pcont">
                    <img src="../../images/adminpic.png" id="sidepic" alt="">
                    <h2 id="callN"><?php echo $_SESSION['username'] ?></h2>
                </div>
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
                        
                        <a id="" href="other.php" ><i class="fa-solid fa-skull-crossbones"></i>other Access</a>

                        <a id="settingsbtn" href="settings.php"><i class="fas fa-cog"></i>settings</a>
                    </ul>
                </nav>
            </nav>
            <div class="logoutSec">
                <button id="logoutClick">Logout</button>
            </div>
        </div>
    </div>
    <label for="sideCheck" class="oberlay"></label>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Overview</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
            <!-- <i class="fas fa-sync"></i> -->
            <div id="overview">
                <label for="" id="overlayform2">
                </label>
                <div class="loggingoutVer-cont">
                    <div class="loggingoutVer">
                        <div class="buttonSec">
                            <button id="yes">Yes</button>
                            <button id="no">No</button>
                        </div>
                        <h2>Logging out...</h2>
                    </div>
                </div>
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
                            <button id="fStudent">Students</button>
                            <button id="fTrainees">Trainees</button>
                            <button id="fCoordinators">Coordinators</button>
                            <button id="fAdmins">Admins</button>
                        </div>
                        <div class="status-content">
                            <div class="loadingSc">
                                <div class="loadingSc-inner">
                                    <span class="eloader2"></span>
                                </div>
                            </div>
                            <div class="status-content-inner"></div>

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



    <script src="../UX/overview.js?v=<?php echo time(); ?>"></script>



</body>

</html>