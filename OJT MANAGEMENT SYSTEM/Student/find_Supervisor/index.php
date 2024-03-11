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
                        <h2 class="pull-left">Motorcycle Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Search supervisor</a>
                    </div>
                    <?php
                    
                    
                    // Attempt select query execution </close>
                    $sql = "SELECT * FROM supervisor";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>DEPARTMENT</th>";
                                        echo "<th>ROOM</th>";
                                        echo "<th>SUPERVISOR</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";   
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['supervisor_info_id'] . "</td>";
                                       echo "<td>" . $row['department'] . "</td>";
                                        echo "<td>" . $row['room'] . "</td>";
                                       echo "<td>" . $row['lastname'] . "</td>";
                                       echo "<td>";
                                       

                                    if('Action' == true){
                                        if(isset($_SESSION["stu_id"])){
                                            $stu_id = $_SESSION["stu_id"];
                                            echo '<p>' . $stu_id . '</p>';
                                        }else{
                                            echo '<p>id not set</p>';
                                        }
                                        echo '
                                        <form action="../find_Supervisor/request.php?supervisor_info_id='. $row['supervisor_info_id'] . '" method="post">
                                        <button>request</button>
                                        </form>';
                                    }

                                        echo "</td>";
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
                </div>
            </div>        
        </div>
    </div>
    <a href="../index.php">go back to dashboard</a>
</body>
</html>