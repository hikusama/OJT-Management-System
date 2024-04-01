<?php
require_once 'viewSA.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
                <ul>
                    <label for="overview">
                        <i class="fas fa-tachometer-alt"></i>
                        <a id="overview" href="#a">overview</a>
                    </label>
                    <label for="coordinators">
                        <i class="fas fa-users"></i>
                        <a id="coordinators" href="#b">coordinators</a>
                    </label>
                    <label for="admins">
                        <i class="fas fa-cogs"></i>
                        <a id="admins" href="#c">admins</a>
                    </label>
                    <label for="student">
                        <i class="fas fa-user-graduate"></i>
                        <a id="student" href="#d">student</a>
                    </label>
                    <label for="enroll">
                        <i class="fas fa-tasks"></i>
                        <a id="enroll" href="#e">enroll</a>
                    </label>
                    <label for="mails">
                        <i class="fas fa-envelope"></i>
                        <a id="mails" href="#f">mails</a>
                    </label>
                    <label for="settings">
                        <i class="fas fa-cog"></i>
                        <a id="settings" href="#g">settings</a>
                    </label>
                </ul>
            </nav>
        </div>
    </div>
    <div class="lardgeSide">
        <div class="head"><label id="toplab2" for="sideCheck">Overview</label></div>
        <label for="sideCheck" class="oberlay"></label>
        <input type="checkbox" id="sideCheck">
        <?php getCont() ?>

    </div>

<script src="s.js"></script>

</body>

</html>