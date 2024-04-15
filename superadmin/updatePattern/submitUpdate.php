<?php




require_once '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $key = $_POST["key"];
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $middlename = $_POST["mname"];
    $position = $_POST["position"];
    $department = $_POST["department"];
    $room = $_POST["room"];
    $gender = $_POST["gender"];





    $errors = [];
    try {

        require_once 'personalModel.php';
        require_once 'personalController.php';

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
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
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