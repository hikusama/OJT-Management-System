<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../index.php');
}

require_once '../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usid = $_SESSION["user_id"];
    $un = $_SESSION["username"];
    $sql = "SELECT admins.profile_pic FROM admins
    left join users on users.user_id = admins.users_id
    where users.user_id = :usid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usid', $usid, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the search result (assuming there's only one result)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {

?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($result['profile_pic']) ?>" id="sidepic" alt="">
            <h2 id="callN"><?php echo $un ?></h2>
<?php

    } else {
        echo "No matching admin found.";
    }
}