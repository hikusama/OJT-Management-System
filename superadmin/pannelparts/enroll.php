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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/02db36d522.js" crossorigin="anonymous"></script>
  <!-- <script src="../UX/student.js"></script> -->
  <script src="../UX/enroll.js?v=<?php echo time(); ?>"></script>

  <link rel="stylesheet" href="../tp.css?v=<?php echo time(); ?>">
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
      /* content: '<?php echo $_SESSION['user_role'] ?>'; */
    }
  </style>


  <title>Students</title>
</head>

<body>
  <div class="bck"></div>

  <div class="outside">

    <div class="sideP">
      <div class="profSide">
        <div class="loadingSc" style="display: none;">
          <div class="loadingSc-inner">
            <span class="eloader2"></span>
          </div>
        </div>
        <div class="profsideCont" id="pcont">
          <img src="../../images/adminpic.png" id="sidepic" alt="">
          <h2 id="callN"></h2>
        </div>
      </div>
      <nav>
        <ul id="tabs">

          <a id="overviewbtn" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>

          <a id="coordinatorsbtn" href="coordinators.php"><i class="fas fa-users"></i>coordinators</a>

          <a id="adminsbtn" href="admins.php"><i class="fas fa-cogs"></i>admins</a>

          <a id="studentbtn" href="student.php"><i class="fas fa-user-graduate"></i>student</a>

          <a id="enrollbtn" href="enroll.php" class="on"><i class="fas fa-tasks"></i>enroll</a>

          <a id="mailsbtn" href="mails.php" ><i class="fas fa-envelope"></i>mails</a>

          <a id="" href="other.php" ><i class="fa-solid fa-skull-crossbones"></i>other Access</a>
          
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
          <!-- <ul id="searchResults"></ul> -->
          <div class="enrollHeadSec">
            <h2>Enroll !!</h2>
            <button id="enrollStudent">Enroll Student</button>
          </div>


        </div>
      </div>
    </div>
    <div id="rightSidepane">
      <i class="fas fa-arrow-left" id="back2"></i>
      <div class="typeOfSearch">
        <h3>Enroll Here!</h3>
        <div class="navTraining">
          <button id="onebone" class="newenrollbutton">One by One</button>
          <button id="bygroup">By Course</button>
        </div>
        <form id="searchTypeForm">
          <div class="inputWtType">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="" id="searchStud" placeholder="Search for students...">
          </div>
        </form>
      </div>
      <ul id="studContent">
        <div class="loadli">
          <div class="inner-loadli">
            <ol>
              <span class="pictemplate"></span>
              <span class="infotemplate"><span class="Displayname"></span></span>
            </ol>
            <ol>
              <span class="pictemplate"></span>
              <span class="infotemplate"><span class="Displayname"></span></span>
            </ol>
            <ol>
              <span class="pictemplate"></span>
              <span class="infotemplate"><span class="Displayname"></span></span>
            </ol>
            <ol>
              <span class="pictemplate"></span>
              <span class="infotemplate"><span class="Displayname"></span></span>
            </ol>
          </div>
        </div>
        <section>
          <div class="ovCrs">
            <i class="fa-solid fa-square-plus" title="Enroll This Course"></i>
            <i class="fa-solid fa-circle-info" title="View Info"></i>
          </div>
          <img src="../../images/adminpic.png" id="coursePic" alt="">
          <h4>College of Information and Computing Science</h4>
        </section>



      </ul>
    </div>
  </div>





</body>

</html>