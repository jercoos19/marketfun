<html>
	<head>
		<style type="text/css">
			.liset{
				list-style-type: none;
			}
		</style>
		<script>
		</script>
	</head>
	<body>
		<form action="registercheck.php" method="POST">
			<div id="account">
				<ul>
					<li class="liset">
						<h3>帳號</h3>
						<input type="text" name="_uaccount" id="_uaccount" placeholder="帳號">
					</li>
					<li class="liset">
						<h3>密碼</h3>
						<input type="password" name="_upassword" id="_upassowrd" placeholder="密碼"><br>
						<input type="password" name="_upasswordcheck" id="_upasswordcheck" placeholder="確認密碼">
					</li>
					<li class="liset">
						<h3>電子信箱</h3>
						<input type="email" name="_uemail" id="_uemail" placeholder="電子郵件信箱">
					</li>
					<li class="liset">
						<h3>使用者類型</h3>
						<select name="_uclass" id="_uclass">
							<option value="0">市集攤商</option>	
							<option value="1">舉辦市集</option>
							<option value="2">出租場地</option>
						</select>
					</li>
					<li class="liset">
						<h3>姓名</h3>
						<input type="text" name="_uname" id="_uname" placeholder="姓名">
					</li>
					<li class="liset">
						<h3>電話</h3>
						<input type="tel" name="_utel" id="_utel" placeholder="電話">
					</li>
				</ul>
				<input type = "submit" class="register_submit" value="確認註冊"></input>
			</div>
		</form>
	</body>
</html>