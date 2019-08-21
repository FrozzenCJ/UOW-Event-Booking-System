<?php
$db_connection = mysqli_connect("127.0.0.1", "root","", "booksystem");
session_start();
if(empty($_SESSION['username'])){
	header("location: login.php");
}

$transnum = $_GET['transnum'];

$query = "delete from booking where transnum = $transnum";
$query_run = mysqli_query($db_connection,$query);

$query = "delete from price where transnum = $transnum";
$query_run = mysqli_query($db_connection,$query);

if($query_run){
    header("location: booking.php");
}else{
    echo 'Error cancelling please try again';
}
?>