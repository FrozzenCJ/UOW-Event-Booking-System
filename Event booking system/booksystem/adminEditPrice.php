<!DOCTYPE html>
<?php
include "dbConnect.php";
session_start();
if(empty($_SESSION['inputAdmin'])){
	header("location: adminLogin.php");
}
$opt = $_GET['opt'];
;
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Event - UOW EVENT BOOKING</title>

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
                    <li class="nav-item active">
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

        <div class="landing-text ml-5 mt-3">
            <h1>Edit Events Detail</h1>
        </div>
        <div class="landing-text ml-5 mt-3">
        <h6>This is <?php 
           echo($opt)
        ?> Events Detail </h6>
        </div>
        



        
            <div class="mt-3 ml-4 mb-1" style="max-width: 60%">
              <form method="POST">

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="number" min=1 max=4  name="fieldnum" class="form-control"  placeholder="Field number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="startday" class="form-control"  placeholder="Day Start" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="endday" class="form-control"  placeholder="Day Ends" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="number" min=0 max=24  name="starttime" class="form-control"  placeholder="Time Start" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="number" min=0 max=24  name="endtime" class="form-control"  placeholder="Time Ends" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="fieldtipe" class="form-control"  placeholder="Field Type" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="number" min=1 name = "price" class="form-control"  placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                           <button  id="submit" type="submit" class="btn btn-warning mb-2" name="submit"><font color="043752">Submit</font></button>  
                        </div>  
                    </div>
                </form>
            </div>

    
    
    
    
    
    
    
    
    
    
    
    
    <?php
    
    if (isset($_POST['submit'])) {
   
            $fieldnum = $_POST['fieldnum'];
            $startday = $_POST['startday'];
            $endday = $_POST['endday'];
            $starttime = $_POST['starttime'];
            $endtime = $_POST['endtime'];
            $fieldtipe = $_POST['fieldtipe'];
            $price = $_POST['price'];


    $sql = 
        "update pricelist 
        set 
        fieldnum = $fieldnum , 
        startday = $startday , 
        endday = $endday, 
        starttime =$starttime, 
        endtime =  $endtime, 
        fieldtipe = $fieldtipe , 
        price =  $price  
        where opt = $opt;";

        $query_run = mysqli_query($db_connection,$sql);
        if($query_run){
            echo 'Success';
        }else{
            echo "Some error occured, please try again!";
        }

    }
     ?>

    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>