<!DOCTYPE HTML>
<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
	require_once '../funcd/dbh.php';
?>
<html>
	<head>
	</head>
	<body>
		<?php
			$sname=$_POST["_sname"];
			$scontent=$_POST["_scontent"];
			$sposition=$_POST["_sposition"];
			$stel=$_POST["_stel"];
			$eid=$_POST["_eid"];
			$ename=$_POST["_ename"];
			$uid=$_SESSION['userid'];
			$sql="INSERT INTO stall (S_Name,S_Content,S_Position,U_Tel,U_Id,E_Id,E_Name,S_Status) VALUES ('$sname','$scontent','$sposition','$stel','$uid','$eid','$ename','0')";
			$rst = mysqli_multi_query($conn,$sql);
			
			if($rst==true){
				header('Location: ../member_system/member_center.php');
			}
			else{
				echo mysqli_error($conn);
			}
		?>
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>