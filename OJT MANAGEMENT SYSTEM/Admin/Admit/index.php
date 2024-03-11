<?php
    require_once '../../includes/session.php';
    require_once '../../includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <h1>Students</h1>
    <?php
        $sql = "SELECT * FROM user_info";
        if($result = $pdo->query($sql)){
            if($result->rowCount() > 0){
                echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>USERID</th>";
                                        echo "<th>STUDENT ID</th>";
                                        echo "<th>FIRST NAME</th>";
                                        echo "<th>LAST NAME</th>";
                                        echo "<th>MIDDLE NAME</th>";
                                        echo "<th>SCHOOL YEAR</th>";
                                        echo "<th>COURSE</th>";
                                        echo "<th>DEPARTMENT</th>";
                                        echo "<th>GENDER</th>";
                                        echo "<th>ADDRESS</th>";
                                        echo "<th>CONTACT</th>";
                                        echo "<th>EMAIL</th>";
                                        echo "<th>USERNAME</th>";
                                        echo "<th>USERPASSWORD</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";   
                                echo "</thead>";
                                echo "<tbody>";
                while($row = $result->fetch()){
                    echo "<tr>";
                    //echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['userid'] . "</td>";
                    echo "<td>" . $row['student_id'] . "</td>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['middlename'] . "</td>";
                    echo "<td>" . $row['school_yr'] . "</td>";
                    echo "<td>" . $row['course'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['contact'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['userpassword'] . "</td>";
                    echo "<td>";
                    // <label for="student_id">Student ID:</label>
                    echo '<form action="AdmitStudent.php" method="post">
                            
                            <input type="hidden" name="student_id" id="student_id" required value=' . $row['student_id'] . '>
                            <input type="hidden" name="username" value=' . $row['username'] . '>
                            <input type="hidden" name="userpassword" value=' . $row['userpassword'] . '>
                            <input type="hidden" name="student_id"required value=' . $row['student_id'] . '>
                            <input type="hidden" name="firstname" value=' . $row['firstname'] . '>
                            <input type="hidden" name="lastname" value=' . $row['lastname'] . '>
                            <input type="hidden" name="middlename" value=' . $row['middlename'] . '>
                            <input type="hidden" name="gender" value=' . $row['gender'] . '>
                            <input type="hidden" name="address" value=' . $row['address'] . '>
                            <input type="hidden" name="school_yr" value=' . $row['school_yr'] . '>
                            <input type="hidden" name="course" value=' . $row['course'] . '>
                            <input type="hidden" name="department" value=' . $row['department'] . '>
                            <input type="hidden" name="email" value=' . $row['email'] . '>
                            <input type="hidden" name="contact" value=' . $row['contact'] . '>
                            <input type="hidden" name="userid" value=' . $row['userid'] . '>
                            <!-- Add more input fields for other student information as needed -->
                            <input type="submit" value="Admit Student">
                        </form>';
                
                //     echo '<a href="productUse.html" class="mr-3" title="product description" data-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                //     <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                //     <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                //   </svg></a>';
                //   if(isset($_SESSION["user_id"])) {
                //     // User is logged in, retrieve the user ID
                //     $userId = $_SESSION["user_id"];
                // echo '<form action="" mehod="post">
                // <a href="AdmitStudent.php?user_id='. $row['student_id'] . '" title="Admit" data-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                // <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                // <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
                // </svg></a>
                // </form>';
                //     echo '<a href="AdminStudent.php?user_id='. $row['userid'] . '" title="Admit" data-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                //   <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                //   <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
                // </svg></a>';
                    // Proceed with comment insertion logic
                    // ...
                // } else {
                //     // User is not logged in, handle this scenario
                //     // For example, redirect the user to the login page
                //     header("Location: ../RegularPage/index.php");
                //     exit();
                // }


                //      echo '<a href="productBought.php?user_id='. $row['product_id'] .'" title="Add to cart" data-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                //      <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                //    </svg></a>';
                }
                echo "</tbody>";                            
                echo "</table>";
                // Free result set </close>
                unset($result);
            }else{
                echo '<div class="alert alert-danger"><em>No preduccts yet.</em></div>';
            }
        }else{
            die("query Field");
        }

        unset($pdo);
    ?>
        <form action="../logout.php">
            <button>logout</button>
        </form>
</body>
</html>