<?php
    require_once "../../includes/config.php";
    require_once "../../includes/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Enrollies</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Search Enrollies</a>
                    </div>
                    <?php
                    
                    // Attempt select query execution </close>
                    $sql = "SELECT request.*, student_info.student_id, student_info.lastname, student_info.firstname, student_info.department
                    FROM request
                    INNER JOIN student_info ON request.student_id = student_info.stu_id";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>student ID</th>";
                                        echo "<th>Last name</th>";
                                        echo "<th>First name</th>";
                                        echo "<th>DEPARTMENT</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";   
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['request_id'] . "</td>";
                                       echo "<td>" . $row['student_id'] . "</td>";
                                        echo "<td>" . $row['lastname'] . "</td>";
                                       echo "<td>" . $row['firstname'] . "</td>";
                                       echo "<td>" . $row['department'] . "</td>";
                                       echo "<td>";

                                        echo '
                                        <form action="../Student_Request/StuReq.php?request_id='. $row['request_id'] .
                                        '" method="post">
                                        <button>Admit</button>
                                        </form>';
                                           
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set </close>
                            unset($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    unset($pdo);
                     ?>
                     
                     <a href="../../Supervisor/index.php">go back to dashboard</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>