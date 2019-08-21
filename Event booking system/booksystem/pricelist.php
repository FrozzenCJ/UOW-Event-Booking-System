<?php
$db_connection = mysqli_connect("127.0.0.1", "root","", "booksystem");
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Liverpool Futsal Depok</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="res/css/style.css">    
  </head>

<body>


    <header>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <a href="home.php" class="nav-brand ml-3 mr-3">
            <img src="img/uow-logo.jpg" width="120" height="100" class="d-inline-block align-top" alt=""> </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="margin-right:20px">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php" style="margin-right:40px">Sign Up</a>
                </li>           
            </ul>
        </nav>
    </header>
  <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center ">
    <h1 class="display-4 font-weight-normal">Daftar Harga terbaru!!!</h1>
    <p class="lead font-weight-normal">(3 Jam berturut-turut gratis 1 dus Aqua!!)</p>
  </div> 

    
<?PHP 
  $price = "select * from pricelist inner join field on field.fieldnum=pricelist.fieldnum order by opt asc;";
  $result= $db_connection->query($price);
  
  echo '<div class="album py-5 ">
          <div class="container">
              <div class="row"> ';
   ?>    

   <?php 
    $days = array('0', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday', 'Sunday');
  while($row = $result->fetch_assoc()) {
   ?>


  <div class="col-md-5 mr-4">
   <div class="card mb-5 bg-light ">
    <div class="card-body">
    <h2 class="display-7"><?php echo 'Day : '.$days[$row["startday"]].' - '.$days[$row["endday"]].' ' ;?> </h2>
         <ul class="list-unstyled mt-3 mb-4">
             <li><?php echo ' Jam '.$row["starttime"].'.00 - '.$row["endtime"].'.00 ';?> </li>
             <li><?php echo 'Jenis Lapangan : '.$row["tipe"].' ';?></li>
             <li><?php echo ' Harga : '.$row["price"].' ';?></li>
         </ul>
         </div>
     </div>
  </div> 
  <?php
  }
  ?>




  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>


