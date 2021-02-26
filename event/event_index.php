<!DOCTYPE HTML>
<?php
	require_once '../funcd/dbh.php';
	session_start();
?>
<html>
	<head>
		<title>市集趣</title>
		<meta charset="utf-8" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../funcd/css/main.css">
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
					<li><a href="../homepage/homepage.php">首頁</a></li>
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
				<div class="inner">
					<div class="event_index">
						<div class="e_toolbar">
							<!--資料排序方式-->
							<select id="datasort" name="datasort" onchange="check()";>	
								<option value="0">最新刊登</option>	
								<option value="1">開始日期最近</option>
								<option value="2">熱門市集</option>
							</select>
							<!--資料搜尋-->
							<input type="text" name="txt_blocksearch" id="txt_blocksearch" placeholder="快速搜尋" class="form-control">
							<!--地區分類-->
							<select class='regionhun'>
								<?php 
									$areadetail=array("請選擇","花蓮市","鳳林鎮","玉里鎮","新城鄉","吉安鄉","壽豐鄉","光復鄉","豐濱鄉","瑞穗鄉","富里鄉","秀林鄉","萬榮鄉","卓溪鄉");
									$areadetailnum=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13);
									for($i=0;$i<14;$i++){
										echo "<option value='$areadetailnum[$i]'> $areadetail[$i] </option>";
									}
								?>	
							</select>
							<!--全部縣市-->
							<?php
								$areaname1=array("台北","新北","基隆","桃園","宜蘭","新竹","苗栗","台中");
								$areaname2=array("彰化","南投","雲林","嘉義","台南","高雄","屏東","花蓮","台東");
								$areaeng1=array("tpe","ntpc","kel","tyn","ila","hsz","zmi","txg");
								$areaeng2=array("chw","ntc","yun","cyi","tnn","khh","pif","hun","ttt");
							?>
							<div id="areac">
								<div class="areachoose" data-toggle="buttons">
									<div class="arearow1">
										<label class="btn btn-primary areabtn  active">
											<input type="radio" name="areaoption" id="areaall" autocomplete="off" value="all">全部
										</label>
										<?php 
											for($i=0;$i<8;$i++){
										?>
												<label class='btn btn-primary'>
													<input type='radio' name='areaoption' autocomplete='off' value='<?php echo $areaeng1[$i]; ?>'/><?php echo $areaname1[$i]; ?>
												</label>
										<?php	
											}
										?>
									</div>
									<div class="arearow2">
										<?php 
											for($i=0;$i<9;$i++){
										?>
												<label class='btn btn-primary'>
													<input type='radio' name='areaoption' autocomplete='off' value='<?php echo $areaeng2[$i]; ?>'/><?php echo $areaname2[$i]; ?>
												</label>
										<?php	
											}
										?>
									</div>
								</div>
							</div>
						</div>
						<!--點擊看更多-->
						<center>
						<div id="outblock">
						</div>
						<div id="caldatanum">
							<?php
								$numsql = "Select * from event";
								$numrst = mysqli_query($conn,$numsql);
								echo "<input type='hidden' id='daan' value=".mysqli_num_rows($numrst).">";
							?>
						</div>
						<div id="loadmorectn">
							<button id="loadmore" class="loadmore">載入更多</button>
						</div>
						</center>
					</div>
				</div>
			</section>
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
			<script src="../funcd/js/jquery.scrolly.min.js"></script>
			<script src="../funcd/js/skel.min.js"></script>
			<script src="../funcd/js/util.js"></script>
			<script src="../funcd/js/main.js"></script>
			<script src="../funcd/js/bootstrap.js"></script>
			<script src="../funcd/js/dialogset.js"></script>
			<script>
			//資料搜尋
				$(document).ready(function () {
					load_data();
					function load_data(query) {
						$.ajax({
							url: "e_datasearch.php",
							method: "GET",
							data: {
								s: query
							},
							success: function (data) {
								$('#outblock').html(data);
							}
						});
					}
					$('#txt_blocksearch').keyup(function () {
						var search = $(this).val();
						if (search != '') {
							load_data(search);
							$("#loadmore").hide();
						} else {
							load_data();
							$("#loadmore").show();
						}
					});
				});
			</script>

			<script>
			//載入更多資料
			$(document).ready(function(){
				var datacount = document.getElementById("daan").value;
				var blockCount = 8;
				if(datacount<8){
					$("#loadmore").hide();
				}
				/*$(".btn").change(function(){
					var areaselect = $('input[name=areaoption]:checked').val();
				});*/

				$("#loadmore").click(function(){
					blockCount = blockCount + 8;
					$("#outblock").load("load-outblock.php", {
						blockNewCount: blockCount,
						selectNewVal : $('#datasort').val(),
						areaSelect : $('input[name=areaoption]:checked').val(),
						regionhun : $('.regionhun').val(),
					});
					//按鈕消失
					if ( blockCount >= datacount){
						$("#loadmore").hide();
					}
					else if(datacount<8)
					{
						$("#loadmore").hide();
					}
					else{
						$("#loadmore").show();
					}
				});
				//select改變
				$("#datasort").change(function() {
					blockCount=8;
					$("#loadmore").show();
				});
				$(".btn").change(function() {
					blockCount=8;
					$("#loadmore").show();
				});
				$("#txt_blocksearch").keyup(function() {
					blockCount=8;
					$("#loadmore").show();
				});
				$(".regionhun").change(function(){
					blackCount=8;
					$("#loadmore").show();

				});
			});
		</script>

		<script>
			//資料排序
			var check=function(){
				var select_sort=$('#datasort').val();
				$.ajax({
					url: "e_datasearch.php",
					data: "&select_sort="+select_sort,
					type:"GET",
					dataType:'text',
					success: function(message){
						document.getElementById("outblock").innerHTML=message;
					}
				});
			}
		</script>
		
		<script>
			//地區篩選
			$(".btn").change(function(){
				var areaselect = $('input[name=areaoption]:checked').val();
				$.ajax({
					url: "e_datasearch.php",
					data: "&areaselect="+areaselect,
					type:"GET",
					dataType:'text',
					success: function(data){
						$('#outblock').html(data);
					}
				});
				if(areaselect=='hun'){
					$('.regionhun').css('display','block');
				}
				else{
					$('.regionhun').css('display','none');
				}
				if(areaselect=='hun' || areaselect=='all'){
					$("#loadmorectn").show();
				}
				else{
					$("#loadmorectn").hide();
				}
			});
			$(".regionhun").change(function(){
				var regionhun = $('.regionhun').val();
				$.ajax({
					url: "e_datasearch.php",
					data: "&regionhun="+regionhun,
					type:"GET",
					dataType:'text',
					success: function(data){
						$('#outblock').html(data);
					}
				});
			});
			/*$(".btn").change(function(){
				var areaselect = $('input[name=areaoption]:checked').val();
				$.ajax({
					url: "eventdatanum.php",
					data: "&areaselect="+areaselect,
					type:"GET",
					dataType:'text',
					success: function(data){
						$('#outblock').html(data);
					}
				});
			});*/
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