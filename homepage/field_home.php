<html>
	<head>
		<link rel="stylesheet" href="../funcd/css/homepage/eventshow.css">
	</head>
	<body>
		<?php
			$sql = "SELECT * FROM field ORDER BY F_Addtime DESC LIMIT 3 "; 
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
						echo "<div id='foutsort' align='center'>"; 
					}
					echo	"<div class='hovereffect' id='fimsort' class='box' align='center'>
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
			else{
				echo "<div id='noresult'><h3>目前沒有要出租的場地</h3></div>";
			}
		?>
	</body>
</html>