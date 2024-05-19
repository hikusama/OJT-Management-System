<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../index.php');
} else {

    if ($_SESSION["accesstype"] == 'notTrainee') {
        header('location: studHome.php');
    } elseif ($_SESSION["accesstype"] == 'deployed') {
        header('location: traineeDeployedHome.php');
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
    <script src="../UX/ntDptTrHome.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="../../css/tp.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../student.css?v=<?php echo time(); ?>">

    <style>
        .profSide h2::before {
            content: '<?php echo $_SESSION['user_role'] ?>';
        }
    </style>


    <title>Home</title>
</head>

<body>
    <div class="bck"></div>

    <div class="outside">

        <div class="sideP">
            <div class="profSide">
                <div class="loadingScprf">
                    <div class="loadingSc-inner">
                        <span class="eloader2"></span>
                    </div>
                </div>
                <div class="profsideCont" id="pcont">
                </div>
            </div>
            <nav>
                <nav>
                    <ul id="tabs">

                        <a id="overviewbtn" class="on" href="studHome.php"><i class="fas fa-tachometer-alt"></i>home</a>

                        <a id="mailsbtn" href="program.php"><i class="fas fa-envelope"></i>program</a>

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
        <div class="head"><label id="toplab2" for="sideCheck">Home</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
            <!-- <i class="fas fa-sync"></i> -->
            <div id="home">
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

                <div class="home-inner">
                    <div class="homeFirstSection">
                        <div class="yrnot">
                            <?php  ?>
                            <p>You are now a trainee!!</p>
                            <button id="findSupV">Apply</button>
                        </div>
                    </div>
                    <hr>
                    <div class="homeSecondSection">


                    </div>
                    <div class="outer-applyToSupV">
                        <i class="fas fa-arrow-left" id="back2"></i>

                        <div id="applyToSupV">
                            <h3>Apply to Supervisor</h3>
                            <div class="srSpec">
                                <form id="searchBySpec">
                                    <div class="inputWtType">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="search" name="" id="searchSupV" placeholder="Search for 'supervisor'...">
                                    </div>
                                </form>
                            </div>
                            <ul id="supervisors">
                                <div class="loadli">
                                    <div class="inner-loadli">
                                        <ol>
                                            <span class="pictemplate"></span>
                                            <span class="infotemplate"><span class="Displayname"></span></span>
                                        </ol>
                                        <ol>
                                            <span class="pictemplate"></span>
                                            <span class="infotemplate"><span class="Displayname"></span></span>
                                        </ol>
                                        <ol>
                                            <span class="pictemplate"></span>
                                            <span class="infotemplate"><span class="Displayname"></span></span>
                                        </ol>
                                        <ol>
                                            <span class="pictemplate"></span>
                                            <span class="infotemplate"><span class="Displayname"></span></span>
                                        </ol>
                                    </div>
                                </div>



                            </ul>
                        </div>
                    </div>



                    <div class="out-viewSupV">
                        <div class="outlosdviewinfo">
                            <div class="innerloadsd">
                                <div class="loader">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>






</body>

</html>