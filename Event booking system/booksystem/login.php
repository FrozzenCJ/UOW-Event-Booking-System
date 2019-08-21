<?php
$db_connection = mysqli_connect("127.0.0.1", "root","", "booksystem");

session_start();
if(!empty($_SESSION['username'])){
	header("location: create.php");
}
?>
<link href="css/style.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - UOW EVENT BOOKING</title>
    <style>
    body { 
        background: url("img/uow-environment.jpg") no-repeat fixed center;
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
    <link rel="stylesheet" herf="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="res/css/style.css">     

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <a href="home.php" class="nav-brand  mr-auto">
            <img src="res/img/liverpool-logo.png" width="120" height="100" class="d-inline-block align-top" alt=""> </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-brand btn-dark" href="login.php" style="margin-right:20px">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-brand btn-dark" href="register.php" style="margin-right:40px">Register</a>
                </li>           
            </ul>
        </nav>
    </header>
    <div class="container ml-6 mr-0 mt-3">
        <h1 class="form-heading"><font color="000000"> Login</h1>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>

                <div class="form-group">
                     <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>

                <div class="row">
                    <div class="col">
                    <p><font color="043752">Doesn't have account? </font><a href = "register.php"><font color="red">Register</font></a> now!</p>
                    </div>
                    <div class="col text-right">
                    <p><font color="black">I'm an  </font><a href = "adminLogin.php"><font color="red">Administrator</font></a></p>
                    </div>
                </div>

                <button type="submit" name = "login" class="btn btn-white"><font color="black">Login</font></button>
            </form>
    </div> 

    <?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "select password from customer where username = '$username'";
        $query_run = mysqli_query($db_connection,$query);
        $num_rows = mysqli_num_rows($query_run);
        if($num_rows>0){
            $data = mysqli_fetch_assoc($query_run);
            if(password_verify($password, $data['password'])){
                session_start();
                $_SESSION['username'] = $username;
                header("location:create.php");
            }else{
                echo '<div class="alert alert-danger mt-3" role="alert">
            wrong password
            </div>';
            }

        }else{
            echo '<div class="alert alert-danger mt-3" role="alert">
            user not exist
            </div>';
        }
    }

    ?>
   



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>