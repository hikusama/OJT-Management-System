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

        <label for="" id="overlayform2">

            </lab el>
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



                        </form>
                        <form id="secondarysec">
                            <div class="secondaryaskedit">
                                <div class="secondaryaskedit-inner"></div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="addedsuc">
                <div class="pannelanim">
                    <img src="../images/fakeshelby.png" id="displayaddanim" alt="">
                    <div class="name">
                        <h1>ADDED SUCCESSFULLY</h1>
                        <h2>Algeo Fernandez</h2>
                        <button id="done">Done</button>
                    </div>
                </div>


                <audio id="addedSound">
                    <source src="../soundinteract/allstamp.mp3" type="audio/mpeg">
                </audio>
            </div>
    </div>
</body>

</html>