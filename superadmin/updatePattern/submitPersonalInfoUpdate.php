<?php




require_once '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and remove spaces from inputs
    // Function to sanitize input
    function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Sanitize inputs
    $key = sanitizeInput($_POST["key"]);
    $fnameec = sanitizeInput($_POST["fnameec"]);
    $lnameec = sanitizeInput($_POST["lnameec"]);
    $mnameec = sanitizeInput($_POST["mnameec"]);
    $positionec = sanitizeInput($_POST["positionec"]);
    $departmentec = sanitizeInput($_POST["departmentec"]);
    $roomec = sanitizeInput($_POST["roomec"]);
    $gnec = sanitizeInput($_POST["gnec"]);

    $firstname = sanitizeInput($_POST["fname"]);
    $lastname = sanitizeInput($_POST["lname"]);
    $middlename = sanitizeInput($_POST["mname"]);
    $position = sanitizeInput($_POST["position"]);
    $department = sanitizeInput($_POST["department"]);
    $room = sanitizeInput($_POST["room"]);
    $gender = sanitizeInput($_POST["gender"]);



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





        if ($firstname != $fnameec) {
            $modifieds['firstname_modified'] = 'Firstname';
        }
        if ($lastname != $lnameec) {
            $modifieds['lastname_modified'] = 'Lastname';
        }
        if ($middlename != $mnameec) {
            $modifieds['middlename_modified'] = 'Middlename';
        }
        if ($position != $positionec) {
            $modifieds['position_modified'] = 'Position';
        }
        if ($department != $departmentec) {
            $modifieds['department_modified'] = 'Department';
        }
        if ($room != $roomec) {
            $modifieds['room_modified'] = 'Room';
        }
        if ($gender != $gnec) {
            $modifieds['gender_modified'] = 'Gender';
        }




        if (is_empty_update_personal_inputs(
            $firstname,
            $lastname,
            $middlename,
            $position,
            $department,
            $room,
            $gender,
        )) {
            $errors["empty_inputs"] = "Please fill all fields";
        }



        if (!$errors) {

            if ($modifieds) {
                updatePersonal(
                    $pdo,
                    $key,
                    $ImageData,
                    $firstname,
                    $lastname,
                    $middlename,
                    $position,
                    $department,
                    $room,
                    $gender
                );
                echo '<p class="setd" style="color:green;font-family:sans-serif;">success</p>';
            } else {
                echo "<h4 style='color:rgb(2, 136, 189);'>Make changes to update</h4>";
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

    // if (!$errors) {
    //     updatePersonal(
    //         $pdo,
    //         $key,
    //         $ImageData,
    //         $firstname,
    //         $lastname,
    //         $middlename,
    //         $position,
    //         $department,
    //         $room,
    //         $gender
    //     );
    //     echo '<p class="setd" style="color:green;font-family:sans-serif;">success</p>';
    // } else {
    //     foreach ($errors as $error) {
    //         echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
    //     }
    // }