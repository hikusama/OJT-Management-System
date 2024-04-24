<?php




require_once '../../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and remove spaces from inputs
    // Function to sanitize input
    function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Sanitize inputs


    $fnameec = sanitizeInput($_POST["fnameec"]);
    $lnameec = sanitizeInput($_POST["lnameec"]);
    $positionec = sanitizeInput($_POST["positionec"]);
    $departmentec = sanitizeInput($_POST["departmentec"]);


    $firstname = sanitizeInput($_POST["fname"]);
    $lastname = sanitizeInput($_POST["lname"]);
    $position = sanitizeInput($_POST["position"]);
    $department = sanitizeInput($_POST["department"]);



    // fnameec = $('#fnamee').val();
    // lnameec = $('#lnamee').val();
    // mnameec = $('#mnamee').val();
    // positionec = $('#positione').val();
    // departmentec = $('#departmente').val();
    // roomec = $('#roome').val();
    // gnec = $('#gne').val(); 




    $modifieds = [];
    $errors = [];
    try {

        require_once 'updateModel.php';
        require_once 'updateController.php';

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $fileSize = $_FILES['image']['size']; // Size of the uploaded file in bytes

            $maxFileSize = 1 * 1024 * 1024;

            if (in_array($fileExtension, $allowedExtensions)) {
                if ($fileSize <= $maxFileSize) {
                    $ImageData = file_get_contents($_FILES['image']['tmp_name']);
                } else {
                    $errors["pic_error"] = "The file size exceeds the maximum allowed limit (1 MB)!";
                }
            } else {
                $errors["pic_error"] = "Only JPG and PNG files are allowed for profile pictures!";
            }
        } else {
            $errors["pic_error"] = "Please choose a profile pic!";
        }





        if (isset($_POST["changed"])) {
            $modifieds['picture_modified'] = 'Profile picture';
        }
        if ($firstname != $fnameec) {
            $modifieds['firstname_modified'] = 'Firstname';
        }
        if ($firstname != $fnameec) {
            $modifieds['firstname_modified'] = 'Firstname';
        }
        if ($lastname != $lnameec) {
            $modifieds['lastname_modified'] = 'Lastname';
        }

        if ($position != $positionec) {
            $modifieds['position_modified'] = 'Position';
        }
        if ($department != $departmentec) {
            $modifieds['department_modified'] = 'Department';
        }





        if (is_empty_update_personal_inputs(
            $firstname,
            $lastname,
            $position,
            $department,
        )) {
            $errors["empty_inputs"] = "Please fill all fields";
        }



        if (!$errors) {

            if ($modifieds) {
                echo '<h4 class="setd" style="color:rgb(2, 136, 189); font-family:sans-serif;">Update Ready</h4>';
                echo '<div style="text-align:start; display:grid; place-items:center;" class="allmodified" >';
                echo '<div style="width:fit-content;" >';
                echo '<h4 style="color:rgb(175 135 0); margin-top:.5rem;">Note: </h4>';
                foreach ($modifieds as $modified) {

                    if ($modified == 'Firstname') {
                        echo '<p class="formError" style="color:rgb(175 135 0)">' . $modified . ' Modified From "<span style="color:rgb(175 135 0); font-weight:900;">' . $fnameec . '</span>"</p>';
                    } else if ($modified == 'Lastname') {
                        echo '<p class="formError" style="color:rgb(175 135 0)">' . $modified . ' Modified From "<span style="color:rgb(175 135 0); font-weight:900;">' . $lnameec . '</span>"</p>';
                    } else if ($modified == 'Position') {
                        echo '<p class="formError" style="color:rgb(175 135 0)">' . $modified . ' Modified From "<span style="color:rgb(175 135 0); font-weight:900;">' . $positionec . '</span>"</p>';
                    } else if ($modified == 'Department') {
                        echo '<p class="formError" style="color:rgb(175 135 0)">' . $modified . ' Modified From "<span style="color:rgb(175 135 0); font-weight:900;">' . $departmentec . '</span>"</p>';
                    } else if($modified == 'Profile picture'){
                        echo '<p class="formError" style="color:rgb(175 135 0)"><span style="color:rgb(175 135 0); font-weight:900;">"' . $modified . '"</span> Modified!!</p>';
                    }
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo "<h4 style='color:rgb(2, 136, 189);'>Make changes for update</h4>";
            }
        } else {
            foreach ($errors as $error) {
                echo '<h4 class="formError" style="color:red;font-family:sans-serif;">' . $error . '</h4>';
            }
        }

        // Output response as JSON
    } catch (PDOException $th) {
        die("Query failed: " . $th->getMessage());
        // $response = array('success' => false, 'message' => 'Query Failed: ' . $th->getMessage());
    }





    // $sql = "SELECT * FROM supervisors WHERE supervisor_info_id = :searchQuery";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['searchQuery' => $searchQuery]);

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);


}
