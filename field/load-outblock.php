<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
			require_once 'dbh.php';
			$blockNewCount = $_POST['blockNewCount'];
			$selectNewVal = $_POST['selectNewVal'];
			
			if(isset($selectNewVal)){
				//資料排序
				switch($selectNewVal){
					case 0:
						$sql = "SELECT * FROM field ORDER BY F_Addtime DESC LIMIT $blockNewCount "; 
						break;
					case 1:
						$sql = "SELECT * FROM field ORDER BY F_Startdate ASC LIMIT $blockNewCount "; 
						break;
					case 2:
						$sql = "SELECT * FROM field ORDER BY F_Clicknum DESC LIMIT $blockNewCount "; 
						break;
				}
			}
			else{
				$sql = "SELECT * FROM event ORDER BY F_Addtime DESC LIMIT $blockNewCount ";
			}
			//地區篩選
			if(isset($_POST['areaSelect'])){
				$areaname=array("%台北%","%新北%","%基隆%","%桃園%","%宜蘭%","%新竹%","%苗栗%","%台中%","%彰化%","%南投%","%雲林%","%嘉義%","%台南%","%高雄%","%屏東%","%花蓮%","%台東%");
				$areaeng=array("tpe","ntpc","kel","tyn","ila","hsz","zmi","txg","chw","ntc","yun","cyi","tnn","khh","pif","hun","ttt");
				for($i=0;$i<17;$i++){
					if($_POST['areaSelect']==$areaeng[$i]){
						$sql = "SELECT * FROM field WHERE F_Addr LIKE '{$areaname[$i]}' ORDER BY F_Addtime DESC LIMIT $blockNewCount";
					}
				}
			}
			//花蓮細分
			if(isset($_GET["regionhun"])){
				$hunnum=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13);
				$hunname=array("%花蓮%","%花蓮市%","%鳳林鎮%","%玉里鎮%","%新城鄉%","%吉安鄉%","%壽豐鄉%","%光復鄉%","%豐濱鄉%","%瑞穗鄉%","%富里鄉%","%秀林鄉%","%萬榮鄉%","%卓溪鄉%");
				for($i=0;$i<14;$i++){
					if($_GET['regionhun']==$hunnum[$i]){
						$sql = "SELECT * FROM field WHERE F_Addr LIKE '{$hunname[$i]}' ORDER BY F_Addtime DESC LIMIT $blockNewCount";
					}
				}
			}
			
			$result = mysqli_query($conn,$sql) or die("Error");
			$data_nums = mysqli_num_rows($result); 
			$box_per_row = 3;
			$i=1;
			if(mysqli_num_rows($result)>0){
				while ($row = mysqli_fetch_array ($result)){
					$fname=$row['F_Name'];
					$fdate=$row['F_Startdate'];
					$fimage=$row['F_Image'];
					$fadr=$row['F_Addr'];
					$fid=$row['F_Id'];

					if ($i % $box_per_row == 1) {
						echo "<div id='outsort' align='center'>"; 
					}
					echo	"<div class='hovereffect' id='imsort' class='box' align='center'>
							<a href='../field/field_sub.php?fid=$fid' style='text-decoration:none;' class='calcount' value='$fid'>
							<div class='pic'>
							<img id='ime' src=$fimage>
							</div>
							<div id='fname'>$fname</div>
							<div id='fdate'>$fdate</div>
							<div id='fadr'>$fadr</div>
							</a>
							</div> ";
					if($i % $box_per_row==0||$i==$data_nums){
						echo "</div>";
					}
					$i++;
				}
				echo "<div style='clear:both;'></div>";
			}
		?>
		<script src="../funcd/js/jquery-1.11.3.min.js"></script>
		<script>
			$(function(){
				$(".calcount").click(function(){
					var fidnum = $(this).attr("value");
					$.ajax({
						url:"fieldcalcount.php",
						method:"GET",
						data: "&fidnum="+fidnum
					});
				});
			})
		</script>
	</body>
</html>