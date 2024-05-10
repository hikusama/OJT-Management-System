<?php
require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = filter_input(INPUT_POST, 'studentsId', FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM students WHERE stu_id = :searchQuery";
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
        switch ($result["year_levelnsection"]) {
            case '1st Year':
                $yearlevel = ' 
               <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="3rd Year">3rd Year</option>
                <option value="4rth Year">4rth Year</option>';
                break;
            case '2nd Year':
                $yearlevel = ' 
               <option value="2nd Year">2nd Year</option>
               <option value="1st Year">1st Year</option>
                <option value="3rd Year">3rd Year</option>
                <option value="4rth Year">4rth Year</option>
                ';
                break;
            case '3rd Year':
                $yearlevel = ' 
               <option value="3rd Year">3rd Year</option>
               <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="4rth Year">4rth Year</option>
                ';
                break;
            case '4rth Year':
                $yearlevel = ' 
               <option value="4rth Year">4rth Year</option>
               <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="3rd Year">3rd Year</option>
                ';
                break;
            default:
                break;
        }
        if ($result["gender"] === 'Male') {
            $genders =  '
            <select name="" id="genderc">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>';
        } elseif ($result["gender"] === 'Female') {
            $genders =  '
            <select name="" id="genderc">
            <option value="Female">Female</option>
            <option value="Male">Male</option>
            </select>';
        }
?>
        <div class="chpic">
            <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($result["profile_pic"]) ?>" alt="" srcset="" id="profdisplay3">
            <input type="file" id="changep3" accept="image/*" onchange="handleimg(3)">
            <label for="changep3" id="chngp3">Change profile</label>
        </div>

        <div class="inptcont">
            <i class="fa-regular fa-address-card"></i>
            <input id="student_idc" type="number" placeholder="Student No" value="<?php echo $result["student_id"] ?>">
        </div>

        <div class="inptcont">
            <i class="fas fa-user"></i>
            <input id="fnamee" type="text" placeholder="First name" value="<?php echo $result['firstname'] ?>">
        </div>
        <div class=" inptcont">
            <i class="fas fa-user"></i>
            <input id="lnamee" type="text" placeholder="Last name" value="<?php echo $result['lastname'] ?>">
        </div>


        <div class="inptcont">
            <i class="fas fa-user"></i>
            <input id="mnamec" type="text" placeholder="middlename" value="<?php echo $result["middlename"] ?>">
        </div>

        <div class="inptcont">
            <i class="fas fa-book"></i>
            <input id="coursec" type="text" placeholder="Course" value="<?php echo $result["course"] ?>">
        </div>
        <div class="inptcont">
            <i class="fas fa-graduation-cap"></i>
            <select name="" id="yearlevel">
                <?php echo $yearlevel ?>
            </select>
        </div>

        <div class="inptcont">
            <i class="fa-solid fa-phone"></i>
            <input id="contactc" type="number" placeholder="Contact" value="<?php echo $result["contact"] ?>">
        </div>
        <div class="inptcont">
            <i class="fas fa-map-marker-alt"></i>
            <input id="addressc" type="text" placeholder="Address" value="<?php echo $result["address"] ?>">
        </div>


        <div class="inptcont">
            <i class="fas fa-building"></i>
            <input id="departmentc" type="text" placeholder="Department" value="<?php echo $result["department"] ?>">
        </div>

        <div class="inptcont">
            <i class="fas fa-user gender-icon"></i>
            <?php echo $genders ?>
        </div>


        <div id="secondaryErrorDisplay">
        </div>
        <div class="coradbut2">
            <button class="scFrButton" id="<?php echo 'us' . $result['stu_id'] ?>">update</button>
        </div>

<?php
    } else {
        echo "nahh you loose";
    }
}
?>