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
  <link rel="stylesheet" href="../../css/tp.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../superAdmin.css?v=<?php echo time(); ?>">

  <script src="../UX/others.js?v=<?php echo time(); ?>"></script>

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


  <title>Other Access</title>
</head>

<body>
  <div class="bck"></div>

  <div class="outside">

    <div class="sideP">
      <div class="profSide">

        <div class="profsideCont" id="pcont">
          <img src="../../images/adminpic.png" id="sidepic" alt="">
          <h2 id="callN"><?php echo $_SESSION['username'] ?></h2>
        </div>
      </div>
      <nav>
        <ul id="tabs">

          <a id="overviewbtn" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>

          <a id="coordinatorsbtn" href="coordinators.php"><i class="fas fa-users"></i>coordinators</a>

          <a id="adminsbtn" href="admins.php"><i class="fas fa-cogs"></i>admins</a>

          <a id="studentbtn" href="student.php"><i class="fas fa-user-graduate"></i>student</a>

          <a id="enrollbtn" href="enroll.php"><i class="fas fa-tasks"></i>enroll</a>

          <a id="mailsbtn" href="mails.php"><i class="fas fa-envelope"></i>mails</a>

          <a id="" href="other.php" class="on"><i class="fa-solid fa-skull-crossbones"></i>other Access</a>

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
    <div class="head"><label id="toplab2" for="sideCheck">Other Access</label></div>
    <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
    <div id="content">
      <div class="othersec-inner">
        <label for="" id="overlayform2">
        </label>
        <label for="" id="overlayform">

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

        <!-- <ul id="searchResults"></ul> -->
        <!-- <div class="enrollHeadSec">
            <h2>Enroll !!</h2>
            <button id="enrollStudent">Enroll Student</button>
          </div> -->
        <div class="course-cont">
          <div class="courseHeadSec">
            <button id="addCourseBtn">Add Program</button>
          </div>
          <form id="searchCourse">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="" id="searchInput" placeholder="Search for Dept. or Course...">
          </form>
        </div>
        <!-- <ul id="courseResponse"></ul> -->


        <div id="cont-addCourse">
          <div class="addCourse-inner">
            <div class="formsact2">
              <form id="submitDept" enctype="multipart/form-data">
                <h3>Add Department</h3>
                <div class="chpic">
                  <img src="../../images/mali.png" id="profileImage" alt="">
                  <label for="image">Department Logo</label>
                  <input type="file" name="image" id="image" accept="image/*" onchange="handleimg()">
                </div>
                <div class="deptPart">
                  <div class="inptcont">
                    <i class="fas fa-building"></i>
                    <input autocomplete="off" type="text" placeholder="Department" id="dpt">
                  </div>
                  <div class="inptcont">
                    <i class="fas fa-key"></i>
                    <input autocomplete="off" type="text" placeholder="Acronym" id="deptacrn">
                  </div>
                </div>
                <div id="deptErrorResponse"></div>
                <div class="submitDeptBut">
                  <button type="submit">Submit</button>
                </div>
              </form>

              <form id="submitCourse">
                <h3>Add Course</h3>

                <div class="crsPart">
                  <div class="inptcont">
                    <i class="fas fa-building"></i>
                    <input autocomplete="off" type="text" placeholder="Dept. Belong" id="deptBel">
                    <div class="suggestDpt"></div>

                  </div>
                  <div class="inptcont">
                    <i class="fas fa-book"></i>
                    <input autocomplete="off" name="" id="course" type="text" placeholder="Course">
                  </div>
                  <div class="inptcont">
                    <i class="fas fa-key"></i>
                    <input autocomplete="off" type="text" placeholder="Acronym" id="crsacrn">
                  </div>
                </div>
                <div id="courseErrorResponse"></div>
                <div class="submitDeptBut">
                  <button type="submit">Submit</button>
                </div>
              </form>
            </div>

            <div class="outlosd2">
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


        <div class="responseMssg">
          <h3></h3>
          <p>Click anywhere to continue</p>
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
        <ul id="programCatalogContent"></ul>
      </div>
    </div>
  </div>

  </div>
</body>

</html>

<!-- 
<div class="crsPart">
                  <div class="inptcont">
                    <i class="fas fa-building"></i>
                    <input type="text" placeholder="Dept. Belong" id="deptBel">
                  </div>
                  <div class="inptcont">
                    <i class="fas fa-book"></i>
                    <select name="" id="course">
                      <option value="">Course</option>
                    </select>
                  </div>
                  <div class="inptcont">
                      <i class="fas fa-key"></i>
                      <input type="text" placeholder="Acronym" id="crsacrn">
                      
                  </div>
                </div> -->