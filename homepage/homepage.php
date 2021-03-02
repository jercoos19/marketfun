<!DOCTYPE HTML>
<?php
	session_start();
	require_once '../funcd/dbh.php';
?>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../funcd/css/main.css" type="text/css">
		<link rel="stylesheet" href="../funcd/css/homepage/homepage.css" type="text/css">
		<link rel='stylesheet' href='../funcd/css/bootstrap.css' type="text/css">
		<link rel="stylesheet" href="../funcd/css/homepage/flexslider.css" type="text/css">
		<link rel="stylesheet" href="../funcd/css/homepage/eventshow.css" type="text/css">
		<link rel="stylesheet" href="../funcd/css/dialogset.css" type="text/css">
	</head>
	<body>
		<!-- Header -->
		<header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
			</nav>
			<a href="homepage.php" class="logo"><img class="logo" src='../funcd/logo/MarketFunLOGO.png'></a>
			<!--登入系統-->
			<nav class="right">
			<?php
				if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
					$uid=$_SESSION['userid'];
					echo "<a href='../member_system/member_center.php' class='alt loginid'>".$uid."</a>";
			?>
					<a href="../member_system/logout.php" class="button alt">登出</a>
			<?php
				else:
			?>
					<button id="logBtn" class="button alt">登入</button>
					<button id="resBtn" class="button alt">註冊</button>
					<?php
						require_once "../member_system/login_dialog.php";
						require_once "../member_system/register_dialog.php";
					?>
			<?php
				endif;
			?>
			</nav>
		</header>

		<!-- Menu -->
		<nav id="menu">
			<img class='menulogo' src="../funcd/logo/MarketFunICON.png">
			<ul class="links">
				<li><a href="homepage.php">首頁</a></li>
				<li><a href="../event/event_index.php">尋找市集</a></li>
				<li><a href="../field/field_index.php">尋找場地</a></li>
			<?php
			//登入後才看得到
				if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE){
			?>
					<li><a href="../member_system/member_center.php">會員管理</a></li>
			<?php
				}
			?>
				<li><a href='elements.html'>Donate</a></li>
			</ul>
			<ul class="actions vertical">
				<li><a href="#" class="button fit">Login</a></li>
			</ul>
		</nav>
	<div id="makecenter">
		<!-- 輪播式廣告 -->
		<section id="banner">
			<div class="content">
				<center>
					<div class="flexslider">
						<ul class="slides">
							<?php
								$sql = "SELECT * FROM field ORDER BY F_Addtime DESC LIMIT 5 "; 
								$result = mysqli_query($conn, $sql);
								if(mysqli_num_rows($result)>0){
									while ($row = mysqli_fetch_array ($result)){
										$fimage=$row['F_Image'];
										$fid=$row['F_Id'];
										echo "<li><a href='../field/field_sub.php?fid=$fid'><img class='imad' src=".$fimage."></a></li>";
									}
								}
							?>
						</ul>
					</div>
				</center>
			</div>
		</section>

		<!-- 市集索引 -->
		<center>
			<section id="one" class="wrapper">
				<header>
					<h2 class="event_title">最新市集</h2>
				</header>
				<div class="homepageevent">
				<?php
					require_once 'event_home.php';
				?>
				</div>
			</section>
		<!-- 二手市集 -->
			<section id="two" class="wrapper">
				<header>
						<h2 class="event_title">二手市集</h2>
					</header>
				<div class="homepageevent">
					<?php
						require_once 'event_secondhand.php';
					?>
				</div>
			</section>
		<!-- 文創市集 -->
			<section id="two" class="wrapper">
				<header>
						<h2 class="event_title">文創市集</h2>
					</header>
				<div class="homepageevent">
					<?php
						require_once 'event_ccindustry.php';
					?>
				</div>
			</section>
		<!-- 農作物市集 -->
			<section id="two" class="wrapper">
				<header>
						<h2 class="event_title">農作物市集</h2>
					</header>
				<div class="homepageevent">
					<?php
						require_once 'event_farmcrop.php';
					?>
				</div>
				<a href="../event/event_index.php" class="button findmore">探索更多</a>  
			</section>

		<!-- 場地索引 -->
			<section id="three" class="wrapper">
				<header>
					<h2 class="event_title">尋找場地</h2>
				</header>
				<div class="homepagefield">
				<?php
					require_once 'field_home.php';
				?>
				</div>
				<a href="../field/field_index.php" class="button findmore">探索更多</a>  
			</section>
		</center>
	</div>
	<!--返回最上面-->
	<div id="gotop">TOP</div>
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
		<script src="../funcd/js/homepage/jquery.flexslider.js"></script>
		<script src="../funcd/js/bootstrap.js"></script>
		<script src="../funcd/js/jquery.scrolly.min.js"></script>
		<script src="../funcd/js/skel.min.js"></script>
		<script src="../funcd/js/util.js"></script>
		<script src="../funcd/js/main.js"></script>
		<script src="../funcd/js/dialogset.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(window).load(function() {
				$('.flexslider').flexslider({
					animation: "slide",
					slideshowSpeed: 4000,
					animationLoop: true,
					direction: "horizontal",
					keyboard: true,
					touch: true,
					slideshow: true,	
					after: function (slider) {            
						if (!slider.playing) {
							slider.play();
						}
					}
				});
			});
		</script>
		<script type="text/javascript" charset="utf-8">
		//返回最上面
			$("#gotop").click(function(){
				jQuery("html,body").animate({
					scrollTop:0
				},1000);
			});
			$(window).load(function() {
				$('#gotop').hide();
			});
			$(window).scroll(function() {
				if ( $(this).scrollTop() >= 300){
					$('#gotop').fadeIn("fast");
				} 
				else {
					$('#gotop').stop().fadeOut("fast");
				}
			});
		</script>

	</body>
</html>