

<?php

require_once '../../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dpt = $_POST['dpt'];
    $deptacrn = $_POST['dacrn'];

    // $course = $_POST['course'];
    // $crsacrn = $_POST['cacrn'];


    $errors = [];
    try {

        require_once 'othersModel.php';
        require_once 'othersController.php';

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
            $errors["pic_error"] = "Please choose a Department pic!";
        }


        if (is_dpt_registered($pdo, $dpt)) {
            $errors['dept_registered'] = "Dept already registered!";
        }
        if (is_deptacrm_registered($pdo, $deptacrn)) {
            $errors['deptacr_registered'] = "Acronym already used!";
        }

        if (is_dept_field_empty($dpt,$deptacrn)) {
            $errors['empty'] = "Fill up the fields!";
        }

        if (!$errors) {
            echo 'Dept Section Ready';

        } else {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }
    } catch (PDOException $th) {
        echo 'Query Failed: ' . $th -> getMessage();

    }
}
