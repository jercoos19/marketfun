<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
	require_once "dbh.php";
?>
<html>
	<head>
	</head>
	<body>
		<?php
			$eventdelete=$_GET["eid"];
			$sql="DELETE FROM event WHERE E_Id ={$eventdelete}";
			$rst = @mysqli_query($conn,$sql );
			
			if($rst){
				header('Location: ../member_system/member_center.php');
			}
		?>
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>