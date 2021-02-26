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
			$eimage="../funcd/(event_image)/".$_FILES["_eimage"]["name"];
			if( move_uploaded_file($_FILES["_eimage"]["tmp_name"], $eimage));

			$esimage="../funcd/(es_image)/".$_FILES["_esimage"]["name"];
			if( move_uploaded_file($_FILES["_esimage"]["tmp_name"], $esimage));
			$ename=$_POST["_ename"];
			$estartdate=$_POST["_estartdate"];
			$estarttime=$_POST["_estarttime"];
			$eenddate=$_POST["_eenddate"];
			$eendtime=$_POST["_eendtime"];
			$eaddr=$_POST["_eaddr"];
			$einfo=$_POST["_einfo"];
			$etel=$_POST["_etel"];
			$sdate=$_POST["_sdate"];
			$rmstall=$_POST['_rmstall'];
			$eventclass=$_POST["_eventclass"];
			$stallcheck= isset($_POST['stallallow']) ? 1 : 0;
			$uid=$_SESSION['userid'];
			$eaddtime = date("Y-m-d H:i:s");
			
			switch($eventclass){
				case 0:$eventclass='二手'; break;
				case 1:$eventclass='文創'; break;
				case 2:$eventclass='農作物'; break;
			}

			$sql="INSERT INTO event (E_Name,E_Startdate,E_Starttime,E_Enddate,E_Endtime,E_Slimitdate,E_Addr,E_Tel,E_Rmstall,E_Classification,E_Info,E_Image,E_Simage,U_Id,E_Stallcheck) 
			VALUES ('$ename','$estartdate','$estarttime','$eenddate','$eendtime','$sdate','$eaddr','$etel','$rmstall','$eventclass','$einfo','$eimage','$esimage','$uid','$stallcheck')";

			$rst = mysqli_query( $conn, $sql );

			if($rst==true){
				echo"<form method='GET' action='../eventae/eventmanage.php'>";
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