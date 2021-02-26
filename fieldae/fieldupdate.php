<!DOCTYPE HTML>
<?php
	session_start();
    if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):
    require_once "../funcd/dbh.php";
    //讀取預設資料
    $fid = $_GET["fid"];
    $uid=$_SESSION['userid'];
    $sql = "SELECT * FROM field WHERE F_Id='$fid'"; 
    $result = mysqli_query($conn,$sql) or die("Error");
    if($row = mysqli_fetch_array ($result)){
		$fname=$row['F_Name'];
		$fstartdate=$row['F_Startdate'];
		$fstarttime=$row['F_Starttime'];
		$fenddate=$row['F_Enddate'];
		$fendtime=$row['F_Endtime'];
        $faddr=$row['F_Addr'];
		$fsize=$row['F_Size'];
		$fsizeselect=$row['F_Sizeunit'];
		$fstallnum=$row['F_Stallnum'];
		$ftel=$row['U_Tel'];
		$fimage=$row['F_Image'];
		$finfo=$row['F_Info'];
	}
?>
<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../funcd/css/main.css">
        <link rel='stylesheet' href='../funcd/css/bootstrap.css' type="text/css">
		<link rel='stylesheet' href='../funcd/css/field/fieldae.css' type="text/css">
		<!--ckeditor-->
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
                    <div class="fieldae">
                        <center>
                        <form method="POST" action="../fieldae/fieldupdate_check.php" enctype="multipart/form-data">
                            <ul>
                                <h3>修改出租場地</h3>
                                <li>
									<div class='ae_border'>
										<h5>場地名字</h5>
										<input type="text" class="textsty" name="_fname" id="_fname" placeholder="場地名字" value="<?php echo $fname; ?>" required/>
									</div>
                                </li>
                                <li>
									<div class='ae_border'>
										<h5>場地開放租借時間</h5>
										<input type="date" name="_fstartdate" id="_fstartdate" value="<?php echo $fstartdate; ?>" required/>
										<input type="time" name="_fstarttime" id="_fstarttime" value="<?php echo $fstarttime; ?>" required />
										<h5>場地結束開放租借時間</h5>
										<input type="date" name="_fenddate" id="_fenddate" value="<?php echo $fenddate; ?>" required/>
										<input type="time" name="_fendtime" id="_fendtime" value="<?php echo $fendtime; ?>" required />
									</div>
                                </li>
                                <li>
									<div class='ae_border'>
										<h5>場地位置</h5>
										<input type="text" class="textsty" name="_faddr" id="_faddr" placeholder="場地所在地址" value="<?php echo $faddr; ?>" required/>
									</div>
                                </li>
                                <li>
									<div class='ae_border'>
										<h5>場地大小</h5>
										<input type="text" class="textsty" name="_fsize" id="_fsize" placeholder="場地大小" value="<?php echo $fsize; ?>" required/>
										<select class="textsty" id="_fsizeselect" name="_fsizeselect">
											<option value="平方公尺">平方公尺</option>	
											<option value="坪">坪</option>
											<option value="畝">畝</option>
											<option value="公頃">公頃</option>
											<option value="平方公里">平方公里</option>
										</select>
									</div>
                                </li>
                                <li>
									<div class='ae_border'>
										<h5>可容納攤商數量</h5>
										<input type="text" class="textsty" name="_fstallnum" id="_fstallnum" placeholder="攤商數量" value="<?php echo $fstallnum; ?>" required/>
									</div>
                                </li>
                                <li>
									<div class='ae_border'>
										<h5>聯絡電話</h5>
										<input type="tel" class="textsty" name="_ftel" id="_ftel" placeholder="聯絡電話" value="<?php echo $ftel; ?>" required/>
									</div>
                                </li>
                                <li>
									<div class='ae_border'>
										<h5>場地圖片或照片</h5>
										<input type="file" name="_fimage" id="_fimage" value="<?php echo $fimage; ?>">
										<div style='clear:both;'></div>
									</div>
								</li>
                                <li>
									<div class='ae_border'>
										<h5>市集額外資訊</h5>
										<textarea name="_finfo" id="_finfo"><?php echo $finfo; ?></textarea>
										<script>
											CKFinder.setupCKEditor();
											CKEDITOR.replace('_finfo');
										</script>
									</div>
                                </li>
                            </ul>
							<?php
								echo "<input type=hidden value='$fid' name='_fid' id='_fid'></input>";
							?>
                            <input type=submit class="fieldupsub" value="確認修改" />
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
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>