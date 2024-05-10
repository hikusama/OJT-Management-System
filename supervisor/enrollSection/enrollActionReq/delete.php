<?php

require_once '../../../includes/config.php';

// session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION["signup_data"] = "cent";
        $username =  $_SESSION["signup_data"];
        $userpassword = $_POST["password"];
        $studentsId = $_POST["studentsId"];

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
                $sql = "DELETE FROM trainee WHERE trainee.stu_id = :studentsId";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['studentsId' => $studentsId]);

                // echo '<input type="radio" id="sakses" style="position:absolute; visibility:hidden;" value="success">';

                if ($stmt->rowCount() > 0) {
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
