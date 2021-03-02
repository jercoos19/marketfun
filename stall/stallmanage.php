<!DOCTYPE HTML>
<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
	require_once '../funcd/dbh.php';
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
					<div class="tab-pane fade show" id="stall" role="tabpanel" aria-labelledby="stall-tab">
						<div class="statuschoose" data-toggle="buttons">
							<label class="btn btn-primary statusbtn  active">
								<input type="radio" name="statusoption" autocomplete="off" value="wait">等待回應中
							</label>
							<label class='btn btn-primary'>
								<input type='radio' name='statusoption' autocomplete='off' value='approve'/>已同意攤商
							</label>
						</div>
					</div>
					<div class="srequest">
						<?php
							$eid=$_GET["eid"];
							//0等待 1同意 2拒絕
							$sql="Select * from stall where E_Id='$eid' AND S_Status='0'";
							$rst = @mysqli_query($conn,$sql);
							if($rst==true){
								if(mysqli_num_rows($rst)>0){
									while ($row = mysqli_fetch_array ($rst)){	
										$sname=$row['S_Name'];
										$scontent=$row['S_Content'];
										$sposition=$row['S_Position'];
										$uid=$row['U_Id'];
										$sid=$row['S_Id'];
										$utel=$row['U_Tel'];
										$saddtime=$row['S_Addtime'];
										$ename=$row['E_Name'];
						?>
										<div class='stallwaitapl'>
											<h3><?php echo "$ename"; ?></h3>
											<hr>
											<div class="stitle">
												<h4>攤商名稱</h4>
												<h4>申請者姓名</h4>
												<h4>聯絡方式</h4>
												<h4>申請擺攤位置</h4>
											</div>
											<div class="sinfo">
												<h5><?php echo "$sname"; ?></h5>
												<h5><?php echo "$uid"; ?></h5>
												<h5><?php echo "$utel"; ?></h5>
												<h5><?php echo "$sposition"; ?></h5>
											</div>
											<div class=stallcon>
												<button class='btapprove stallaplbtn button' name='btapprove' value='<?php echo "$sid"; ?>'>同意</button><br>
												<button class='btreject stallaplbtn button' name='btreject' value='<?php echo "$sid"; ?>'>拒絕</button>
											</div>
											<div class="scontent">
												<h4>商品內容</h4>
												<h5><?php echo "$scontent"; ?></h5>
											</div>
										</div>
						<?php	
										echo "<input type='hidden' value='$sid' class='sidnum'>";
										echo "<input type='hidden' value='$eid' class='eidnum'>";
									}
								}
								else{
									echo "<div class='stallnoresult'><h3>目前沒有等待回應的攤商</h3></div>";
								}
							}
							else{
								echo mysqli_error($conn);
							}
							
						?>
					</div>
					<div id="black">
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
				$(document).ready(function(){
					$(".btapprove").click(function(){
						var sidnum = $(this).attr("value");
						var eidnum = $(".eidnum").val();
						$.ajax({
							url:"stall_approve.php?sid="+sidnum,
							data: "&eidnum="+eidnum,
							type:"GET",
							dataType:'text',
							async:true,
							success: function(message){
								$(".srequest").html(message);
								$(document).ajaxStop(function(){
									window.location.reload();
								});
							}
						});
					});
					$(".btreject").click(function(){
						var sidnum = $(this).attr("value");
						var eidnum = $(".eidnum").val();
						$.ajax({
							url:"stall_reject.php?sid="+sidnum,
							data: "&eidnum="+eidnum,
							type:"GET",
							dataType:'text',
							async:true,
							success: function(message){
								$(".srequest").html(message);
								$(document).ajaxStop(function(){
									window.location.reload();
								});
							}
						});
					});
				})
			</script>
			<script>
				$(".btn").change(function(){
					var stallstatus = $('input[name=statusoption]:checked').val();
					var eid=<?php echo $eid; ?>;
					$.ajax({
						url:"stallmanage_choose.php",
						data: "&stallstatus="+stallstatus+"&eid="+eid,
						type:"GET",
						dataType:'text',
						async:true,
						success: function(data){
							$(".srequest").html(data);
						}
					});
				});
			</script>
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>