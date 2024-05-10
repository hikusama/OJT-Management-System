<?php




require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstusername = $_POST["firstusername"];
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];
    $confirm_password = $_POST["confirm_password"];





    $errors = [];
    $gooderrors = [];
    try {

        require_once 'updateModel.php';
        require_once 'updateController.php';


        if (empty($username)) {
            $errors["empty_inputs"] = "Please fill up the User Name";
        }

        if ($userpassword || $confirm_password) {
            if (is_password_not_matched($confirm_password, $userpassword)) {
                $errors["not_matched"] = "Password not matched!";
            }
            if (is_password_length_invalid($userpassword) && !is_password_not_matched($userpassword, $confirm_password)) {
                $errors["pw_invalid_length"] = "Password must more than 6 characters!";
            }
        }



        if ($firstusername != $username ) {
            $gooderrors['usernameModif'] = "<p style='color:rgb(175 135 0);'>Username modified from '<span style='font-weight: 600;'>" . $firstusername . "</span>'</p>";
            if (is_username_taken($pdo, $username)) {
                $errors["username_taken"] = "Username already taken!";
            }
        }
        
        if ((($userpassword && $confirm_password) && ($userpassword == $confirm_password))) {
            $gooderrors["pasatt"] = "<p style='color:rgb(175 135 0);'>Password modification attempt!</p>";
        }
                                                                                                                                                                                                                                                     




        if (!$errors) {

            if ($gooderrors ) {
                echo '<h4 class="setd" style="color:rgb(2, 136, 189); font-family:sans-serif;">Update Ready</h4>';
                echo '<div style="text-align: start;" >';
                echo "<p style='color:rgb(175 135 0);'>Note:</p>";
                foreach ($gooderrors as $gooderror) {
                    echo $gooderror;
                }
                echo '</div>';
            }else if(($firstusername == $username && !$userpassword || !$confirm_password)){
                echo "Make changes for update";
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
