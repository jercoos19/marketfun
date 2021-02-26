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
		
			$eimage="../funcd/(event_image)/".$_FILES["_eimage"]["name"];
			if( move_uploaded_file($_FILES["_eimage"]["tmp_name"], $eimage));
			
			$ename=$_POST["_ename"];
			$estartdate=$_POST["_estartdate"];
			$estarttime=$_POST["_estarttime"];
			$eenddate=$_POST["_eenddate"];
			$eendtime=$_POST["_eendtime"];
			$eaddr=$_POST["_eaddr"];
			$einfo=$_POST["_einfo"];
			$etel=$_POST["_etel"];
			$eid=$_POST["_eid"];
			$euptime = date("Y-m-d H:i:s");
			$sdate=$_POST["_sdate"];
			$rmstall=$_POST['_rmstall'];
			$eventclass=$_POST["_eventclass"];
			$stallcheck= isset($_POST['stallallow']) ? 1 : 0;
			
			switch($eventclass){
				case 0:$eventclass='二手'; break;
				case 1:$eventclass='文創'; break;
				case 2:$eventclass='農作物'; break;
			}
			
			$sql="UPDATE event SET E_Name='$ename',E_Startdate='$estartdate',E_Starttime='$estarttime',E_Enddate='$eenddate',E_Endtime='$eendtime',E_Addr='$eaddr'
								  ,E_Info='$einfo',E_Tel='$etel',E_Image='$eimage',E_Uptime='$euptime',E_Slimitdate='$sdate',E_Rmstall='$rmstall',E_Classification='$eventclass',E_Stallcheck='$stallcheck' WHERE E_Id='$eid'";
			$rst = @mysqli_query($conn,$sql);
			if($rst==true){
				header('Location: ../member_system/member_center.php');
			}
			else{
				echo "error";
			}
		?>
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>