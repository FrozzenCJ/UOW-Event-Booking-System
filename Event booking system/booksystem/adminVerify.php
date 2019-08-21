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
		<title>Verification - UOW EVENT BOOKING</title>
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
					<li class="nav-item active">
                        <a class="nav-link" href="adminVerify.php" style="margin-right:20px">Verification</a>
                    </li>
					<li class="nav-item">
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
            <h1>Verify Reservation</h1>
            <br>
			<?php
					include "dbConnect.php";
					$sql = mysqli_query($db_connection, "SELECT * FROM verifikasi order by tgl desc");
						
					$sql2 = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlah FROM verifikasi");
					$get_jumlah = mysqli_fetch_array($sql2);
			?>
			<?php echo $get_jumlah['jumlah']; ?> data(s) waiting for confirmation.<br><br>
		</div>
		<div class="ml-5 mr-5">
		<input type='hidden' id='sort' value='asc'>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id='empTable' >
					<thead><tr>
						<th><span onclick='sortTable("username");'>Username</span></th>
						<th ><span onclick='sortTable("phonenum");'>Phone Number</span></th>
						<th><span onclick='sortTable("tgl");'>Date</span></th>
						<th><span onclick='sortTable("start");'>Start</span></th>
						<th><span onclick='sortTable("end");'>End</span></th>
						<th><span onclick='sortTable("duration");'>Duration</span></th>
						<th><span onclick='sortTable("fieldnum");'>FieldNum</span></th>
						<th><span onclick='sortTable("tipe");'>Type</span></th>
						<th>Action</th>
					</tr></thead>
					<?php
					while($data = mysqli_fetch_array($sql)){ 
						?>
							<tbody><tr>
								<td class="align-middle"><?php echo $data['username']; ?></td>
								<td class="align-middle"><?php echo $data['phonenum']; ?></td>
								<td class="align-middle"><?php echo $data['tgl']; ?></td>
								<td class="align-middle"><?php echo $data['start']; ?>.00</td>
								<td class="align-middle"><?php echo $data['end']; ?>.00</td>
								<td class="align-middle"><?php echo $data['duration']; ?> hour(s)</td>
								<td class="align-middle"><?php echo $data['fieldnum']; ?></td>
								<td class="align-middle"><?php echo $data['tipe']; ?></td>
								<td><a href="responseAccept.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-success">Accept</a>
								<a href="responseReject.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-danger">Reject</a></td>
							</tr></tbody>
						<?php
						}
						?>
					</table>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/ajax.js"></script>
	<script>
        function sortTable(columnName){
            
            var sort = $("#sort").val();
            $.ajax({
                url:'verif_fetch_details.php',
                type:'post',
                data:{columnName:columnName,sort:sort},
                success: function(response){
            
                    $("#empTable tr:not(:first)").remove();
                    
                    $("#empTable").append(response);
                    if(sort == "asc"){
                        $("#sort").val("desc");
                    }else{
                        $("#sort").val("asc");
                    }
                                
                }
            });
        }
</script>
	</body>
</html>


