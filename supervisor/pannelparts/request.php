<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
    header('location: ../../index.php');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
    <script src="../UX/settings.js?v=<?php echo time(); ?>"></script>
    <script src="../UX/request.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="../supervisor.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="../../css/tp.css?v=<?php echo time(); ?>">
    <style>
        #cont-viewinform::after {
            background-color: rgb(104, 0, 165);
        }

        #cont-viewinform::before {
            background-color: rgb(104, 0, 165);
        }

        .viewinform #vinfo {
            border: solid .2rem rgb(104, 0, 165);
        }

        .profSide h2::before {
            content: '<?php echo $_SESSION['user_role'] ?>';
        }
    </style>


    <title>Request</title>
</head>

<body>
    <div class="bck"></div>

    <div class="outside">

        <div class="sideP">
            <div class="profSide">
                <div class="loadingScprf" style="display: none;">
                    <div class="loadingSc-inner">
                        <span class="eloader2"></span>
                    </div>
                </div>
                <div class="profsideCont" id="pcont">
                    <img src="../../images/adminpic.png" id="sidepic" alt="">
                    <h2 id="callN"><?php echo $_SESSION['username'] ?></h2>
                </div>
            </div>
            <nav>
                <ul id="tabs">

                    <a id="overviewbtn" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>

                    <a id="mailsbtn" href="request.php" class="on"><i class="fas fa-envelope"></i>request</a>

                    <a id="coordinatorsbtn" href="mytrainee.php"><i class="fas fa-users"></i>my trainee</a>

                    <a id="enrollbtn" href="trainee.php"><i class="fas fa-tasks"></i>trainee</a>

                    <a id="mailsbtn" href="program.php"><i class="fas fa-envelope"></i>program</a>

                    <a id="settingsbtn" href="settings.php" ><i class="fas fa-cog"></i>settings</a>
                </ul>
            </nav>
            <div class="logoutSec">
                <button id="logoutClick">Logout</button>
            </div>

        </div>
    </div>
    <label for="sideCheck" class="oberlay"></label>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Request</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
            <div id="request">
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


                <div class="request-inner">
                    
                </div>

                <!-- <div class="outlosd">
                    <div class="innerloadsd">
                        <div class="loader">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    </div>
                </div> -->

                <div class="responseMssg-out">
                    <div class="responseMssg">
                        <h3>New Student Added Successfully</h3>
                        <p>Click anywhere to continue</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>










</body>

</html>