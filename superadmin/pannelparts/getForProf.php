<?php


require_once '../../includes/config.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uID = intval($_POST['uID']);

    $sql2 = "SELECT * FROM users INNER JOIN students ON user_id = :userids";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uID', $uID, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the search result (assuming there's only one result)
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result1) {
        $userids = $result1['users_id'];

        // Prepare the second SQL statement with named placeholders
        $sql2 = "SELECT * FROM users INNER JOIN students ON user_id = :userids";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':userids', $userids, PDO::PARAM_INT);
        $stmt2->execute();

        $resultF = $stmt2->fetch(PDO::FETCH_ASSOC);
        if ($resultF) {
?>

                <img src="data:image/jpeg;base64,<?php echo base64_encode($result1[' profile_pic']) ?>" id="sidepic" alt="">
                <h2 id="callN"><?php echo $result1 ?></h2>
    <?php
        } else {
            echo "No matching user found.";
        }
    } else {
        echo "No matching admin found.";
    }
}
    ?>