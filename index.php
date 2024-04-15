<?php
// require_once 'includes/session.php';
// session_start();

require_once 'login_Signup/signup_view.php';
require_once 'login_Signup/login_view.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
    <script src="a.js"></script>
    <link rel="stylesheet" href="css/output.css?v=<?php echo time(); ?>">
    <title>Login and Signup Tabs</title>

</head>

<body>
    <div id="contentry">

        <?php
        if (!isset($_SESSION["user_id"])) { ?>
            <div class="side">
                <div class="in">On Job Training</div>
            </div>

            <div class="overlaylogn"></div>



            <div class="entry">

                <div id="logn">
                    <form action="login_Signup/login.php" method="post">
                        <h2>Login</h2>
                        <div class="icon-input-container">
                            <i class="fa-regular fa-circle-user" "></i>
                    <input type=" text" id="Logusername" name="username" placeholder="Username" class="border">
                        </div>

                        <div class="icon-input-container">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="Logpassword" placeholder="Password" name="password" class="border">
                        </div>



                        <div class="betlogin">
                            <div class="top">
                                <label class="noepek">Login</label>
                                <label id="signup-tab" class="wepek">
                                    <a href="#register">Sign Up</a>
                                </label>
                            </div>

                            <button id="btlog" type="submit">Login</button>
                        </div>

                        <?php
                        check_login_errors();
                        ?>
                    </form>
                </div>
                <div id="signup">
                    <form id="signupForm" action="login_Signup/signup.php" method="post" enctype="multipart/form-data">
                        <?php signup_inputs() ?>
                    </form>
                </div>

            <?php } ?>

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