<?php
include "dbConnect.php";
?>

<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['inputAdmin'])){
	header("location: adminLogin.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Field Status - UOW EVENT BOOKING</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="res/css/style.css">
</head>
<body>

    <div class="site-content">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                <a href="adminHome.php" class="nav-brand ml-3 mr-3">
                <img src="img/uow-logo.jpg" width="120" height="100" class="d-inline-block align-top" alt=""> </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="adminVerify.php" style="margin-right:20px">Verification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminTransaction.php" style="margin-right:20px">Creating Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminList.php" style="margin-right:20px">Events List</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="adminField.php" style="margin-right:20px">Field</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a href = "adminLogout.php" class="nav-link" href="#" style="margin-right:40px">Logout</a>
                    </li>           
                </ul>
            </nav>
        </header>

        <div class="landing-text ml-5 mt-3">
            <h1>Field Status</h1>
        </div>

        <div class="mt-3 ml-5 mb-1" style="max-width: 60%">
            <form action="adminField.php" method="POST" class="form-inline">
                <div class="form-group mb-2">
                    <input type="date" class="form-control" name="date" required>
                </div>
                
                <div class="form-group mx-sm-3 mb-2">
                    <div class="form-group">
                            <select name = "field" class="form-control" required>
                                <option disabled>--select field--</option>
                                <option value="1">Field 1</option>
                                <option value="2">Field 2</option>
                                <option value="3">Field 3</option>
                                <option value="4">Field 4</option>
                            </select>   
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2" name="date_search">Search!</button>
            </form>
        </div>
        <?PHP
        if (isset($_POST['date_search'])){
            $field = $_POST['field'];
            $date = $_POST['date'];
            

            $time = strtotime($date);
            $now = date('Y-m-d');
            $newformat = date('l\, F jS Y',$time);

            $day = floor(($time - time())/86400);
            echo '<div class="row ml-5 mt-5" style="max-width:90%;">';
            for($x=7; $x<=23; $x++){
                $available=true;
                $query = "select * from booking where tgl = '$date' and fieldnum=$field;";
                $query_run = mysqli_query($db_connection,$query);
                while($row = mysqli_fetch_assoc($query_run)){
                    if($row['start'] <= $x && $x < $row['end'] && $row['status']!="Rejected"){
                        $available = false;
                    }
                }
                    
                if ($available){
                    echo'
                    <div class="card  mr-4 mb-2 " style="width:120px;">
                        <div class="card-body">
                            <h5 class="card-title mt-2 ml-1">'.$x.'.00 - '. ($x+1) .'.00</h5>
                        </div>
                    </div>';  
                } else{
                    echo'<div class="card mr-4 mb-2 bg-secondary" style="width:120px;">
                            <div class="card-body dark">
                                <h5 class="card-title mt-2 ml-1">'.$x.'.00 - '. ($x+1) .'.00</h5>
                            </div>
                        </div>';
                    }
                    
                }
                echo '</div>';
            echo '</div>';
        } 
        ?>
        
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>