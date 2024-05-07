

<?php

require_once '../../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $dept_id = intval($_POST['dept_id']);
    $course = ucwords($_POST['course']);
    $crsacrn = strtoupper($_POST['cacrn']);


    $errors = [];
    try {

        require_once 'othersModel.php';
        require_once 'othersController.php';


        if (is_course_registered($pdo, $course)) {
            $errors['course_registered'] = "Course already Registered!";
        }

        if (!is_dptId_registered($pdo, $dept_id)) {
            $errors['deptId_not_registered'] = "Dept not exist!";
        }

        if (is_crsacrm_registered($pdo, $crsacrn)) {
            $errors['deptacronym_registered'] = "Acronym already used!";
        }

        if (is_crs_field_empty($dept_id,$course,$crsacrn)) {
            $errors['empty'] = "Fill up the course!";
        }

        if (!$errors) {
            // var_dump($dept_id);
            // var_dump($course);
            // var_dump($crsacrn);
            addCourse($pdo,$dept_id,$course,$crsacrn);
            echo 'success';
        } else {
            foreach ($errors as $error) {
                echo '<p class="formError" style="color:red;font-family:sans-serif;">' . $error . '</p>';
            }
        }
    } catch (PDOException $th) {
        echo 'Query Failed: ' . $th -> getMessage();

    }
}
