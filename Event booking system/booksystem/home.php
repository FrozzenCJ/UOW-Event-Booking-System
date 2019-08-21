<?php
$db_connection = mysqli_connect("127.0.0.1", "root","", "booksystem");

session_start();
if(!empty($_SESSION['username'])){
	header("location: create.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UOW EVENT BOOKING</title>
    <style class="bg">
    body { 
        background: url("res/img/bekgron.jpg") no-repeat fixed center;
        position: relative;
        -webkit-animation:20s linear 0s alternate animate infinite ;
    }   
    </style>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="res/css/style.css">
</head>
<body>

    <div class="site-content">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                <a href="home.php" class="nav-brand ml-3 mr-3">
                <img src="res/img/liverpool-logo.png" width="150" height="120" class="d-inline-block align-top" alt=""> </a>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-brand btn-circle btn-dark" href="login.php" style="margin-right:20px"><font color="white">Login</font></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-brand btn-circle btn-dark" href="register.php" style="margin-right:40px"><font color="white">Register</font></a>
                    </li>           
                </ul>
            </nav>
        </header>

    
        <div class="landing-text ml-5">
            <h1 style="margin-top: 0%"><font color="ffffff">We're now available for</font></h1>
            <h1 ><font color="ffffff">Online booking!</font></h1>
        </div>

    </div>

    <form action="home.php" method="post" style="margin-top: 5%">
        <div class="container" style="margin-left: 20%">
            <div class="col-xs-push-5 col-sm-pull-10">
                <div class="row">
                    <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search for event you want" id="keyword">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" style="margin-left:5px" type="button" id="btn-search">SEARCH</button>
                                    <a href="event.php" class="btn btn-warning">SEE ALL</a>
                                </span>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    $output = '';
    if(isset($_POST['search'])){
        $searchq = $_POST['search'];
        //$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
        $query = mysqli_query("$db_connection","SELECT * FROM eventbooking WHERE id = '$searchq' or eventname = '$searchq'") or die("Could not search this event!");
        $count = mysqli_num_rows($searchq);

        if ($count == 0){
            $output = 'There was no search results!';
            header("location: eventdetail.php");
        }else{
            while($row = mysqli_fetch_array($searchq)){
                $id = $row['id'];
                $eventname = $row['Event Name'];

                $output .= '<div>'.$id.' '.$eventname.'</div>';
            }
        }
    }
    // print('$output');
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>