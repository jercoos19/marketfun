<html>
    <head>
    </head>
    <body>
        <form action="../member_system/registercheck.php" method="POST">
            <div id="resModal" class="resmodal">
                <div class="modal-content">
                    <div class='dialog-header'>
                       <span class="close">&times;</span>
                    </div>
                    <ul>
                        <p><h1>會員註冊</h1></p>
                        <li>
                            <input type="text" name="_uaccount" id="_uaccount" placeholder="帳號">
                        </li>
                        <li>
                            <input type="password" name="_upassword" id="_upassowrd" placeholder="密碼">
                        </li>
                        <li>
                            <input type="password" name="_upasswordcheck" id="_upasswordcheck" placeholder="確認密碼">
                        </li>
                        <li>
                            <input type="email" name="_uemail" id="_uemail" placeholder="電子郵件信箱">
                        </li>
                        <li>
                            <select name="_uclass" id="_uclass">
                                <option value="0">市集攤商</option>	
                                <option value="1">舉辦市集</option>
                                <option value="2">出租場地</option>
                            </select>
                        </li>
                        <li>
                            <input type="text" name="_uname" id="_uname" placeholder="姓名">
                        </li>
                        <li>
                            <input type="text" name="_ugroup" id="_ugroup" placeholder="所屬公司或團體">
                        </li>
                        <li>
                            <input type="tel" name="_utel" id="_utel" placeholder="電話">
                        </li>
                        <li>
                            <input type = "submit" id="ressubbtn" value="確認註冊"></input>
                        </li>
                    </ul>
                </div>
            </div>
        </form> 
    </body>
</html>