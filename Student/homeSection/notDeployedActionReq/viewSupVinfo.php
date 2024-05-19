<?php


require_once '../../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sup_Id = $_POST['sup_Id'];

    try {

        $sql = "SELECT * FROM supervisors
        left join users on users.user_id = supervisors.users_id
        where supervisor_info_id = :sup_Id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':sup_Id', $sup_Id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo '
            <div class="outlosdviewinfo">
<div class="innerloadsd">
    <div class="loader">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</div>
</div>';
            echo '<div class="viewSupV">
            <div class="imgSec">
                <div class="innahPic">
                    <img src="data:image/jpeg; base64,' . base64_encode($result['profile_pic']) . '" alt="">
                </div>
            </div>
            <div class="supVInfoBody">
                <h3>' . $result['lastname'] . ', ' . $result['firstname'] . ' ' . $result['middlename'] . '</h3>
                <p>Position: <span>' . $result['position'] . '</span></p>
                <p>Department: <span>' . $result['department'] . '</span></p>
                <p>Room: <span>' . $result['room'] . '</span></p>
                <p>Email: <span>' . $result['email'] . '</span></p>
            </div>
        </div>';
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
