<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
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
    <script src="../UX//student.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="../admin.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="../../css/tp.css?v=<?php echo time(); ?>">
    <style>
        #cont-viewinform::after {
            background-color: rgb(0, 174, 255);
        }

        #cont-viewinform::before {
            background-color: rgb(0, 174, 255);
        }

        .viewinform #vinfo {
            border: solid .2rem rgb(0, 174, 255);
        }

        .profSide h2::before {
            content: '<?php echo $_SESSION['user_role'] ?>';
        }
    </style>


    <title>Students</title>
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

                    <a id="overviewbtn" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>

                    <a id="coordinatorsbtn" href="coordinators.php"><i class="fas fa-users"></i>coordinators</a>

                    <a id="studentbtn" href="student.php" class="on"><i class="fas fa-user-graduate"></i>student</a>

                    <a id="enrollbtn" href="enroll.php"><i class="fas fa-tasks"></i>enroll</a>

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
        <div class="head"><label id="toplab2" for="sideCheck">Students</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
            <div id="students">
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

                <div class="students-inner">
                    <div class="searchd">
                        <div class="btad">
                            <div class="lodst">
                                <i class="fas fa-user-cog"></i>
                                <span></span>
                            </div>
                            <button id="addstudentsaccount">Add Account</button>
                        </div>
                        <form id="searchForm">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" name="" id="searchInput" placeholder="Search for students...">
                        </form>
                    </div>
                    <div class="outUl">
                        <ul id="searchResults"></ul>
                    </div>
                    <label for="" id="overlayform">

                    </label>
                    <label for="" id="overlayform2">

                    </label>

                    <div id="cont-editform">
                        <div class="editcoor-inner">
                            <i class="fa-regular fa-circle-xmark" id="back"></i>
                            <div class="tabinedit">
                                <button id="button1">Login Credentials</button>
                                <button id="button2">Personal Information</button>
                            </div>
                            <div class="formsact">
                                <form id="primarysec" enctype="multipart/form-data">
                                    <div class="primaryaskedit"></div>
                                </form>
                                <form id="secondarysec">
                                    <div class="secondaryaskedit">
                                        <div class="secondaryaskedit-inner"></div>
                                    </div>
                                </form>
                            </div>

                            <div class="loadingSc">
                                <div class="loadingSc-inner">
                                    <span class="eloader2"></span>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div id="cont-confirmforedit">
                        <div class="innerforeditform">
                            <form id="editformreq">
                                <p>Is it you?</p>
                                <div class="wr">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" placeholder="Password.." autocomplete="new-password" id="conftopass">
                                </div>
                                <div id="reqeditresponse"></div>
                                <button id="ver">Verify</button>
                            </form>

                        </div>
                        <div class="outlosdrmqrm">
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






                    <div id="cont-removeform">
                        <div class="removeform">
                            <form id="rmformreq">
                                <p>Confirm for deletion</p>
                                <div class="wr">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password" placeholder="Confirm password" autocomplete="new-password" autocomplete="new-password" id="pwdd">
                                </div>
                                <div id="responsetodel"></div>
                                <button id="delG">Delete</button>
                            </form>

                        </div>
                        <div class="outlosdrm">
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



                    <div id="cont-viewinform">

                    </div>

                    <!-- addcoordinator -->
                    <div id="cont-addstudents">
                        <div class="outlosdadd">
                            <div class="innerloadsd">
                                <div class="loader">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="addstudents-inner">

                            <form id="studentsForm" enctype="multipart/form-data">
                                <div id="first">
                                    <i class="fa-regular fa-circle-xmark" id="back"></i>

                                    <div class="inner-first">

                                        <div class="icon-input-container">
                                            <i class="fa-regular fa-address-card"></i>
                                            <input id="SN" type="number" name="student_id" placeholder="Student ID">
                                        </div>
                                        <div class="icon-input-container">
                                            <i class="fa-regular fa-user"></i>
                                            <input id="FN" type="text" name="firstname" placeholder="First Name">
                                        </div>
                                        <div class="icon-input-container">
                                            <i class="fa-regular fa-user"></i>
                                            <input id="LN" type="text" name="lastname" placeholder="Last Name">
                                        </div>
                                        <div class="icon-input-container">
                                            <i class="fa-regular fa-user"></i>
                                            <input id="MN" type="text" name="middlename" placeholder="Middle Name">
                                        </div>
                                        <div class="icon-input-container">
                                            <i class="fas fa-graduation-cap"></i>
                                            <select name="" id="YL">
                                                <option value="" id="yrlevel">Year Level</option>
                                                <option value="1st Year">1st Year</option>
                                                <option value="2nd Year">2nd Year</option>
                                                <option value="3rd Year">3rd Year</option>
                                                <option value="4rth Year">4rth Year</option>
                                            </select>
                                        </div>

                                        <div id="studentsResponse1stsection"></div>
                                        <div class="nxbk">
                                            <button type="button" id="nextToSecond">Next</i>
                                        </div>
                                    </div>
                                </div>

                                <div id="second">
                                    <i class="fa-regular fa-circle-xmark" id="back"></i>
                                    <div class="inner-second">
                                        <div class="icon-input-container">
                                            <i class="fas fa-user gender-icon"></i>
                                            <select name="" id="GN">
                                                <option value="">Gender</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                        </div>

                                        <div class="icon-input-container">
                                            <i class="fa-solid fa-phone"></i>
                                            <input id="CNT" type="number" name="contact" placeholder="Contact Number">
                                        </div>
                                        <div class="icon-input-container">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <textarea class="A" name="address" id="address" cols="30" rows="2" placeholder="Address"></textarea>
                                        </div>
                                        <div class="icon-input-container">
                                            <i class="fas fa-building"></i>
                                            <input id="DPT" type="text" autocomplete="off" name="department" placeholder="Department">
                                            <div class="suggestDpt"></div>
                                        </div>
                                        <div class="icon-input-container">
                                            <i class="fas fa-book"></i>
                                            <input name="" id="CRS" placeholder="Course" autocomplete="off">
                                            <div class="suggestCrs"></div>
                                        </div>
                                        <div id="studentsResponse2ndsection"></div>

                                        <div class="nxbk" id="secondSectionButtonControll">
                                            <button type="button" id="backToFirst">Back</button>
                                            <button type="button" id="nextToLast">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="last">
                                    <i class="fa-regular fa-circle-xmark" id="back"></i>

                                    <div class="inner-last">

                                        <div class="outlosdsign">
                                            <div class="innerloadsd">
                                                <div class="loader">
                                                    <div class="bar"></div>
                                                    <div class="bar"></div>
                                                    <div class="bar"></div>
                                                    <div class="bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="balotlast">
                                            <div class="chpic">
                                                <img src="../../images/mali.png" id="profileImage" alt="">
                                                <label for="image">Choose profile</label>
                                                <input type="file" name="image" id="image" accept="image/*" onchange="handleimg(6)">
                                            </div>

                                            <div class="icon-input-container">
                                                <i class="fa-regular fa-circle-user"></i>
                                                <input id="UN" type="text" name="username" placeholder="Username">
                                            </div>
                                            <div class="icon-input-container">
                                                <i class="fa-regular fa-envelope"></i>
                                                <input id="EM" type="text" name="email" placeholder="Email">
                                            </div>
                                            <div class="icon-input-container">
                                                <i class="fas fa-lock"></i>
                                                <input id="PW" type="password" name="userpassword" placeholder="Password">
                                            </div>
                                            <div class="icon-input-container">
                                                <i class="fas fa-lock"></i>
                                                <input id="CONFPW" autocomplete="new-password" type="password" name="confirm_password" placeholder="Confirm Password">
                                            </div>
                                            <div id="studentsResponselastsection"></div>
                                            <div class="cont-studaddbut">
                                                <button id="studentAddbutton">Add</button>
                                            </div>
                                            <div class="nxbk" id="lastSectionButtonControll">
                                                <button type="button" id="backToSecond">Back</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="responseMssg-out">
                        <div class="responseMssg">
                            <h3>New Student Added Successfully</h3>
                            <p>Click anywhere to continue</p>
                        </div>
                    </div>
                    <div class="outlosd">
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





</body>

</html>