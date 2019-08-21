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
    <title>Login -Creating a New Event</title>

    <style>
    body { 
        background: url("res/img/bekgronsearchbooking.jpg") no-repeat fixed center;
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }   
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="res/css/style.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <a href="home.php" class="nav-brand ml-3 mr-3">
            <img src="res/img/liverpool-logo.png" width="120" height="100" class="d-inline-block align-top" alt=""> </a>

            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a class="nav-link text-white" href="bookEvent.php" style="margin-Left:20px">Book an Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="booking.php" style="margin-Left:20px">My Booking</a>
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
    

    <?PHP
    $date=$_GET['date'];
    $field=$_GET['field'];
    $time = strtotime($date);
    $now = date('Y-m-d');
    $newformat = date('l\, F jS Y',$time);
    $day = floor(($time - time())/86400);
    if($day+1 <0 || $day+1 > 7 || $field<1 || $field>5 ){
        header("location:create.php");
    }else{
        echo'<div class="mt-3 ml-4 mb-1" style="max-width: 60%">';
        echo'<h1><font color="f29200">Search Result</font></h1>';

        echo '
        <div class = row style="max-width:55%">
            <div class="col-md-6 border-right">
            <p  style="display:inline;"><font color="f29200">'.$newformat.'</font></p>
            </div>
            <div class="col-md-6">
            <p class = "ml-2 mt-2" style="display:inline;"><font color="f29200">Field '.$field.'</font></p>
            </div>
        </div>
        </div>';
        
        echo '<h4 class = "ml-4 mt-4 mb-3"><font color="f29200">Time Available</font></h4>';
        echo '<div class="row ml-4 mt-1" style="max-width:90%;">';
        //echo $date;
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
            ?>
            </div>      
            <h4 class = "ml-4 mt-3"><font color="f29200">Choose your time</font></h4>
            <div class="mt-3 ml-4 mb-1" style="max-width: 60%">
                <form method="post">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="number" min=7 max=23  name="start_time" class="form-control"  placeholder="Start Time" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="number" min=1 max=5 name = "duration" class="form-control"  placeholder="Duration" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-warning mb-2" name="book"><font color="043752">Create Now!</font></button>
                        </div>  
                    </div>
                </form>
            </div>

            <?php
            }?>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Order Summary</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $start_time;?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    
    
    <?php
    if(isset($_POST['book'])){
        $start_time = $_POST["start_time"];
        $duration = $_POST["duration"];
        $end_time = $start_time + $duration;
        $conflict = false;
        $query = "select * from booking where tgl = '$date' and fieldnum=$field;";
        $query_run = mysqli_query($db_connection,$query);
        while($row = mysqli_fetch_assoc($query_run)){
            if( ($start_time <= $row['start'] && $end_time >= $row['end']) || ($start_time>=$row['start'] && $start_time<$row['end']) || ($end_time>$row['start'] && $end_time<=$row['end']) ){
                $conflict = true;
            }
        }
        if($conflict){
                echo'
                <div class="alert alert-danger mt-3 ml-4 mb-1" style="max-width: 60%" role="alert">
                <h5 class="alert-heading">Time Conflict!</h5>
                Please re-check and try again
                </div>
                ';
        }else{
                //echo '<script>$("#exampleModal").modal()</script>';
                ?>
                <h4 class = "ml-4 mt-3 text-white">Order Summary</h4>
                <form method = "post" class="mt-3 ml-4 mb-1" style="max-width: 60%">
                    <div class="form-group row">
                        <?php
                        $username = $_SESSION["username"];
                        $query = "select * from customer where username = '$username'";
                        $query_run = mysqli_query($db_connection,$query);
                        $row = mysqli_fetch_assoc($query_run);
                        $phonenum = $row['phonenum'];
                        $name = $row['name'];
                        ?>
                        <label for="staticEmail" class="col-sm-2 col-form-label text-white"> Principal</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext text-white" value=": <?php echo $name;?>">
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <label for="inputPassword" class="col-sm-2 col-form-label text-white">Date</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext text-white" id="inputPassword" value=": <?php echo $newformat;?>">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label text-white">Field Number</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext text-white" id="inputPassword" value=": <?php echo $field;?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label text-white">Event Time</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext text-white" id="inputPassword" value=": <?php echo $start_time.'.00 - '.$end_time.'.00';?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label text-white">Duration</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext text-white" id="inputPassword" value=": <?php echo $duration.' hour(s)';?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label text-white">Total Price</label>
                        <div class="col-sm-10">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <?php
                            $_SESSION['date'] = $date;
                            $_SESSION['field'] = $field;
                            $_SESSION["duration"] = $duration ;
                            $_SESSION["start_time"] = $start_time;
                            ?>
                            <a href=book.php><button type="button" class="btn btn-primary mb-2" name="confirm">Confirm!</button></a>           
                        </div>  
                    </div>

                </form>
                <?php
                if(isset($_POST['confirm'])){
                    $query = "  insert into booking (tgl,start,end,duration,username,fieldnum) values 
                                ('$date','$start_time','$end_time','$duration','$username','$field');";
                    $query_run = mysqli_query($db_connection,$query);
                    if($query_run){
                        echo 'Success';
                    }else{
                        echo "Some error occured, please try again!";
                    }
                }

            }
        
        
        
    }  
    ?>

    
    
</body>
</html>