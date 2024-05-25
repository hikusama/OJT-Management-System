<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Supervisor")) {
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
  <link rel="stylesheet" href="../supervisor.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../../css/tp.css?v=<?php echo time(); ?>">
  <style>
    
    .profSide h2::before {
      content: '<?php echo $_SESSION['user_role'] ?>';
    }
  </style>


  <title>Trainee</title>
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
        </div>
      </div>
      <nav>
        <ul id="tabs">
          <a id="overviewbtn" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>

          <a id="mailsbtn" href="request.php"><i class="fas fa-flag act1" title="Request"></i>request</a>

          <a id="coordinatorsbtn" href="mytrainee.php"><i class="fas fa-users"></i>my trainee</a>

          <a id="enrollbtn"class="on" href="trainee.php"><i class="fas fa-tasks"></i>trainee</a>

          <a id="mailsbtn" href="program.php"><i class="fas fa-envelope"></i>program</a>

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
    <div class="head"><label id="toplab2" for="sideCheck">Trainee</label></div>
    <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
    <div id="content">
      <div id="trainee">
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

        <div class="trainee-inner">
          <div class="enrollHeadSec">
            <form id="searchTrainee">
              <div class="inputWtType">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="" id="searchTr" placeholder="Search for trainee...">
              </div>
            </form>
          </div>
          <div class="navenroll">
            <div class="navenroll-inner">
              <button id="notDply">Not Deployed</button>
              <button id="dply">Deployed</button>
            </div>
          </div>
          <div class="outUl" id="rev">
            <div class="outlosdEnr">
              <div class="innerloadsd">
                <div class="loader">
                  <div class="bar"></div>
                  <div class="bar"></div>
                  <div class="bar"></div>
                  <div class="bar"></div>
                </div>
              </div>
            </div>
            <ul id="searchResults">
            </ul>
          </div>
        </div>
        <div id="cont-viewinform">
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
    <div class="responseMssg-out">
      <div class="responseMssg">
        <h3></h3>
        <p>Click anywhere to continue</p>
      </div>
    </div>


  </div>



  <script src="../UX/trainee.js?v=<?php echo time(); ?>"></script>


</body>

</html>