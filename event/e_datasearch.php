<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
			require_once '../funcd/dbh.php';

			if (isset($_GET['s'])) { // 如果有搜尋文字顯示搜尋結果
				$s = mysqli_real_escape_string($conn, $_GET['s']);
				$sql = "SELECT * FROM event WHERE E_Name LIKE '%" . $s . "%' OR E_Startdate LIKE '%" . $s . "%' OR E_Addr LIKE '%" . $s . "%' ORDER BY E_Addtime DESC";
				$result = mysqli_query($conn, $sql);
				$data_nums = mysqli_num_rows($result); 
				$box_per_row = 4;
				$i=1;

				// SQL 搜尋錯誤訊息
				if (!$result) {
					echo ("錯誤：" . mysqli_error($conn));
					exit();
				}

				// 搜尋無資料時顯示「查無資料」
				if (mysqli_num_rows($result) <= 0) {
					echo " ";
				}

				// 搜尋有資料時顯示搜尋結果
				if(mysqli_num_rows($result)>0){
					while ($row = mysqli_fetch_array ($result)){
						$ename=$row['E_Name'];
						$edate=$row['E_Startdate'];
						$eimage=$row['E_Image'];
						$eadr=$row['E_Addr'];
						$eid=$row['E_Id'];
						echo "<input type='hidden' value='$eid' class='eidnum'>";

						if ($i % $box_per_row == 1) {
							echo "<div id='eoutsort' align='center'>"; 
						}
						echo	"<div class='hovereffect' id='eimsort' class='box' align='center'>
								<a href='../event/event_sub.php?eid=$eid' style='text-decoration:none;' class='calcount'>
								<div class='pic'>
								<img id='ime' src=$eimage>
								</div>
								<div id='ename'>$ename</div>
								<div id='edate'>$edate</div>
								<div id='eadr'>$eadr</div>
								</a>
								</div> ";
						if($i % $box_per_row==0||$i==$data_nums){
							echo "</div>";
						}
						$i++;
					}
				}
				else{
					echo "<div id='noresult'><h3>沒有搜尋結果</h3></div>";
				}

			} 
			else { // 如果沒有搜尋文字顯示所有資料
				if(isset($_GET['select_sort'])){
					//資料排序
					switch($_GET['select_sort']){
						case 0:
							$sql = "SELECT * FROM event ORDER BY E_Addtime DESC LIMIT 8 "; 
							break;
						case 1:
							$sql = "SELECT * FROM event ORDER BY E_Startdate ASC LIMIT 8 "; 
							break;
						case 2:
							$sql = "SELECT * FROM event ORDER BY E_Clicknum DESC LIMIT 8 "; 
							break;
					}
				}
				else{
					$sql = "SELECT * FROM event ORDER BY E_Addtime DESC LIMIT 8 ";
				}
				//地區分類
				if(isset($_GET['areaselect'])){
					$areaname=array("%台北%","%新北%","%基隆%","%桃園%","%宜蘭%","%新竹%","%苗栗%","%台中%","%彰化%","%南投%","%雲林%","%嘉義%","%台南%","%高雄%","%屏東%","%花蓮%","%台東%");
					$areaeng=array("tpe","ntpc","kel","tyn","ila","hsz","zmi","txg","chw","ntc","yun","cyi","tnn","khh","pif","hun","ttt");
					for($i=0;$i<17;$i++){
						if($_GET['areaselect']==$areaeng[$i]){
							$sql = "SELECT * FROM event WHERE E_Addr LIKE '{$areaname[$i]}' ORDER BY E_Addtime DESC LIMIT 8";
						}
					}
				}
				//花蓮細分
				if(isset($_GET["regionhun"])){
					$hunnum=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13);
					$hunname=array("%花蓮%","%花蓮市%","%鳳林鎮%","%玉里鎮%","%新城鄉%","%吉安鄉%","%壽豐鄉%","%光復鄉%","%豐濱鄉%","%瑞穗鄉%","%富里鄉%","%秀林鄉%","%萬榮鄉%","%卓溪鄉%");
					for($i=0;$i<14;$i++){
						if($_GET['regionhun']==$hunnum[$i]){
							$sql = "SELECT * FROM event WHERE E_Addr LIKE '{$hunname[$i]}' ORDER BY E_Addtime DESC LIMIT 8";
						}
					}
				}
				$result = mysqli_query($conn,$sql) or die("Error");
				$data_nums = mysqli_num_rows($result); 
				$box_per_row = 4;
				$i=1;
				if(mysqli_num_rows($result)>0){
					while ($row = mysqli_fetch_array ($result)){
						$ename=$row['E_Name'];
						$edate=$row['E_Startdate'];
						$eimage=$row['E_Image'];
						$eadr=$row['E_Addr'];
						$eid=$row['E_Id'];
						echo "<input type=hidden value='$eid' class='eidnum'>";

						if ($i % $box_per_row == 1) {
							echo "<div id='eoutsort' align='right'>"; 
						}
						echo	"<div class='hovereffect' id='eimsort' class='box' align='center'>
									<a href='../event/event_sub.php?eid=$eid' style='text-decoration:none;' class='calcount' value='$eid'>
									<div class='pic'>
									<img id='ime' src=$eimage>
									</div>
									<div id='ename'>$ename</div>
									<div id='edate'>$edate</div>
									<div id='eadr'>$eadr</div>
									<input type=hidden class='eid' value='$eid' />
									</a>
								</div> ";
						if($i % $box_per_row==0||$i==$data_nums){
							echo "</div>";
						}
						$i++;
					}
					echo "<div style='clear:both;'></div>";
				}
				else{
					echo "<div id='noresult'><h3>目前沒有要舉辦的市集</h3></div>";
				}
			}
		?>
		<script src="../funcd/js/jquery-1.11.3.min.js"></script>
		<script>
			$(function(){
				$(".calcount").click(function(){
					var eidnum = $(this).attr("value");
					$.ajax({
						url:"eventcalcount.php",
						method:"GET",
						data: "&eidnum="+eidnum
					});
				});
			})
		</script>
		<script>
			$(function(){
				var datanum = <?php echo $data_nums; ?>;
				$.ajax({
					url:"event_index.php",
					method:"GET",
					data: "&datanum="+datanum,
				});
			});
		</script>
	</body>
</html>