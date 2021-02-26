<!DOCTYPE HTML>
<?php
	session_start();
?>


<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../funcd/css/main.css" type="text/css">
		<link rel="stylesheet" href="../funcd/css/field/field_sub.css" type="text/css">
		
		<link rel="stylesheet" href="../funcd/css/homepage/homepage.css" type="text/css">
		<link rel='stylesheet' href='../funcd/css/bootstrap.css' type="text/css">
		<link rel="stylesheet" href="../funcd/css/homepage/flexslider.css" type="text/css">
		<link rel="stylesheet" href="../funcd/css/homepage/eventshow.css" type="text/css">
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
					<li><a href="../homeapge/homepage.php">首頁</a></li>
					<li><a href="../event/event_index.php">尋找市集</a></li>
					<li><a href="../field/field_index.php">尋找場地</a></li>
					<li><a href="../member_system/member_center.php">會員管理</a></li>
				</ul>
				<ul class="actions vertical">
					<li><a href="#" class="button fit">Login</a></li>
				</ul>
			</nav>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<?php
						require_once '../funcd/dbh.php';
						$fid = $_GET["fid"];
						$nowtime = date("Y-m-d H:i:s");
						//php.ini修改date.timezone ==>Asia/Taipei
						//echo date("Y-m-d H:i:s");
						$sql = "SELECT * FROM field WHERE F_Id='$fid'";						
						$result = mysqli_query($conn,$sql) or die("Error");

						if($row = mysqli_fetch_array ($result)){
							$fname=$row['F_Name'];
							//$fdate=$row['F_Date'];
							$fimage=$row['F_Image'];
							$fadr=$row['F_Addr'];
							$fpri=$row['F_Price'];
							$finfo=$row['F_Info'];
							$ftel=$row['U_Tel'];
							$fstartdate=$row['F_Startdate'];
							$fenddate=$row['F_Enddate'];
							$famount=$row['F_Amount'];
							$fsize=$row['F_Size'];
							$fsizeunit=$row['F_Sizeunit'];
							$fstallnum=$row['F_Stallnum'];
							//$slimitdate=$row['F_Uptime'];
						}
					?>
					<hr class='hrs'>
					<div class='fnamefont'><?php echo $fname; ?></div>
					<img src='<?php echo $fimage; ?>' id='imageset'> </img>
					<hr/>
					<h4>場地資訊</h4>
					<div id="fielddata">
						<table>
							<tr><td>場地地點</td><td><?php echo $fadr; ?></td></tr>							
							<tr><td>聯絡方式</td><td><?php echo $ftel; ?></td></tr>
							<tr><td>出租日期</td><td><?php echo $fstartdate; ?></td></tr>
							<tr><td>結束出租日期</td><td><?php echo $fenddate; ?></td></tr>
							<tr><td>場地大小</td><td><?php echo $fsize.$fsizeunit; ?></td></tr>
							<tr><td>可容納攤商數量</td><td><?php echo $fstallnum; ?></td></tr>
						</table>
					</div>
					<div id="fieldinfo">
						<?php echo $finfo; ?>
					</div>
				</div>					
			</section>		
				<div id='googlemap'>
				<!--導入google map-->
					<?php
						$conn = @mysqli_connect("127.0.0.1","root","","mrdb") or die("NO");
							mysqli_query($conn, 'SET NAMES utf8');
							$fid = $_GET["fid"];
							$sql = "SELECT * FROM field WHERE F_Id='$fid'"; 
							$result = mysqli_query($conn,$sql) or die("Error");
						if($row = mysqli_fetch_array ($result))
							{
								$fadr=$row['F_Addr'];
							}
						echo "
						
						<iframe 						 
						width=50%
						height=350
																												
						src=https://www.google.com/maps/embed/v1/place?key=AIzaSyAV-gn_061fGyZDIyGFSTsjjoj7KLtoYb4&q=$fadr
						allowfullscreen>
						</iframe>"
					?>
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
		
		</script>
	</body>
	
</html>
