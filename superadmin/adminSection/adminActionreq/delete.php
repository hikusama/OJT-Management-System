<?php
session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "SuperAdmin")) {
    header('location: ../../../index.php');
}
require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username =  $_SESSION['username'];
        $userpassword = $_POST["password"];
        $usrId = $_POST["userId"];
        $adminId = $_POST["adminId"];

        try {
            require_once 'actionfunc.php';
            $errors = [];

            if (is_inputs_empty($userpassword)) {
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

            if ($errors) {
                foreach ($errors as $error) {
                    echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
                }
            } else {
                $sql = "DELETE FROM admins WHERE admin_info_id = :adminId";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['adminId' => $adminId]);

                $sql2 = "DELETE FROM users WHERE user_id = :usrId";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute(['usrId' => $usrId]);
                // echo '<input type="radio" id="sakses" style="position:absolute; visibility:hidden;" value="success">';

                if ($stmt->rowCount() > 0 && $stmt2->rowCount() > 0) {

                    echo 'success';
                }
            }
        } catch (PDOException $e) {
            die("Query Deletion Failed: " . $e->getMessage());
        }




    
} else {
    header("Location: ../../index.php");
    die();
}
