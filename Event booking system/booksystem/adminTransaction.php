<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['inputAdmin'])){
	header("location: adminLogin.php");
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Creating Information - UOW EVENT BOOKING</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

		<link rel="stylesheet" href="res/css/style.css">

		<style>
		.align-middle{
			vertical-align: middle !important;
		}
		</style>
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
					<li class="nav-item active">
                        <a class="nav-link" href="adminTransaction.php" style="margin-right:20px">Creating Information</a>
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

		<div class="landing-text ml-5 mt-3">
            <h1>Creating Information Data</h1>
			
            <br>
            
			<div class="row">
				<div class="col-xs-12 col-sm-6">
				
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search by date/username/phonenum/field" id="keyword">
						
						<span class="input-group-btn">
							<button class="btn btn-primary" style="margin-left:5px" type="button" id="btn-search">SEARCH</button>
							<a href="" class="btn btn-warning">RESET</a>
						</span>
					</div>
				</div>
			</div>
			<br>
            <div class="site-content" id="view"><?php include "view.php"; ?></div>
		</div>
        
		
		<script src="js/jquery.min.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
		
		<script src="js/ajax.js"></script>
        
	</div>
	</body>
</html>


