
		<?php
			include_once("../funcd/dbh.php");

			$uid = $_POST['_uaccount'];
			$upassword = $_POST['_upassword'];
			$upasswordcheck = $_POST['_upasswordcheck'];
			//密碼加密
			$hashpassword = password_hash($upassword, PASSWORD_DEFAULT);
			$utel = $_POST['_utel'];
			$uemail = $_POST['_uemail'];
			$uname = $_POST['_uname'];
			$ugroup = $_POST['_ugroup'];
			$activasion = md5(uniqid(rand(),true));
			$userclass = $_POST['_uclass'];
			switch($userclass){
				case 0:$userclass='stall'; break;
				case 1:$userclass='host'; break;
				case 2:$userclass='rent'; break;
			}
     class Config {
     const BASE_URL = "http://127.0.0.1/marketfun/member_system/";
	 }
	              $sql = "SELECT * FROM user where U_id = '$uid'";
	              $result = mysqli_query($conn,$sql) or die("Error");
			//確認密碼輸入的正確性
				if($uid != null && $upassword != null && $upasswordcheck != null && $upassword == $upasswordcheck)
				{
						//新增資料進資料庫語法
						$sql = "insert into user (U_Name, U_Group, U_Tel, U_Email, U_Class, U_Password, U_Id,active) values ('$uname','$ugroup', '$utel', '$uemail', '$userclass', '$hashpassword', '$uid','$activasion')";
						if(mysqli_query($conn,$sql))
						{
							echo '<script language="JavaScript">;alert("註冊成功!");location.href="../homepage/homepage.php";</script>';
							//echo '註冊成功!';
							//echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
						}
/*						else if(mysqli_query($conn,$sql)&&(U_Email!=$uemail)&&(U_Id==$uid))
						{
							echo '<script language="JavaScript">;alert("新增失敗，帳號重複!");location.href="../homepage/homepage.php";</script>';
							//echo '新增失敗!';
							//echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
						}
						else if(mysqli_query($conn,$sql)&&(U_Email==$uemail)&&(U_Id!=$uid))
						{
							echo '<script language="JavaScript">;alert("新增失敗，信箱重複!");location.href="../homepage/homepage.php";</script>';
							echo '新增失敗!';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
						}*/
						else
						{
							echo '<script language="JavaScript">;alert("新增失敗，資料重複!");location.href="../homepage/homepage.php";</script>';
							//echo '新增失敗!';
							//echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
						}	
				}
				else{
						echo '<script language="JavaScript">;alert("註冊失敗，請輸入資料！");location.href="../homepage/homepage.php";</script>';
						//echo '註冊失敗!';
				}
	$id=mysqli_insert_id($conn);
	mb_internal_encoding("utf-8");
    $to=$uemail;
    $subject=mb_encode_mimeheader("市集趣認證信","utf-8");
    $message="<p>Thank you for registering at demo site.</p>
              <p>To activate your account, please click on this link: <a href='".Config::BASE_URL."activate.php?x=$uid&y=$activasion'>"
			                                                                    .Config::BASE_URL."activate.php?x=$uid&y=$activasion</a></p>
              <p>Regards Site Admin</p>";;
	$headers="MIME-Version: 1.0\r\n";
	$headers.="Content-type: text/html; charset=utf-8\r\n";
	$headers.="From:".mb_encode_mimeheader("寄件者顯示名稱","utf-8")."<410535033@gms.ndhu.edu.tw>\r\n";
    mail($to,$subject,$message,$headers);
		?>
