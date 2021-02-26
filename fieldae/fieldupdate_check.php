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
			$fid=$_POST["_fid"];
			$fsizeselect=$_POST["_fsizeselect"];
			$fstallnum=$_POST["_fstallnum"];
			$ftel=$_POST["_ftel"];
			$finfo=$_POST["_finfo"];
			$uid=$_SESSION['userid'];
			$fuptime=date("Y-m-d H:i:s");
			
			$sql="UPDATE field SET F_Name='$fname',F_Startdate='$fstartdate',F_Starttime='$fstarttime',F_Enddate='$fenddate',F_Endtime='$fendtime'
			,F_Addr='$faddr',F_Size='$fsize',F_Sizeunit='$fsizeselect',F_Info='$finfo',F_Stallnum='$fstallnum',U_Tel='$ftel',F_Image='$fimage',F_Uptime='$fuptime' WHERE F_Id='$fid'";
			$rst = @mysqli_query($conn,$sql );
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
		header('Location: ../homepage/homepage.php');
	endif;
?>