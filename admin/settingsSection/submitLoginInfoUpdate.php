<?php


session_start();
if (!(isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "Admin")) {
    header('location: ../../../index.php');
}

require_once '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $key = $_POST["idToBePass"];
    $firstusername = $_POST["firstusername"];
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];
    $confirm_password = $_POST["confirm_password"];





    $errors = [];
    try {
        require_once 'actionfunc.php';
        require_once 'updateModel.php';
        require_once 'updateController.php';


        if (empty($username)) {
            $errors["empty_inputs"] = "Please fill up the User Name";
        }

        if ($userpassword || $confirm_password) {
            if (is_password_not_matched($confirm_password, $userpassword)) {
                $errors["not_matched"] = "Password not matched!";
            }
        }

        if ($firstusername != $username) {
            if (is_username_taken($pdo, $username)) {
                $errors["username_taken"] = "Username already taken!";
            }
        }





        if (!$errors) {

            if (($firstusername != $username  && empty($userpassword) && empty($confirm_password))) {
                update_Login_Cred_UserN_Only(
                    $pdo,
                    $key,
                    $username
                );
                $_SESSION["username"] = get_un_byid($pdo,$_SESSION["user_id"]);
                echo 'username updated succesfully';

            } else if (($firstusername == $username) && !empty($userpassword) && !empty($confirm_password)) {
                update_Login_Cred_Pw_Only(
                    $pdo,
                    $key,
                    $userpassword
                );
                echo 'password updated succesfully';
            } else if (($firstusername != $username  && !empty($userpassword) && !empty($confirm_password))) {
                updateLoginCredAll(
                    $pdo,
                    $key,
                    $username,
                    $userpassword
                );
                echo 'login credentials updated succesfully';


            } else if (($firstusername == $username) && empty($userpassword) && empty($confirm_password)) {
                
                echo "<h4 style='color:rgb(2, 136, 189);'>Make changes for update</h4>";
            }


        } else {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }
    } catch (PDOException $th) {
        die("Query failed: " . $th->getMessage());
    }
}
