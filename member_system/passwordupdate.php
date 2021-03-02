<html>
    <?php 
        require_once '../funcd/dbh.php';
        $uid=$_SESSION['userid'];
        $sql = "SELECT * FROM user where U_Id = '$uid'";
		$result = mysqli_query($conn,$sql) or die("Error");
		if($row = mysqli_fetch_array ($result)){
            $db_password=$row['U_Password'];
        }
    ?>
    <head></head>
    <body>
        <form method="POST" action="../member_system/passwordupdate_check.php" enctype="multipart/form-data">
            <div id="pswupModal" class="pswupmodal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class='dialog-header'>
                        <span class="close">&times;</span>
                    </div>
                    <ul>
                        <li>
                            <h3>修改密碼</h3>
                        </li>
                        <li>
                            <input type="password" name="_uoldpassword" id="_uoldpassowrd" placeholder="舊的密碼">
                        </li>
                        <li>
                            <input type="password" name="_upassword" id="_upassowrd" placeholder="新的密碼">
                        </li>
                        <li>
                            <input type="password" name="_upasswordcheck" id="_upasswordcheck" placeholder="確認密碼">
                        </li>
                        <li>
                            <h3><input type=submit id="pswupsubbtn" value="確認修改"></input></h3>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="hidden" id="_db_password" name="_db_password" value="<?php echo $db_password; ?>">
        </form>
    </body>
</html>