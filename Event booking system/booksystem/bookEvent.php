<?php
$db_connection = mysqli_connect("127.0.0.1", "root","", "booksystem");

session_start();
if(empty($_SESSION['username'])){
	header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - UOW EVENT BOOKING</title>

    <style>
    body { 
        background: url("res/img/bekgronhome1.jpg") no-repeat fixed center;
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        text-align:center
    }  
    .main{
    text-align: center; /*让div内部文字居中*/
    /* background-color: #fff; */
    /* border-radius: 20px; */
    /* width: 300px; */
    /* height: 350px; */
    /* margin: auto; */
    /* position: absolute; */
    /* top: 0; */
    /* left: 0; */
    /* right: 0; */
    /* bottom: 0; */
}
 
 
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="res/css/style.css">     

</head>
<body>
 
    <header>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top"    >
            <a href="home.php" class="nav-brand ml-3 mr-3">
            <img src="res/img/liverpool-logo.png" width="120" height="100" class="d-inline-block align-top" alt=""> </a>

            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a class="nav-link " href="bookEvent.php" style="margin-Left:20px">Book an Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="create.php" style="margin-Left:20px">Create an Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="event.php" style="margin-Left:20px">My Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="booking.php" style="margin-Left:20px">My Creating</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="history.php" style="margin-Left:40px">History</a>
                </li>  
            </ul> 

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" style="margin-Right:50px" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons" style="font-size:30px">account_circle</i> <?php echo $_SESSION['username']?></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </li>        
            </ul>
        </nav>
    </header>

    <div class="mt-3 ml-4 mb-1" style="max-width: 60%">
        <h1><font color="f29200">Book an event</font></h1>

        <form action="bookEvent.php" method="POST" class="form-inline">
            <div class="form-group mx-sm-1 mb-2">
                <div class="form-group">
                    <select name = "event" class="form-control" required>
                        <option value="0">--select field--</option>
                        <option value="1">Go hiking</option>
                        <option value="2">City travel</option>
                        <option value="3">Academic discussion meeting </option>
                        <option value="4">Astronomical research</option>
                        <option value="5">Natural Party</option>
                        <option value="6">Motorcycle racing</option>
                        <option value="7">Family activities</option>
                        <option value="8">Reading exchange meeting </option>
                        <option value="9">Dating party </option>
                        <option value="10">Foot ball </option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-warning mb-2" name="book" style="margin-left: 1%"><font color="043752">Book now!</font></button>
        </form>
    </div>

    
 

    <?PHP
    if(isset($_POST['book'])) {
        $username = $_SESSION['username'];
        $event = $_POST['event'];
        $update = "update eventbooking set CrntP = CrntP + 1 where id = '$event'";
        $conflict = false;
        $query = "select * from eventbooking where id = '$event'";
        $query_run = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            if ($row['CrntP'] < $row['MaxP']) {
                $conflict = true;
                $eventname = $row['eventname'];
                $id = $row['id'];
                mysqli_query($db_connection, $update) ;
                mysqli_query($db_connection, "insert into booking_man values ('$username','$id','$eventname','APPROVED') ");
            }
        }
        if($conflict){
            echo'
                <div class="alert alert-danger mt-3 ml-4 mb-1" style="max-width: 60%" role="alert">
                <h5 class="alert-heading">Book Successfully!</h5>
                </div>
                ';
        }else{
            echo'<div class="alert alert-danger mt-3 ml-4 mb-1" style="max-width: 60%" role="alert">
                <h5 class="alert-heading">Max People Already!</h5>
                </div>';
        }
    }

     
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>