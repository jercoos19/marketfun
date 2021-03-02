<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
	require_once 'dbh.php';

	
	$uid=$_POST["_uid"];
	/*修改密碼用
	$uoldpassword=$_POST["_uoldpassword"];
	$upassword=$_POST["_upassword"];
	$upasswordcheck=$_POST["_upasswordcheck"];*/
	/*基本資料修改*/
	$uname=$_POST["_uname"];
	$ugroup=$_POST["_ugroup"];
	$uemail = $_POST["_uemail"];
	$utel=$_POST['_utel'];
	$uclass=$_POST["_uclass"];
	
	$sql="UPDATE user SET U_Email='$uemail',U_Tel='$utel',U_Class='$uclass',U_Name='$uname',U_Group='$ugroup' WHERE U_Id='$uid'";
	$rst = @mysqli_query($conn,$sql);
	if($rst==true){
		header('Location: ../member_system/member_center.php');
	}
	else{
		echo "error";
	}
	
	else:
		header('Location: ../member_system/login.php');
	endif;
?>