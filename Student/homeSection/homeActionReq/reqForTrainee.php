<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../../index.php');
}


require_once '../../../includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once '../homeModel.php';

    $studId = getStudId($pdo, intval($_SESSION["user_id"]));




    try {
        $type = get_userType($pdo, $studId);

        if ($type == 'notTrainee') {
            if (!isRequested($pdo, $studId)) {
                reqForTraineeExecute($pdo, $studId);
                echo '<p>Request Sent.</p>
            <button id="viewNotTrlogs">view logs</button>';
            } else {
                echo '<p>Request For Trainee Already Sent.</p>
            <button id="viewNotTrlogs">view logs</button>';
            }
        } else if ($type == 'notDeployed') {
            echo 'Please refresh your page you are now a TRAINEE';
            $_SESSION["accesstype"] = $type;
        } else if ($type == 'deployed') {
            echo 'Please refresh your page you are now a TRAINEE-DEPLOYED';
            $_SESSION["accesstype"] = $type;
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
