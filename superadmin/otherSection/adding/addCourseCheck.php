

<?php

require_once '../../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $dept_id = intval($_POST['dept_id']);
    $course = $_POST['course'];
    $crsacrn = $_POST['cacrn'];


    $errors = [];
    try {

        require_once 'othersModel.php';
        require_once 'othersController.php';


        
        if (!is_dptId_registered($pdo, $dept_id)) {
            $errors['deptId_not_registered'] = "Dept not exist!";
        }
        if (is_course_registered($pdo, $course)) {
            $errors['course_registered'] = "Course already Registered!";
        }

        if (is_crsacrm_registered($pdo, $crsacrn)) {
            $errors['deptacronym_registered'] = "Acronym already used!";
        }

        if (is_crs_field_empty($dept_id,$course,$crsacrn)) {
            $errors['empty'] = "Fill up all fields!";
        }

        if (!$errors) {
            echo 'Course Section Ready';

        } else {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }
    } catch (PDOException $th) {
        echo 'Query Failed: ' . $th -> getMessage();

    }
}
