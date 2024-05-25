<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usid = $_SESSION["user_id"];
    $sql = "SELECT admins.profile_pic,department.deptAcronym,department.department, department.program_pic,department.program_id 
    FROM admins
    left join users on users.user_id = admins.users_id
    left join  department on department.department = admins.department
    where users.user_id = :usid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usid', $usid, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the search result (assuming there's only one result)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $_SESSION['department'] = $result['department'];
        $_SESSION['program_id'] = $result['program_id'];

?>
        <div class="imgLabeling">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($result['profile_pic']) ?>" id="sidepicUser" alt="">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($result['program_pic']) ?>" id="sidepic" alt="">
        </div>
        <h2 id="callN"><?php echo $result['deptAcronym'] ?></h2>
<?php

    } else {
        echo "No matching admin found.";
    }
}
