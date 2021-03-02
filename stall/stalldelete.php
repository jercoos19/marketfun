<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
	require_once "../funcd/dbh.php";
?>
<html>
	<head>
	</head>
	<body>
		<?php
			$stalldelete=$_GET["sid"];
			$sql="DELETE FROM stall WHERE S_Id ={$stalldelete}";
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