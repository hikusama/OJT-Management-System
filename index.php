<?php
// require_once 'includes/session.php';
// session_start();

// require_once 'login_Signup/signup_view.php';
// require_once 'login_Signup/login_view.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
    <script src="ajaxlognsignupRequest/ajax.js"></script>
    <link rel="stylesheet" href="css/output.css?v=<?php echo time(); ?>">
    <title>Login and Signup Tabs</title>

</head>

<body>
    <div id="contentry">

        <?php
        // if (!isset($_SESSION["user_id"])) { 
        ?>
        <div class="side">
            <div class="in">On Job Training</div>
        </div>

        <div class="overlaylogn"></div>

        <div class="entry">

            <div id="logn">
                <form id="loginRequest" method="post">
                    <h2>Login</h2>
                    <div class="icon-input-container">
                        <i class="fa-regular fa-circle-user" "></i>
                    <input type=" text" id="Logusername" placeholder="Username" class="border">
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
                            <input class="LN" type="text" name="student_id" placeholder="Student ID">
                        </div>
                        <div class="icon-input-container">
                            <i class="fa-regular fa-user"></i>
                            <input class="FN" type="text" name="firstname" placeholder="First Name">
                        </div>
                        <div class="icon-input-container">
                            <i class="fa-regular fa-user"></i>
                            <input class="LN" type="text" name="lastname" placeholder="Last Name">
                        </div>
                        <div class="icon-input-container">
                            <i class="fa-regular fa-user"></i>
                            <input class="LN" type="text" name="middlename" placeholder="Middle Name">
                        </div>
                        <div class="icon-input-container">
                            <i class="fas fa-graduation-cap"></i>
                            <input class="CN" type="text" name="year_level" placeholder="Year Level">
                        </div>
                        <div class="betsign">
                            <div class="top">
                                <label><a href="#logn">Login</a></label>
                                <label class="noepek">Sign Up</label>
                            </div>
                        </div>
                        <div class="nxbk">
                            <i></i>
                            <i id="nextToSecond" class="fa-solid fa-circle-right fa-2xl" style="color: #ffffff;"></i>
                        </div>
                    </div>

                    <div id="second">
                        <div id="gn" class="icont">
                            <div class="fm">
                                <i class="fas fa-venus fa-lg"></i>
                                <input type="radio" name="gender" value="Female">
                            </div>
                            <div class="ml">
                                <i class="fas fa-mars fa-lg"></i>
                                <input type="radio" name="gender" value="Male">
                            </div>
                        </div>
                        <div class="icon-input-container">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="M" type="text" name="email" placeholder="E-mail">
                        </div>
                        <div class="icon-input-container">
                            <i class="fa-solid fa-phone"></i>
                            <input class="CN" type="text" name="contact" placeholder="Contact Number">
                        </div>
                        <div class="icon-input-container">
                            <i class="fas fa-map-marker-alt"></i>
                            <textarea class="A" name="address" id="" cols="30" rows="2" placeholder="Address"></textarea>
                        </div>
                        <div class="icon-input-container">
                            <i class="fas fa-book"></i>
                            <input class="LN" type="text" name="course" placeholder="Course">
                        </div>
                        <div class="icon-input-container">
                            <i class="fas fa-building"></i>
                            <input class="LN" type="text" name="department" placeholder="Department">
                        </div>
                        <div class="nxbk">
                            <i id="backToFirst" class="fa-solid fa-circle-right fa-flip-horizontal fa-2xl" style="color: #ffffff;"></i>
                            <i id="nextToLast" class="fa-solid fa-circle-right fa-2xl" style="color: #ffffff;"></i>
                        </div>
                    </div>

                    <div id="last">
                        <div class="balotlast">
                            <div class="nxbk">
                                <i id="backToSecond" class="fa-solid fa-circle-right fa-flip-horizontal fa-2xl" style="color: #ffffff;"></i>
                                <i></i>
                            </div>
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
                                <input class="U" type="text" name="username" placeholder="Username">
                            </div>
                            <div class="icon-input-container">
                                <i class="fas fa-lock"></i>
                                <input class="P" type="password" name="userpassword" placeholder="Password">
                            </div>
                            <div class="icon-input-container">
                                <i class="fas fa-lock"></i>
                                <input class="CP" type="password" name="confirm_password" placeholder="Confirm Password">
                            </div>
                            <div class="betsign">
                                <div class="top">
                                    <label for="ch2"><a href="#logn">Login</a></label>
                                    <label class="noepek">Sign Up</label>
                                </div>
                                <input type="file" name="image" id="image" accept="image/*" onchange="handleImgLogin()">
                                <button id="btsign" type="submit">Signup</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php // } 
            ?>

        </div>
        <button id="xplore">Explore</button>
        <div class="yelup">
            <img src="images/yel.png">
        </div>
        <div class="yelup2">
            <img src="images/yel.png">
        </div>

    </div>

    <!-- <script>
            // let entry = $('.entry');
            // let checkb = $('#ch');
            // let ov = $('.overlay');
            // let start = $('.but');


            // function ober() {

            //     if (!checkb.checked) {
            //         console.log("hello");
            //         ov.classList.add('ovdaw');
            //         entry.classList.add('entry2');
            //         start.classList.add('st');
            //     } else {
            //         ov.classList.remove('ovdaw');
            //         entry.classList.remove('entry2');
            //         start.classList.remove('st');

            //     }


            // }

            // function $(s) {
            //     return document.querySelector(s);

            // }
        </script> -->

</body>

</html>