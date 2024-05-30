


<?php

session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Student")) {
    header('location: ../../index.php');
}


require_once '../../includes/config.php';



$errors = [];
require_once 'programModel.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SESSION["accesstype"] == 'deployed') {
        $studId = getStudId($pdo, intval($_SESSION["user_id"]));
        $trainee_id = getTraineeId($pdo, $studId);

        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
            $fileSize = $_FILES['img']['size']; // Size of the uploaded file in bytes

            $maxFileSize = 1 * 1024 * 1024;

            if (in_array($fileExtension, $allowedExtensions)) {
                if ($fileSize <= $maxFileSize) {
                    $ImageData = file_get_contents($_FILES['img']['tmp_name']);
                } else {
                    $errors["pic_error"] = "The file size exceeds the maximum allowed limit (1 MB)!";
                }
            } else {
                $errors["pic_error"] = "Only JPG and PNG files are allowed for profile pictures!";
            }
        } else {
            $errors["pic_error"] = "Please choose a profile pic!";
        }
        $title = $_POST['title'];
        $place = $_POST['place'];
        $time_acquired = intval($_POST['time_acquired']);
        $narrative = $_POST['narrative'];

        if (!is_numeric($time_acquired)) {
            $errors["must_integer_val"] = "Time must be integer val!";
        } else {
            if ($time_acquired > 8) {
                $errors["limit_time"] = "Max time is 8hrs!";
            }
            if ($time_acquired < 1) {
                $errors["limit_time"] = "Min time is 1hrs!";
            }
        }


        if (
            empty($title) ||
            empty($place) ||
            empty($time_acquired) ||
            empty($narrative)
        ) {
            $errors["empty_inputs"] = "Fill in all fields!";
        }

        if (!$errors) {
            executeSubmitReport($pdo, $trainee_id, $ImageData, $title, $place, $time_acquired, $narrative);
            echo 'success';
        } else {
            foreach ($errors as $error) {
                echo '<p style="color:red !important"> ' . $error . '</p>';
            }
        }
    }else{
        echo '<p style="color:#ff4141  !important">Deploy your self first please..</p>';

    }
}
