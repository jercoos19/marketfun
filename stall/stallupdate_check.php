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
			$stel=$_POST["_stel"];
			$sid=$_POST["_sid"];
			$sname=$_POST["_sname"];
			$sposition=$_POST['_sposition'];
			$scontent=$_POST["_scontent"];
			
			$sql="UPDATE stall SET S_Name='$sname',S_Position='$sposition',S_Content='$scontent',U_Tel='$stel' WHERE S_Id='$sid'";
			$rst = @mysqli_query($conn,$sql);
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