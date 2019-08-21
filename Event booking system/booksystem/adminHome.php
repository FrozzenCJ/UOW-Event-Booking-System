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
    <title>Administrator Home - UOW EVENT BOOKING</title>

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
                        <a class="nav-link" href="adminTransaction.php" style="margin-right:20px">Booking Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminList.php" style="margin-right:20px">Events List</a>
                    </li>
                    <li class="nav-item">
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

        <div class="landing-text ml-5">
            <h1>Welcome, Administrator!</h1>
        </div>
        
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>