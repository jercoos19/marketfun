<html>
    <head>
    </head>
    <body>
        <!-- The Modal -->
        <form method="POST" action="../member_system/member_update_check.php" enctype="multipart/form-data">
            <div id="memupModal" class="memupmodal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class='dialog-header'>
                       <span class="close">&times;</span>
                    </div>
                    <ul class="upinput">
                        <p><h3>修改會員資料</h3></p>
						<li>
                            <input type='text' name='_uid' id='_uid' value='<?php echo $uid; ?>' readonly="readonly">
                        </li>
                        <li>
                            <input type='text' name='_uname' id='_uname' value='<?php echo $uname; ?>' placeholder="姓名">
                        </li>
                        <li>
                            <input type='text' name='_ugroup' id='_ugroup' value='<?php echo $ugroup; ?>' placeholder="所屬公司或團體">
                        </li>
                        <li>
                            <select id="_uclass" name="_uclass">
                                <option value="host">舉辦市集</option>
                                <option value="rent">場地出租</option>
                                <option value='stall'>市集攤商</option>	
                            </select>
                        </li>
                        <li>
                            <input type="text" name="_uemail" id="_uemail" value='<?php echo $uemail; ?>' placeholder="電子信箱">
                        </li>
                        <li>
                            <input type="text" name="_utel" id="_utel" value='<?php echo $utel; ?>' placeholder="電話">
                        </li>
                        <li>
                            <h3><input type=submit id="memupbtn" value="確認修改"></input></h3>
                        </li>
					</ul>
                </div>
            </div>
        </form>
        <script>
           /* var uclass = document.getElementById("uclassdata");
           
			$('#_uclass option:[index='+uclass+']').attr('selected', true);*/
		</script>
    </body>
</html>