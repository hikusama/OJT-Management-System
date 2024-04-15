<?php



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="tp.css">
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
                    <label for="overviewbtn" class="on">
                        <i class="fas fa-tachometer-alt"></i>
                        <a id="overviewbtn" href="#overview">overview</a>
                    </label>
                    <label for="coordinatorsbtn">
                        <i class="fas fa-users"></i>
                        <a id="coordinatorsbtn" href="#coordinators">coordinators</a>
                    </label>
                    <label for="adminsbtn">
                        <i class="fas fa-cogs"></i>
                        <a id="adminsbtn" href="#admins">admins</a>
                    </label>
                    <label for="studentbtn">
                        <i class="fas fa-user-graduate"></i>
                        <a id="studentbtn" href="#student">student</a>
                    </label>
                    <label for="enrollbtn">
                        <i class="fas fa-tasks"></i>
                        <a id="enrollbtn" href="#enroll">enroll</a>
                    </label>
                    <label for="mailsbtn">
                        <i class="fas fa-envelope"></i>
                        <a id="mailsbtn" href="#mails">mails</a>
                    </label>
                    <label for="settings">
                        <i class="fas fa-cog"></i>
                        <a id="settingsbtn" href="#settings">settings</a>
                    </label>
                </ul>
            </nav>
        </div>
    </div>
    <label for="sideCheck" class="oberlay"></label>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Overview</label></div>
        <input type="checkbox" id="sideCheck">
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
                        <div class="npt">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" name="" id="" placeholder="Search for coordinators...">
                        </div>
                    </div>
                    <ul>

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
                        </li>
                        <label for="act1" id="overlayform"></label>
                        <div id="cont-editform">
                            <div class="editform">
                                <div class="chpic">
                                    <img src="../images/mali.png" id="profdisplay" alt="">
                                    <label for="changep">Change profile</label>
                                </div>
                                <form action="" method="post">
                                    <input type="file" name="image" id="changep" accept="image/*" onchange="handleimg(1)">
                                    <div class="inputeditcont">
                                        <i class="fas fa-user"></i>
                                        <input type="username" placeholder="Username" value="Hikusama">
                                    </div>
                                    <div class="inputeditcont">
                                        <i class="fas fa-lock"></i>
                                        <input type="text" placeholder="New Password">
                                    </div>
                                    <div class="inputeditcont">
                                        <i class="fas fa-lock"></i>
                                        <input type="text" placeholder="Re-type password">
                                    </div>
                                    <button>update</button>
                                </form>
                            </div>
                        </div>
                        <div id="cont-removeform">
                            <div class="removeform">
                                <form action="" method="post">
                                    <p>Confirm for deletion</p>
                                    <input type="password" name="remconf" placeholder="Confirm password" id="formpw">
                                    <button>Delete</button>
                                </form>




                            </div>
                        </div>
                        <div id="cont-viewinform">
                            <div class="viewinform">
                                <img src="../images/tamarawraulo.png" id="vinfo" alt="">
                                <h2>Algea Fernandez</h2>
                                <div class="inforsonal">
                                    <p id="infoper1">Position<span>Dean</span></p>
                                    <p id="infoper2">Department<span>CICS</span></p>
                                    <p id="infoper3">Room<span>203</span></p>
                                    <p id="infoper4">Email<span>algeo23@gmail.com</span></p>
                                    <p id="infoper5">Trainee<span>0</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- addcoordinator -->
                        <div id="cont-addcoor">
                            <div class="addcoor-inner">
                                <form action="" method="post">
                                    <div class="primaryask">
                                        <div class="chpic">
                                            <img src="../images/mali.png" id="profdisplay2" alt="">
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
                                    </div>
                                    <button id="addNewcoor"></button>
                                </form>
                                <div class="coradbut">
                                    <label for="addNewcoor">Add</label>
                                </div>
                            </div>
                        </div>
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
                </div>
            </div>



        </div>
    </div>

    <script src="main.js"></script>

</body>

</html>