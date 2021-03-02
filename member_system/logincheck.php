<html>
<?php
	session_start();
	require_once 'dbh.php';
	
	$loginid = $_POST['uid'];
	$loginpassword = $_POST['upassword'];
	
	if(isset($loginid) && isset($loginpassword)){
		
		$sql = "SELECT * FROM user where U_Id = '$loginid'";
		$result = mysqli_query($conn,$sql) or die("Error");
		if($row = mysqli_fetch_array ($result))
		{
			$db_user=$row['U_Id'];
			$db_password=$row['U_Password'];
			$db_uclass=$row['U_Class'];
		    $db_water=$row['active'];
			if(password_verify($loginpassword , $db_password)){
				if($db_water=='Yes'){
					$_SESSION['userid'] = true;
					$_SESSION['userid'] = $loginid;
					$_SESSION['userclass'] = $db_uclass;
					$sql = "Insert * FROM user where U_Id = '$loginid'";
					header('Location: ../homepage/homepage.php');}
				else {
					//header('Location: ../homepage/homepage.php?msg=登入失敗，請驗證信箱');
					echo '<script language="JavaScript">;alert("登入失敗，請驗證信箱");location.href="../homepage/homepage.php";</script>';
				}
			}
			else{
				$_SESSION['userid'] = false;			
				echo '<script language="JavaScript">;alert("登入失敗，請確認帳號密碼");location.href="../homepage/homepage.php";</script>';
				//echo "<script>alert('登入失敗，請確認帳號密碼')</script>";
				//header('Location: ../homepage/homepage.php?msg=登入失敗，請確認帳號密碼');
				
			}
		}
	
	else{
		echo '<script language="JavaScript">;alert("登入失敗，請輸入帳號密碼");location.href="../homepage/homepage.php";</script>';
		//header('Location: ../member_system/login.php');
	}
	}
 ?>
 </html>