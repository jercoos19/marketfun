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
			$fielddelete=$_GET["fid"];
			$sql="DELETE FROM field WHERE F_Id ={$fielddelete}";
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