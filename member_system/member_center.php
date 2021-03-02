<!DOCTYPE HTML>
<?php
	session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):
	require_once "../funcd/dbh.php";
	//呼叫user資料
	$uid=$_SESSION['userid'];
	$sql = "SELECT * FROM user WHERE U_Id='".$uid."'"; 
	$result = mysqli_query($conn,$sql) or die("Error");
	if($row = mysqli_fetch_array ($result)){
		$uname=$row['U_Name'];
		$uemail=$row['U_Email'];
		$utel=$row['U_Tel'];
		$uclass=$row['U_Class'];
		$ugroup=$row['U_Group'];
	}
?>
<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../funcd/css/main.css">
		<link rel="stylesheet" href="../funcd/css/member_center.css" type="text/css">
		<link rel="stylesheet" href="../funcd/css/event/event_index.css" type="text/css">
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
                    <div class="membermenu" id="membermenu-1">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <div class="tabslider"></div>
                            <li class="nav-item">
                                <a class='nav-link active' id='member-tab' data-toggle='tab' href='#member' role='tab' aria-controls='member' aria-selected='true'><i class='fas fa-member'></i>會員管理</a>
                            </li>
                            <li class="nav-item">
								<!--取得uclass-->
								<input type="hidden" value=<?php echo $uclass; ?> id="uclassdata"/>
                                <?php
                                    switch($uclass){
                                        case 'host':
                                            echo "<a class='nav-link' id='host-tab' data-toggle='tab' href='#host' role='tab' aria-controls='host' aria-selected='true'><i class='fas fa-host'></i>市集管理</a>";
                                            break;
                                        case 'rent':
                                            echo "<a class='nav-link' id='rent-tab' data-toggle='tab' href='#rent' role='tab' aria-controls='rent' aria-selected='true'><i class='fas fa-rent'></i>場地管理</a>";
                                            break;
                                        case 'stall':
                                            echo "<a class='nav-link' id='stall-tab' data-toggle='tab' href='#stall' role='tab' aria-controls='stall' aria-selected='true'><i class='fas fa-stall'></i>攤販管理</a>";
                                            break;
                                    }
                                ?>
                            </li>
                        </ul>
					</div>
					<center>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
							<div id='userdata'>
								<h3>會員資料</h3>
									<table table>
										<tr>
											<td> <h5>使用者帳號</h5> </td>
											<td> <h5><?php echo $uid; ?></h5> </td>
										</tr>
										<tr>
											<td> <h5>姓名</h5> </td>
											<td><h5><?php echo $uname; ?></h5></td>
										</tr>
										<tr>
											<td> <h5>所屬公司或團體</h5> </td>
											<td><h5><?php echo $ugroup; ?></h5></td>
										</tr>
										<tr>
											<td> <h5>電子信箱</h5> </td>
											<td><h5><?php echo $uemail; ?></h5></td>
										</tr>
										<tr>
											<td> <h5>聯絡電話</h5> </td>
											<td><h5><?php echo $utel; ?></h5></td>
										</tr>
										<tr>
											<td> <h5>使用者類別</h5> </td>
											<td>
												<h5>
													<?php switch($uclass){	
													case 'host': echo "舉辦市集"; break;
													case 'rent': echo "場地出租"; break;
													case 'stall': echo "市集攤商"; break;
													}?>
												</h5>
											</td>
										</tr>
									</table>
									</ul>
								<button id='upBtn' class='button membtn'>基本資料修改</button>
								<button id='pswBtn' class='button membtn'>密碼修改</button>
								<?php
									require_once "member_update_dialog.php";
									require_once "passwordupdate.php";
								?>
							</div>
						</div>
						<div class="tab-pane fade show" id="host" role="tabpanel" aria-labelledby="host-tab">
							<a href="../eventae/eventadd.php" class="button addbutton">新增市集</a>
							<?php
								require_once "../eventae/eventmanage.php";
							?>
						</div>
						<div class="tab-pane fade show" id="rent" role="tabpanel" aria-labelledby="rent-tab">
							<a href="../fieldae/fieldadd.php" class="button addbutton">新增場地</a>
							<?php
								require_once "../fieldae/fieldmanage.php";
							?>
						</div>
						<div class="tab-pane fade show" id="stall" role="tabpanel" aria-labelledby="stall-tab">
							<div class="statuschoose" data-toggle="buttons">
								<label class="btn btn-primary statusbtn  active">
									<input type="radio" name="statusoption" autocomplete="off" value="all">全部
								</label>
								<label class='btn btn-primary'>
									<input type='radio' name='statusoption' autocomplete='off' value='wait'/>等待回應中
								</label>
								<label class='btn btn-primary'>
									<input type='radio' name='statusoption' autocomplete='off' value='approve'/>已同意
								</label>
								<label class='btn btn-primary'>
									<input type='radio' name='statusoption' autocomplete='off' value='reject'/>已拒絕
								</label>
							</div>
							<?php
								require_once "../stall/stallstatus.php";
							?>
						</div>
					</div>
					</center>
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
                $("#membermenu-1 .nav-tabs a").click(function () {
                    var position = $(this).parent().position();
                    var width = $(this).parent().width();
					$("#membermenu-1 .tabslider").css({ "left": +position.left+8, "width": width });
                });
                var actWidth = $("#membermenu-1 .nav-tabs").find(".active").parent("li").width();
                var actPosition = $("#membermenu-1 .nav-tabs .active").position();
                $("#membermenu-1 .tabslider").css({ "left": +actPosition.left, "width": actWidth });
                //# sourceURL=pen.js
			</script>
			<script>
				$(".btn").change(function(){
					var stallstatus = $('input[name=statusoption]:checked').val();
					$.ajax({
						url:"stallstatus_choose.php",
						data:"&stallstatus="+stallstatus,
						type:"GET",
						dataType:'text',
						success: function(data){
							$('#thecontent').html(data);
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