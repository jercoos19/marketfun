<html>
<?php
	session_start();
	require_once '../funcd/dbh.php';
    
    $uid=$_SESSION['userid'];
    $uoldpassword = $_POST['_uoldpassword'];
    $upassword = $_POST['_upassword'];
    $hashpassword = password_hash($upassword, PASSWORD_DEFAULT);
    $upasswordcheck = $_POST['_upasswordcheck'];
    $db_password = $_POST['_db_password'];
	if($upassword != null && $upasswordcheck != null && $uoldpassword != null && $upassword == $upasswordcheck){
		
        $sql="UPDATE user SET U_Password='$hashpassword' WHERE U_Id='$uid'";
        if(password_verify($uoldpassword , $db_password)){
            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            header('Location: ../member_system/member_center.php');
        }
        else{			
            echo '<script language="JavaScript">;alert("請確認舊密碼是否正確");location.href="../member_system/member_center.php";</script>';
        }
    }
    else{
        echo '<script language="JavaScript">;alert("請輸入完整資料");location.href="../member_system/member_center.php"</script>';
    }

 ?>
 </html>