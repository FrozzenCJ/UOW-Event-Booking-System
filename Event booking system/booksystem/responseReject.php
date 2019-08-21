<?php
include 'dbConnect.php';
$transnum = $_GET['transnum'];
$reject="UPDATE booking SET status = 'Rejected' where transnum=$transnum";
mysqli_query($db_connection,$reject);
header("location:adminVerify.php");
?>