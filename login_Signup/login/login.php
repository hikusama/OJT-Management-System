<?php
require_once '../../includes/config.php';
// require_once '../includes/session.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $userpassword = $_POST["password"];

    try {

        require_once 'login_model.php';
        require_once 'login_contr.php';

        $errors = [];

        if (is_inputs_empty($username, $userpassword)) {
            $errors["empty_inputs"] = "Please fill all fields!";
        }
        $result = get_user($pdo, $username);

        if ($result === null) {
            $errors["login_incorrect"] = "Username Doesn't exist!";
        } else {
            if (is_userpassword_wrong($userpassword, $result["password"])) {
                $errors["login_incorrect"] = "Wrong password!";
            }
        }

        if (is_username_wrong($pdo, $username) && isset($errors["login_incorrect"])) {
            $errors["login_incorrect"] = "Account doesn't exist!";
        }

        if (!$errors) {
            echo 'You are verified!!';
            // $signupData = [
            //     "username" => $username,
            // ];
            // $_SESSION["signup_data"] = $signupData;

            $_SESSION["user_id"] = $result["user_id"];
            $_SESSION['username'] = $result['username'];
            $_SESSION['user_role'] = $result['user_role'];

            if ($result['user_role'] == 'Student') {
                $studId = get_stud_id($pdo, intval($_SESSION["user_id"]));
                $_SESSION["accesstype"] = get_userType($pdo, intval($studId['stu_id']));
            }
            // if ($_SESSION['user_role'] == 'SuperAdmin') {
            //     header('location: ../../superadmin/pannelparts/overview.php');
            // } else if ($_SESSION['user_role'] == 'Supervisor') {
            //     // header('location: ../../superadmin/coor.php');
            // } else if ($_SESSION['user_role'] == 'Student') {
            //     // header('location: ../../Student/index.php');
            // } else if ($_SESSION['user_role'] == 'Admin') {
            //     header('location: ../../admin/pannelparts/overview.php');
            // }
        } else {
            foreach ($errors as $error) {
                echo '<h4 class="formError" style="color:red;font-family:sans-serif;">' . $error . '</h4>';
            }
        }
        // If everything is correct, set up session and redirect
        // $newSessionId = session_create_id();
        // $SessionId = $newSessionId . "_" . $result["id"];
        // session_id($SessionId);


        // $_SESSION["last_regeneration"] = time();

        // if ($_SESSION["user-role"] === "Student") {
        //     header("Location: ../Student/index.php?login=success");
        // } else if ($_SESSION["user-role"] === "Administrator") {
        //     header("Location: ../Admin/index.php?login=success");
        // } else if ($_SESSION["user-role"] === "Supervisor") {
        //     header("Location: ../Supervisor/index.php?login=success");
        // }

        // $pdo = null;
        // $statement = null;
        // die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
