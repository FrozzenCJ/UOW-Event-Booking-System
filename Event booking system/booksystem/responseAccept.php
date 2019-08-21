<?php
include 'dbConnect.php';
$transnum = $_GET['transnum'];
$accept="UPDATE booking SET status = 'Accepted' where transnum=$transnum";
mysqli_query($db_connection,$accept);
header("location:adminVerify.php");
?>