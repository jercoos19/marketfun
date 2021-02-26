<!DOCTYPE HTML>
<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
		require_once "../funcd/dbh.php";
		$uid=$_SESSION['userid'];
		$sql = "SELECT * FROM user WHERE U_Id='$uid'"; 
		$result = mysqli_query($conn,$sql) or die("Error");
		if($row = mysqli_fetch_array ($result)){
			$utel=$row['U_Tel'];
		}
?>
<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../funcd/css/main.css">
		<link rel='stylesheet' href='../funcd/css/bootstrap.css' type="text/css">
		<link rel='stylesheet' href='../funcd/css/event/eventae.css' type="text/css">
		<link rel='stylesheet' href='../funcd/css/dialogset.css' type="text/css">
		<!---ckeditor --->
		<script src="../funcd/ckeditor/ckeditor.js"></script>
		<script src="../funcd/ckfinder/ckfinder.js"></script>
		
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a href="../homepage/homepage.php" class="logo"><img class="logo" src='../funcd/logo/MarketFunLOGO.png'></a>
				<nav class="right">
					<?php
						if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
							echo "<a href='../member_system/member_center.php' class='alt loginid'>".$uid."</a>";
					?>
							<a href="../member_system/logout.php" class="button alt">登出</a>
					<?php
						else:
					?>
							<a href="../member_system/login.php" class="button alt">登入</a>
							<a href="../member_system/register.php" class="button alt">註冊</a>
					<?php
						endif;
					?>
				</nav>
			</header>

		<!-- Menu -->
			<nav id="menu">
            <img class='menulogo' src="../funcd/logo/MarketFunICON.png">
				<ul class="links">
					<li><a href="../homepage/homepage.php">首頁</a></li>
					<li><a href="../event/event_index.php">尋找市集</a></li>
					<li><a href="../field/field_index.php">尋找場地</a></li>
					<li><a href="../member_system/member_center.php">會員管理</a></li>
					<li><a href="elements.html">donate</a></li>
				</ul>
				<ul class="actions vertical">
					<li><a href="#" class="button fit">Login</a></li>
				</ul>
			</nav>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<!--dialog set
					<div id="evaddModal" class="evaddmodal">
						<div class="checkmodal-content">
							<div class="dialog-header">
								<span class="checkclose">&times;</span>
							</div>
							<div class='dialog-content'>
								<h5 class='checkword'>確定並送出?</h5>
								<div class='checkbtn'>
									<button class='defineaddbtn button'>確定</button>
									<button class='canceladdbtn button'>取消</button>
								</div>
							</div>
						</div>
					</div>-->
					<div class="eventae">
						<center>
						<form method="POST" action="../eventae/eventadd_check.php" enctype="multipart/form-data">
							<ul>
								<h3>新增市集</h3>
								<li>
									<div class='ae_border'>
										<h5>市集名字</h5>
										<input type="text" class="textsty" name="_ename" id="_ename" placeholder="市集名字" required/>
									</div>
								</li>
								<li>
									<div class='ae_border'>
										<h5>市集類別</h5>
										<select class="textsty" id="_eventclass" name="_eventclass">
											<option value="0">二手</option>	
											<option value="1">文創</option>
											<option value="2">農作物</option>
										</select>
									</div>
								</li>
								<li>
									<div class='ae_border'>
										<h5>市集開始日期</h5>
										<input type="date" name="_estartdate" id="_estartdate" required/>
										<input type="time" name="_estarttime" id="_estarttime" required />
										<h5>市集結束日期</h5>
										<input type="date" name="_eenddate" id="_eenddate" required/>
										<input type="time" name="_eendtime" id="_eendtime" required />
									</div>
								</li>
								<li>
									<div class='ae_border'>
										<h5>市集地點</h5>
										<input type="text" class="textsty" name="_eaddr" id="_eaddr" placeholder="舉辦地點" required/>
									</div>
								</li>
								<li>
									<div class='ae_border'>
										<h5>聯絡電話</h5>
										<input type="tel" class="textsty" name="_etel" id="_etel" placeholder="連絡電話" value="<?php echo $utel; ?>" required/>
									</div>
								</li>
								<li>
									<div class='ae_border'>
										<h5>市集圖片</h5>
										<input type="file" name="_eimage" id="_eimage" required/>
										<div style='clear:both;'></div>
									</div>
								</li>
								<li>
									<div class='ae_border'>
										<h5>市集資訊</h5>
										<textarea name="_einfo" id="_einfo"></textarea>
										<script>
											CKFinder.setupCKEditor();
											CKEDITOR.replace('_einfo');
										</script>
									</div>
								</li>
								<li class="liset">
									<input type="checkbox" name="stallallow" id="stallallow"/><h5>允許其他攤販加入市集?</h5>
								</li>
								<div class='stalldata'>
									<li>
										<div class='ae_border'>
											<h5>目前空攤販數</h5>
											<input type="text" class="textsty" name="_rmstall" id="_rmstall" placeholder="剩餘空攤位數"/>
										</div>
									</li>
									<li>
										<div class='ae_border'>
											<h5>攤販加入截止期限</h5>
											<input type="datetime-local" name="_sdate" id="_sdate" placeholder="攤販加入截止期限"/>
										</div>
									</li>
									<li>
										<div class='ae_border'>
											<h5>場地攤商缺額位置圖</h5>
											<input type="file" name="_esimage" id="_esimage"/>
											<div style='clear:both;'></div>
										</div>
									</li>
								</div>
							</ul>
							<input type=submit class="eventsub" value="確認新增" />
						</form>
						</center>
					</div>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<h2>聯絡我們</h2>
					<ul class="actions">
						<li><span class="icon fa-map-marker"></span>974 花蓮縣壽豐鄉大學路二段1號</li>
					</ul>
				</div>
			</footer>
		<!-- Scripts -->
			<script src="../funcd/js/jquery-1.11.3.min.js"></script>
			<script src="../funcd/js/jquery.scrolly.min.js"></script>
			<script src="../funcd/js/skel.min.js"></script>
			<script src="../funcd/js/util.js"></script>
			<script src="../funcd/js/main.js"></script>
			<script src="../funcd/js/bootstrap.js"></script>
			<script src="../funcd/js/dialogset.js"></script>
			<script>
				$(function() {
					$("#stallallow").click(function(){
						if($("#stallallow").prop("checked")){
							$('.stalldata').css('display','block');
						}
						else{
							$('.stalldata').css('display','none');
						}
					});
				});
			</script>
			<script>
				/*$(document).ready(function () { 
					$(".eventaddsub").click(function(){
						$('.evaddmodal').css('display','block');
						return false;
					});
					$(".defineaddbtn").click(function(){
						return true;
					});
				});*/
			</script>
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>