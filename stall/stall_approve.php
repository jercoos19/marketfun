<?php
	require_once '../funcd/dbh.php';
	$sid=$_GET["sid"];
	$eid=$_GET["eidnum"];
	//0等待 1同意 2拒絕
	$sql="UPDATE stall SET S_Status = 1 WHERE S_Id='$sid'";
	$rst = mysqli_multi_query($conn,$sql);
	
?>