<!DOCTYPE html>
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
			$fimage="../funcd/(field_image)/".$_FILES["_fimage"]["name"];
			if( move_uploaded_file($_FILES["_fimage"]["tmp_name"], $fimage));

			$fname=$_POST["_fname"];
			$fstartdate=$_POST["_fstartdate"];
			$fstarttime=$_POST["_fstarttime"];
			$fenddate=$_POST["_fenddate"];
			$fendtime=$_POST["_fendtime"];
			$faddr=$_POST["_faddr"];
			$fsize=$_POST["_fsize"];
			$fsizeselect=$_POST["_fsizeselect"];
			$fstallnum=$_POST["_fstallnum"];
			$ftel=$_POST["_ftel"];
			$finfo=$_POST["_finfo"];
			$uid=$_SESSION['userid'];
			$faddtime=date("Y-m-d H:i:s");
			
			$sql="INSERT INTO field (F_Name,F_Startdate,F_Starttime,F_Enddate,F_Endtime,F_Addr,F_Size,F_Sizeunit,F_Stallnum,U_Tel,F_Info,F_Image,F_Addtime,U_Id) 
			VALUES ('$fname','$fstartdate','$fstarttime','$fenddate','$fendtime','$faddr','$fsize','$fsizeselect','$fstallnum','$ftel','$finfo','$fimage','$faddtime','$uid')";

			$rst = mysqli_query( $conn, $sql );

			if($rst==true)
			{
				echo"<form method='GET' action='../fieldae/fieldmanage.php'>";
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