<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="tp.css?v=<?php echo time(); ?>">
    <script src="ajax.js?v=<?php echo time(); ?>"></script>
    <title>Document</title>
</head>

<body>
    <div id="content">
        <label for="act1" id="overlayform" style="display: block;">

        </label>

        <!-- <div id="cont-editform" style="display: block;">
            <div class="editform">
                <div class="chpic">
                    <img src="../images/mali.png" id="profdisplay" alt="">
                    <label for="changep">Change profile</label>
                </div>
                <form method="post">
                    <input type="file" name="image" id="changep" accept="image/*" onchange="handleimg(1)">
                    <input type="username" placeholder="Username" value="Hikusama">
                    <input type="text" placeholder="Password">
                    <button>update</button>
                </form>
            </div>
        </div> -->
        <div id="cont-editform" style="display: block;">
            <div class="editcoor-inner">
                <i class="fa-regular fa-circle-xmark" id="back"></i>
                <div class="tabinedit">
                    <button id="button1">Login Credentials</button>
                    <button id="button2">Personal Information</button>
                </div>
                <div class="formsact">

                    <div class="loadingSc">
                        <div class="loadingSc-inner">
                            <span class="eloader2"></span>
                        </div>
                    </div>
                    <form id="primarysec" enctype="multipart/form-data">
                        <div class="primaryaskedit"></div>
                        <!--                
    <div class="loader">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
</div>
                        <div class="inptcont">
                            <i class="fas fa-user"></i>
                            <input type=" text" id="usernamee" placeholder="Username" name="username">
                        </div>
                        <div class="inptcont">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="passworde" placeholder="Password" name="userpassword"
                                class="border">
                        </div>
                        <div class="inptcont">
                            <i class="fas fa-lock"></i>
                            <input class="CP" id="confirm_passworde" type="password" placeholder="Confirm Password"
                                name="confirm_password">
                        </div>
                        <div class="coradbut">
                            <label for="addNewcoor">update</label>
                        </div> -->

                    </form>
                    <form id="secondarysec">

                        <div class="secondaryaskedit">
                            <div class="secondaryaskedit-inner"></div>
                            <div id="secondaryErrorDisplay">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>