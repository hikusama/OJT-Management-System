<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
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
    <script src="../UX/program.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="../student.css?v=<?php echo time(); ?>">

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


    <title>Program</title>
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

                </div>
            </div>
            <nav>
                <ul id="tabs">

                    <a id="overviewbtn" href="studHome.php"><i class="fas fa-tachometer-alt"></i>home</a>

                    <a id="mailsbtn" href="program.php" class="on"><i class="fas fa-envelope"></i>program</a>

                    <a id="settingsbtn" href="settings.php"><i class="fas fa-cog"></i>settings</a>

                </ul>
            </nav>
            <div class="logoutSec">
                <button id="logoutClick">Logout</button>
            </div>
        </div>
    </div>
    <label for="sideCheck" class="oberlay"></label>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Program</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
            <div id="program">
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


                <div class="program-inner">
                    <div class="progHead">
                        <button id="allReq" class="on_select_rep">All</button>
                        <button id="repReq">Pending</button>
                        <button id="apprvReq">Approved</button>
                        <button id="rejReq">Rejected</button>
                    </div>
                    <div class="program-cont">
 

                    </div>
                </div>
                <div class="form_prog_out">
                    <div class="form_prog">
                        <form id="submitFormReport">
                            <input type="file" id="img">
                            <div class="input_cont">
                                <i class="fas fa-star"></i>
                                <input type="text" placeholder="Title" id="title">
                            </div>
                            <div class="input_cont">
                                <i class="fa-solid fa-map-pin"></i>
                                <input type="text" placeholder="Place" id="place">
                            </div>
                            <div class="input_cont">
                                <i class="fa-solid fa-business-time"></i>
                                <input type="number" placeholder="Hours acquired" id="time_acquired">
                            </div>
                            <div class="input_cont">
                                <i class="fa-regular fa-file-word" id="mubrep"></i>
                                <textarea id="narrative" spellcheck="false" placeholder="Narrative" rows="3"></textarea>
                            </div>
                            <div id="submitReportResponseMsg"></div>
                            <div class="butActionRep">
                                <button id="submitReport" type="submit">Submit</button>
                                <button id="cancelReport">Cancel</button>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="frame_outer">

                    <div class="frame">
                       
                    </div>
                </div>

                <div class="responseMssg-out">
                    <div class="responseMssg">
                        <h3>Report submitted successfully..</h3>
                        <p>Click anywhere to continue</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>










</body>

</html>