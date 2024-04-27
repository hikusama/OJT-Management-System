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
    <script src="../UX//coordinators.js?v=<?php echo time(); ?>"></script>

    <link rel="stylesheet" href="../tp.css?v=<?php echo time(); ?>">

    <style>
        #cont-viewinform::after {
            background-color: rgb(0, 187, 140);
        }

        #cont-viewinform::before {
            background-color: rgb(0, 187, 140);
        }

        .viewinform #vinfo {
            border: solid .2rem rgb(0, 187, 140);
        }
    </style>
    <title>Coordinators</title>
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
        <div class="head"><label id="toplab2" for="sideCheck">Coordinators</label></div>
        <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
        <div id="content">
            <div id="coordinators">
                <div class="coordinators-inner">

                    <div class="searchd">
                        <div class="btad">
                            <div class="lodst">
                                <i class="fa-solid fa-helmet-safety"></i>
                                <span></span>
                            </div>
                            <button id="addcooraccount">Add Account</button>
                        </div>
                        <form id="searchForm">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" name="" id="searchInput" placeholder="Search for coordinators...">
                        </form>

                    </div>
                    <ul id="searchResults">


                        <!-- <li>

                        <i id="men" class="fa-solid fa-ellipsis "></i>
                        <div class="pfront">
                            <img src="../images/mali.png" alt="" srcset="">
                            <h4>Marco Jean</h4>
                            <p>CICS</p>
                        </div>
                        <div class="grupi">
                            <div class="showact" id="sa">
                                <i class="fa-regular fa-pen-to-square act1"></i>
                                <i class="fa-solid fa-user-slash act2"></i>
                                <i class="fa-solid fa-person-circle-exclamation act3"></i>
                            </div>
                        </div>
                    </li>

                    <li>

                        <i id="men" class="fa-solid fa-ellipsis "></i>
                        <div class="pfront">
                            <img src="../images/mali.png" alt="" srcset="">
                            <h4>Marco Jean</h4>
                            <p>CICS</p>
                        </div>
                        <div class="grupi">
                            <div class="showact" id="sa">
                                <i class="fa-regular fa-pen-to-square act1"></i>
                                <i class="fa-solid fa-user-slash act2"></i>
                                <i class="fa-solid fa-person-circle-exclamation act3"></i>
                            </div>
                        </div>
                    </li>

                    <li>

                        <i id="men" class="fa-solid fa-ellipsis "></i>
                        <div class="pfrparent">
                            <div class="pfront">
                                <img src="../images/mali.png" alt="" srcset="">
                                <h4>Marco Jean</h4>
                                <p>CICS</p>
                            </div>
                        </div>
                        <div class="grupi">
                            <div class="showact" id="sa">
                                <i class="fa-regular fa-pen-to-square act1"></i>
                                <i class="fa-solid fa-user-slash act2"></i>
                                <i class="fa-solid fa-person-circle-exclamation act3"></i>
                            </div>
                        </div>
                    </li> -->


                        <!-- <li>
                    <i id="men" class="fa-solid fa-ellipsis"></i>
                    <div class="pfront">
                        <img src="../images/mali.png" alt="" srcset="">
                        <h4>Marco Jean</h4>
                        <p>CICS</p>
                    </div>
                </li>
                <li>
                    <i id="men" class="fa-solid fa-ellipsis"></i>
                    <div class="pfront">
                        <img src="../images/mali.png" alt="" srcset="">
                        <h4>Marco Jean</h4>
                        <p>CICS</p>
                    </div>
                </li> -->

                    </ul>
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
                                    <input type="password" placeholder="Password.." id="conftopass">
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
                                    <input type="password" name="password" placeholder="Confirm password" id="pwdd">
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
                        <div class="viewinform">
                            <img src="" id="vinfo" alt="">
                            <h2></h2>
                            <div class="inforsonal">
                                <p id="infoper1"><span></span></p>
                                <p id="infoper2"><span></span></p>
                                <p id="infoper3"><span></span></p>
                                <p id="infoper4"><span></span></p>
                                <p id="infoper5"><span></span></p>
                            </div>
                        </div>
                        <div class="outlosdvw">
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

                    <!-- addcoordinator -->
                    <div id="cont-addcoor">
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
                        <div class="addcoor-inner">
                            <i class="fa-regular fa-circle-xmark" id="back"></i>

                            <form id="coordinatorForm" method="post" enctype="multipart/form-data">
                                <div class="primaryask">
                                    <div class="chpic">
                                        <img src="../../images/mali.png" id="profdisplay2" alt="">
                                        <label for="changep2">Choose profile</label>
                                        <input type="file" name="image" id="changep2" accept="image/*" onchange="handleimg(2)">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-user"></i>
                                        <input type=" text" id="usernamec" placeholder="Username" name="username">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="passwordc" placeholder="Password" name="userpassword" class="border">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-lock"></i>
                                        <input class="CP" id="confirm_passwordc" type="password" placeholder="Confirm Password" name="confirm_password">
                                    </div>
                                </div>
                                <div class="secondaryask">
                                    <h3>Personal info</h3>
                                    <div class="inptcont">
                                        <i class="fas fa-user"></i>
                                        <input id="fnamec" type="text" placeholder="First name" name="fname" "> 
                                </div>
                                    <div class=" inptcont">

                                        <i class="fas fa-user"></i>
                                        <input id="lnamec" type="text" placeholder="Last name" name="lname">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-user"></i>
                                        <input id="mnamec" type="text" placeholder=" Middle name" name="mname">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-envelope"></i>
                                        <input id="emailc" type="email" placeholder="E-mail " name="email">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-briefcase"></i>
                                        <input id="positionc" type="text" placeholder="Position" name="position">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-building"></i>
                                        <input id="departmentc" type="text" placeholder="Department" name="department">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-door-open"></i>
                                        <input id="roomc" type="text" placeholder="Room" name="room">
                                    </div>
                                    <div class="inptcont">
                                        <i class="fas fa-mars"></i>
                                        <input id="gn" type="text" placeholder="Gender" name="gender">
                                    </div>
                                </div>

                                <div id="errorDisplay">
                                </div>
                            </form>
                            <div class="coradbut">
                                <label for="addNewcoor">Add</label>
                            </div>
                        </div>

                    </div>
                    <div class="addedsuc">
                        <div class="pannelanim">
                            <img src="" id="displayaddanim" alt="">
                            <div class="name">
                                <h1></h1>
                                <h3></h3>
                                <button id="done">Done</button>
                            </div>
                        </div>



                    </div>
                    <div class="addedsuc2">
                        <div class="pannelanim">
                            <div class="name">
                                <h1></h1>
                                <h3></h3>
                                <button id="done2">Done</button>
                            </div>
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