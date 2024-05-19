<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../index.php');
}


require_once '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usid = $_SESSION["user_id"];

    $sql = "SELECT * FROM users WHERE user_id = :usid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usid',$usid);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
?>
        <div class="inptcont">
            <i class="fas fa-user"></i>
            <input type=" text" id="usernamee" placeholder="Username" name="username" value="<?php echo $result['username'] ?>">
        </div>
        <div class="inptcont">
            <i class="fas fa-lock"></i>
            <input type="password" id="passworde" placeholder="New Password" name="userpassword" class="border">
        </div>
        <div class="inptcont">
            <i class="fas fa-lock"></i>
            <input class="CP" id="confirm_passworde" type="password" placeholder="Confirm Password" name="confirm_password">
        </div>
        <div id="primaryErrorDisplay">
        </div>
        <div class="coradbut2">
            <button  class="prdp" id="us<?php echo $result['user_id'] ?>" >update</button>
        </div>
<?php
    } else {
        echo "nahh youd loose";
    }
}
