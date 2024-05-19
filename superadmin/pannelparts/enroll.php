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
   <link rel="stylesheet" href="../superAdmin.css?v=<?php echo time(); ?>">

   <link rel="stylesheet" href="../../css/tp.css?v=<?php echo time(); ?>">
   <style>
     .profSide h2::before {
       content: '<?php echo $_SESSION['user_role'] ?>';
     }
   </style>


   <title>Enroll</title>
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
           <h2 id="callN"><?php echo $_SESSION['username'] ?></h2>
         </div>
       </div>
       <nav>
         <ul id="tabs">

           <a id="overviewbtn" href="overview.php"><i class="fas fa-tachometer-alt"></i>overview</a>

           <a id="coordinatorsbtn" href="coordinators.php"><i class="fas fa-users"></i>coordinators</a>

           <a id="adminsbtn" href="admins.php"><i class="fas fa-cogs"></i>admins</a>

           <a id="studentbtn" href="student.php"><i class="fas fa-user-graduate"></i>student</a>

           <a id="enrollbtn" href="enroll.php" class="on"><i class="fas fa-tasks"></i>enroll</a>

           <a id="mailsbtn" href="mails.php"><i class="fas fa-envelope"></i>mails</a>

           <a id="" href="other.php"><i class="fa-solid fa-skull-crossbones"></i>other Access</a>

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
     <div class="head"><label id="toplab2" for="sideCheck">Enroll</label></div>
     <input type="checkbox" id="sideCheck" onclick="handleCheckboxChange()">
     <div id="content">
       <div id="students">
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

         <div class="students-inner">
           <div class="enrollHeadSec">
             <h2>Enroll !!</h2>
             <button id="enrollStudent">Enroll Student</button>
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
         <div id="cont-removeform">
           <div class="removeform">
             <form id="rmformreq">
               <p>Confirm for deletion</p>
               <div class="wr">
                 <i class="fas fa-lock"></i>
                 <input type="password" name="password" placeholder="Confirm password" autocomplete="new-password" autocomplete="new-password" id="pwdd">
               </div>
               <div id="responsetodel"></div>
               <button id="delG">Delete</button>
             </form>

           </div>
           <div class="outlosdrm">
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
         <div id="cont-viewinform">
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
         <div class="searchTp">
           <div class="srSpec">
             <form id="searchBySpec">
               <div class="inputWtType">
                 <i class="fa-solid fa-magnifying-glass"></i>
                 <input type="search" name="" id="searchStud" placeholder="Search for students...">
               </div>
             </form>
           </div>
           <div class="srGrp">
             <form id="searchGroup">
               <div class="inputWtType">
                 <i class="fa-solid fa-magnifying-glass"></i>
                 <input type="search" name="" id="searchCrs" placeholder="Search for courses...">
               </div>
             </form>
           </div>
         </div>
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



       </ul>
       <div class="requestForEnroll">
         <button id="byReq">Requests</button>
         <ul id="reqContent"></ul>
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



   <script src="../UX/enroll.js?v=<?php echo time(); ?>"></script>


 </body>

 </html>