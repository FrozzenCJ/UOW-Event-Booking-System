<?php
include 'dbConnect.php';
$transnum = $_GET['transnum'];
$delete="DELETE FROM booking where transnum=$transnum";
$delete2="DELETE FROM price where transnum=$transnum";
mysqli_query($db_connection,$delete);
mysqli_query($db_connection,$delete2);
header("location:adminTransaction.php");
?>