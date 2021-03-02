<!DOCTYPE html>
<html>
	<body>
		<?php
			$sql = "SELECT * FROM event WHERE E_Classification='二手' ORDER BY E_Addtime DESC LIMIT 4"; 
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

					if ($i % $box_per_row == 1) {
						echo "<div id='outsort' align='center'>"; 
					}
					echo	"<div class='hovereffect' id='eimsort' class='box' align='center'>
							<a href='../event/event_sub.php?eid=$eid' style='text-decoration:none;' class='calcount' value='$eid'>
							<div class='pic'>
							<img id='eime' src=$eimage>
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
				 echo "<div style='clear:both;'></div>";
			}
		?>
		<script src="../funcd/js/jquery-1.11.3.min.js"></script>
		<script>
			$(function(){
				$(".calcount").click(function(){
					var eidnum = $(this).attr("value");
					$.ajax({
						url:"../event/eventcalcount.php",
						method:"GET",
						data: "&eidnum="+eidnum
					});
				});
			})
		</script>
	</body>
</html>