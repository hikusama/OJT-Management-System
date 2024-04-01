<?php

declare(strict_types=1);

    function check_login_errors(){
        if(isset($_SESSION["errors_login"])){
            $errors = $_SESSION["errors_login"];
            echo "<br>";

            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red; font-family:sans-serif;">' . $error . '</p>';
            }

            unset($_SESSION['errors_login']);
        }

    }