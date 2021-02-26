<!DOCTYPE HTML>
<?php
	session_start();
	require_once '../funcd/dbh.php';
?>
<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../funcd/css/main.css">
		<link rel="stylesheet" href="../funcd/css/event/event_sub.css" type="text/css">
		<link rel='stylesheet' href='../funcd/css/bootstrap.css' type="text/css">
		<link rel="stylesheet" href="../funcd/css/dialogset.css" type="text/css">
		
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
					<li><a href="../homeapge/homepage.php">首頁</a></li>
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

		<!-- Main -->
			<section id="main" class="wrapper">
				<?php
					$eid = $_GET["eid"];
					$nowtime = date("Y-m-d H:i:s");
					//php.ini修改date.timezone ==>Asia/Taipei
					//echo date("Y-m-d H:i:s");
					$sql = "SELECT * FROM event WHERE E_Id='$eid'";						
					$result = mysqli_query($conn,$sql) or die("Error");

					if($row = mysqli_fetch_array ($result))
					{
						$ename=$row['E_Name'];
						$estartdate=$row['E_Startdate'];
						$estarttime=$row['E_Starttime'];
						$eenddate=$row['E_Enddate'];
						$eendtime=$row['E_Endtime'];
						$eimage=$row['E_Image'];
						$eadr=$row['E_Addr'];
						$einfo=$row['E_Info'];
						$etel=$row['E_tel'];
						$slimitdate=$row['E_Slimitdate'];
						$ermstall=$row['E_Rmstall'];
						$esimage=$row['E_Simage'];
						$estallcheck=$row['E_Stallcheck'];
					}
				?>
				<div class="inner">
					<div id='evcontent'>
						<h2 class='enamefont'><?php echo $ename; ?></h2>
						<hr class='hrtitle'/>
						<div id="evinfo"><?php echo $einfo; ?></div>
						<div id='googlemap'>
						<!--導入google map-->
							<?php
								echo "
								<iframe 
								width=800px
								height=400px	
								frameborder=0 
								style=border:0
								src=https://www.google.com/maps/embed/v1/place?key=AIzaSyAV-gn_061fGyZDIyGFSTsjjoj7KLtoYb4&q=$eadr
								allowfullscreen>
								</iframe>";
							?>
						</div>

						<div id="stallapldata">
							<?php
								if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE){
									if($estallcheck==1){
										$uid=$_SESSION['userid'];
										$sql = "SELECT * FROM user WHERE U_Id='$uid'";						
										$result = mysqli_query($conn,$sql) or die("Error");
										if($row = mysqli_fetch_array ($result)){
											$uclass=$row['U_Class'];
										}
										if($uclass=='stall'){
							?>			
											<h3>攤商募集資訊</h3>
											<hr/>
											<div id="stalldate">
												<h5>攤商募集截止期限</h5><?php echo $slimitdate; ?>
											</div>
											<div id="stalllack">
												<h5>目前攤商缺額</h5> <?php echo $ermstall; ?>
											</div>
											<?php
												if($esimage=="../funcd/(es_image)/"){
													echo "<h5>這個市集不提供攤商缺額平面圖</h5>";
												}
												else{
													echo "<h5>市集攤商缺額位置圖</h5><h5><img class='esimage' src='$esimage'></img></h5>";
												}
											?>

							<?php
											if($nowtime<$slimitdate){
												echo "<a href='../stall/stallapl.php?eid=$eid&ename=$ename' class='button' id='stallbtn'>擺攤申請</a>";
											}
											else{
												echo "<a class='button' id='stallbtn'>申請時間已過</a>";
											}
										}
									}
									else{
										echo "<h5>這個市集不提供攤販加入市集</h5>";
									}
								}
							?>
						</div>
					</div>
				</div>
				<!--右邊弄一塊-->
				<div id="evdata">
					<img src=' <?php echo $eimage; ?>' id='imageset'> </img>
					<table>
						<tr>
							<td>開始日期</td>
							<td><?php echo $estartdate.' '.$estarttime; ?></td>
						</tr>
						<tr>
							<td>結束日期</td>
							<td><?php echo $eenddate.' '.$eendtime; ?></td>
						</tr>
						<tr>
							<td>市集地點</td>
							<td><?php echo $eadr; ?></td>
						</tr>
						<tr>
							<td>聯絡電話</td>
							<td><?php echo $etel; ?></td>
						</tr>
					</table>
				</div>
				<div style='clear:both;'></div>
				<!----右邊弄一塊結束----->
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
			<script type="text/javascript">
				/*jQuery(function($) {
					var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
					function fixDiv() {
						var $cache = $('#evdata');
						if ($(window).scrollTop() >= 0)
							$cache.css({
							'position': 'fixed',
							'top': '80px',
							'right': '20px'
						});
					}
					$(window).scroll(fixDiv);
					fixDiv();
				});*/
			</script>
	</body>
</html>
