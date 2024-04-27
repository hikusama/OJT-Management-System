<?php
require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = filter_input(INPUT_POST, 'adminId', FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM admins WHERE admin_info_id = :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['searchQuery' => $searchQuery]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result) {

        // $Data = [
        //     "firstname" => $result['firstname'],
        //     "lastname" => $result['lastname'],
        //     "middlename" => $result['middlename'],
        //     "email" => $result['email'],
        //     "position" => $result['position'],
        //     "room" => $result['room'],
        //     "department" => $result['department'],
        //     "gender" => $result['gender']
        // ] ;
        // $_SESSION["forupdates_data"] = $signupData;
?>

        <div class="chpic">
            <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($result["profile_pic"]) ?>" alt="" srcset="" id="profdisplay3">
            <input type="file" name="image" id="changep3" accept="image/*" onchange="handleimg(3)">
            <label for="changep3" id="chngp3">Change profile</label>
        </div>

        <div class="inptcont">
            <i class="fas fa-user"></i>
            <input id="fnamee" type="text" placeholder="First name" name="fname" value="<?php echo $result['firstname'] ?>">
        </div>
        <div class=" inptcont">
            <i class="fas fa-user"></i>
            <input id="lnamee" type="text" placeholder="Last name" name="lname" value="<?php echo $result['lastname'] ?>">
        </div>

        <div class="inptcont">
            <i class="fas fa-briefcase"></i>
            <input id="positione" type="text" placeholder="Position" name="position" value="<?php echo $result["position"] ?>">
        </div>
        <div class="inptcont">
            <i class="fas fa-building"></i>
            <input id="departmente" type="text" placeholder="Department" name="department" value="<?php echo $result["department"] ?>">
        </div>


        <div id="secondaryErrorDisplay">
                            </div>
        <div class="coradbut2">
            <button class="scFrButton" id="<?php echo 'us' . $result['admin_info_id'] ?>" >update</button>
        </div>
<?php
    } else {
        echo "nahh you loose";
    }
}
?>