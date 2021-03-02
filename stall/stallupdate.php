<!DOCTYPE HTML>
<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
	require_once '../funcd/dbh.php';
    $uid=$_SESSION['userid'];
    $sid=$_GET["sid"];
	$sql = "SELECT * FROM stall WHERE S_Id='".$sid."'"; 
	$result = mysqli_query($conn,$sql) or die("Error");
	if($row = mysqli_fetch_array ($result)){
        $utel=$row['U_Tel'];
        $sposition=$row['S_Position'];
        $sname=$row['S_Name'];
        $scontent=$row['S_Content'];
	}
?>
<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../funcd/css/main.css">
		<link rel='stylesheet' href='../funcd/css/bootstrap.css' type="text/css">
		<link rel='stylesheet' href='../funcd/css/stall.css' type="text/css">
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
							$uid=$_SESSION['userid'];
							echo "<a href='../member_system/member_center.php' class='alt'>".$uid."</a>";
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
					<div class="stallapl">
						<form method="POST" action="../stall/stallupdate_check.php" enctype="multipart/form-data">
							<ul>
								<h3>申請擺攤</h3>
								<li class="liset">
									<div class='ae_border'>
										<h5>攤商名字</h5>
										<input type="text" name="_sname" id="_sname" placeholder="攤商名字" value="<?php echo $sname ?>" required/>
									</div>
								</li>
								<li class="liset">
									<div class='ae_border'>
										<h5>攤位商品內容</h5>
										<input type="text" name="_scontent" id="_scontent" placeholder="擺攤內容" value="<?php echo $scontent ?>" required/>
									</div>
								</li>
								<li class="liset">
									<div class='ae_border'>
										<h5>申請的攤位位置</h5>
										<input type="text" name="_sposition" id="_sposition" placeholder="擺攤位置" value="<?php echo $sposition ?>" required/>
									</div>
								</li>
								<li class="liset">
									<div class='ae_border'>
										<h5>您的聯絡電話</h5>
										<input type="tel" name="_stel" id="_stel" placeholder="您的聯絡電話" value="<?php echo $utel; ?>" required/>
									</div>
								</li>
							</ul>
							<?php
								echo "<input type=hidden value='$sid' name='_sid' id='_sid'>";
							?>
							<input type=submit value="確認提交"></input>
						</form>
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
			<script>
				/*$(function() {
					var goodsnum = 1;
					$('#addnewitem').click(function(){
						$("#_scontent").append('<div>商品名稱<input type="text" id="goodsnum' +goodsnum+ '" name="goodsnum" /></div>');
						goodsnum++;
						console.log(goodsnum);
					})
				})*/
			</script>
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>