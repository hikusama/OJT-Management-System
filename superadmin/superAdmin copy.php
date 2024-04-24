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

                    <a id="overviewbtn" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>

                    <a id="coordinatorsbtn" class="on" href="coordinators.php"><i class="fas fa-users"></i>coordinators</a>

                    <a id="adminsbtn" href="admins.php"><i class="fas fa-cogs"></i>admins</a>

                    <a id="studentbtn" href="student.php"><i class="fas fa-user-graduate"></i>student</a>

                    <a id="enrollbtn" href="enroll.php"><i class="fas fa-tasks"></i>enroll</a>

                    <a id="mailsbtn" href="mails.php"><i class="fas fa-envelope"></i>mails</a>

                    <a id="settingsbtn" href="settings.php"><i class="fas fa-cog"></i>settings</a>
                </ul>
            </nav>
        </div>
    </div>
    <label for="sideCheck" class="oberlay"></label>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Overview</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">





        </div>
    </div>





    <script src="ajax.js?v=<?php echo time(); ?>"></script>

</body>

</html>