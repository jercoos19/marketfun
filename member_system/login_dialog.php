<html>
    <head>
    </head>
    <body>
        <!-- The Modal -->
        <form method="post" action="../member_system/logincheck.php">
            <?php
                if(isset($_GET['msg'])){
                    echo "<p class='error'>{$_GET['msg']}</p>";
                }
            ?>
            <div id="logModal" class="logmodal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class='dialog-header'>
                       <span class="close">&times;</span>
                    </div>
                        <ul class="logininput">
                            <p><h1>會員登入</h1></p>
                            <li>
                                <input type="text" name="uid" id="uid" placeholder="帳號">
                            </li>
                            <li>
                                <input type="password" name="upassword" id="upassword" placeholder="密碼">
                            </li>
                            <li>
                                <input type="submit" id="loginbtn" class="dialogbtn" value=登入></input>
                                <div style="clear:both"></div>
                            </li>
                        </ul>
                    <h5><input type=button id="forgetbtn" value="忘記密碼"/>
                </div>
            </div>
        </form>
        <!--忘記密碼-->
        <form method="post" action="../member_system/logincheck.php">
            <?php
                if(isset($_GET['msg'])){
                    echo "<p class='error'>{$_GET['msg']}</p>";
                }
            ?>
            <div id="forgetpassModal" class="forgetpassmodal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class='dialog-header'>
                       <span class="close">&times;</span>
                    </div>
                    <ul class="logininput">
                        <p><h1>忘記密碼</h1></p>
						<li>
							<input type="text" name="uid" id="uid" placeholder="帳號">
						</li>
						<li>
							<input type="email" name="uemail" id="uemail" placeholder="電子信箱">
                        </li>
                        <li>
                            <input type="submit" id="diaforgetbtn" class="diaforgetbtn" value="確定送出"></input>
                            <div style="clear:both"></div>
						</li>
					</ul>
                </div>
            </div>
        </form>
        <script src="../funcd/js/jquery-1.11.3.min.js"></script>
        <script>
            $("#forgetbtn").click(function(){
                $('.forgetpassmodal').css('display','block');
                $('.logmodal').css('display','none');
            });
        </script>
    </body>
</html>