<?php
// require_once 'includes/session.php';

// require_once 'login_Signup/signup_view.php';
// require_once 'login_Signup/login_view.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
    <script src="ajaxlognsignupRequest/ajax.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="css/output.css?v=<?php echo time(); ?>">
    <title>Login</title>

</head>

<body>
    <div id="fullload">
        <img src="images/tommy.png" id="tommy" alt="">
        <h5>OJT MANAGEMENT SYSTEM</h5>
    </div>

    <div id="contentry">

        <?php
        if (!isset($_SESSION["user_id"])) {
        ?>

            <div class="side">
                <div class="in">On The Job Training</div>
            </div>

            <div class="overlaylogn"></div>

            <div class="entry">

                <div id="logn">
                    <form id="loginRequest" method="post">
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
                        <h2>Login</h2>
                        <div class="icon-input-container">
                            <i class="fa-regular fa-circle-user" "></i>
                    <input type=" text" id="Logusername" autocomplete="off" placeholder="Username" class="border">
                        </div>
                        <div class="icon-input-container">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="Logpassword" placeholder="Password" class="border">
                        </div>
                        <div class="betlogin">
                            <div class="top">
                                <label class="noepek">Login</label>
                                <label id="signup-tab" class="wepek">
                                    <a href="#register">Sign Up</a>
                                </label>
                            </div>
                            <div id="loginErrors"></div>
                            <button id="btlog">Login</button>
                        </div>
                    </form>
                </div>



                <div id="signup">
                    <form id="signupForm" enctype="multipart/form-data">
                        <div id="first">
                            <h2>Signup</h2>
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
                            <div class="betsign">
                                <div class="top">
                                    <label><a href="#logn">Login</a></label>
                                    <label class="noepek">Sign Up</label>
                                </div>
                            </div>

                            <div id="signupResponse1stsection"></div>
                            <div class="nxbk">
                                <button type="button" id="nextToSecond">Next</i>
                            </div>
                        </div>

                        <div id="second">
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
                                <input id="DPT" type="text" name="department" autocomplete="off" placeholder="Department">
                                <div class="suggestDpt"></div>
                            </div>
                            <div class="icon-input-container">
                                <i class="fas fa-book"></i>
                                <input id="CRS" type="text" name="course" autocomplete="off" placeholder="Course">
                                <div class="suggestCrs"></div>
                            </div>
                            <div id="signupResponse2ndsection"></div>

                            <div class="nxbk" id="secondSectionButtonControll">
                                <button type="button" id="backToFirst">Back</button>
                                <button type="button" id="nextToLast">Next</button>
                            </div>
                        </div>

                        <div id="last">
                            <div class="redirect">
                                <div class="redirect-inner">
                                    <button id="Createanother" type="button">Create Another Account?</button>
                                    <button id="Gotologin" type="button">Go To Login</button>
                                </div>
                            </div>
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
                                <div class="picpackall">
                                    <div class="packim" id="packim">
                                        <li>
                                            <img id="profileImage" src="images/def.png" alt="prof">
                                            <label for="image" class="plus">
                                                <img src="images/plus.png" alt="add">
                                            </label>
                                        </li>
                                    </div>
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
                                    <input id="CONFPW" type="password" name="confirm_password" placeholder="Confirm Password">
                                </div>
                                <div class="betsign">
                                    <div class="top">
                                        <label for="ch2"><a href="#logn">Login</a></label>
                                        <label class="noepek">Sign Up</label>
                                    </div>
                                    <input type="file" name="image" id="image" accept="image/*" onchange="handleImgLogin()">
                                    <button id="btsign" type="submit">Signup</button>
                                </div>
                                <div id="signupResponselastsection"></div>

                                <div class="nxbk" id="lastSectionButtonControll">
                                    <button type="button" id="backToSecond">Back</i>
                                </div>
                            </div>
                        </div>



                    </form>
                </div>


            </div>
            <button id="xplore">Explore</button>
            <div class="yelup">
                <img src="images/yel.png">
            </div>
            <div class="yelup2">
                <img src="images/yel.png">
            </div>

    </div>
<?php  } else if (isset($_SESSION['user_role'], $_SESSION['user_id'])) {
            if ($_SESSION['user_role'] == 'SuperAdmin') {
                header('location: superadmin/pannelparts/overview.php');
            } else if ($_SESSION['user_role'] == 'Supervisor') {
                header('location: superadmin/coor.php');
            } else if ($_SESSION['user_role'] == 'Student') {
                header('location: Student/index.php');
            }
        }
?>


</body>

</html>