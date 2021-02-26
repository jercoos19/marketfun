<?php
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
?>
<html>
	<head>
		<link rel="stylesheet" href="../funcd/css/event/event_index.css" type="text/css">
		<script src="../funcd/js/jquery-1.11.3.min.js"></script>
	</head>
	<body>
		<!--deletedialog set-->
		<div id="deleModal" class="delemodal">
			<div class="checkmodal-content">
				<div class="dialog-header">
					<span class="close">&times;</span>
				</div>
				<div class='dialog-content'>
					<h5 class='checkword'>確定要刪除?</h5>
					<div class='checkbtn'>
						<button class='definedelbtn button'>確定</button>
						<button class='canceldelbtn button'>取消</button>
					</div>
				</div>
			</div>
		</div>
		<div id="outblock">
			<?php
				$uid = $_SESSION['userid'];
				$sql = "SELECT * FROM event WHERE U_Id='$uid' ORDER BY E_Addtime DESC";
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
							echo "<div id='eoutsort' align='center'>"; 
						}
						echo	"<div class='hovereffect' id='eimsort' class='box' align='center'>
								<a href='../event/event_sub.php?eid=$eid' style='text-decoration:none;' class='calcount'>
								<div class='pic'>
								<img id='imeinmanage' src=$eimage>
								</div>
									<div id='ename'>$ename</div>
									<div id='edate'>$edate</div>
									<div id='eadr'>$eadr</div>
								</a>
									<div class='ebtcontainer'>
										<a class='eupBtn button' href='../eventae/eventupdate.php?eid=$eid'>修改</a>
										<button class='edelBtn button' value='$eid'>刪除</button><br/>
									</div>
									<div class='smanagecontainer'>
										<a class='smanage button' href='../stall/stallmanage.php?eid=$eid&ename=$ename'>攤販管理</a>
									</div>
								</div> ";
								//onclick='javascript:return delalert();'
								//<a href='../eventae/eventdelete.php?eid=$eid' class='hideevdelbtn'></a>
						if($i % $box_per_row==0||$i==$data_nums){
							echo "</div>";
						}
						$i++;
					}
					 echo "<div style='clear:both;'></div>";
				}
				else{
					echo "<div class='noresult'><h3>目前沒有市集舉辦</h3></div>";
				}
			?>
		</div>
	</body>
	<script>
		$('.edelBtn').click(function(){
			var eid = $(this).attr("value");
			$('.delemodal').css('display','block');
			$('.definedelbtn').click(function(){
				$.ajax({
					url: "../eventae/eventdelete.php",
					data: "&eid="+eid,
					type:"GET",
					async: false, 
					dataType:'text',
					success: function(data){
						$('body').html(data);
						window.location.reload();
					}
				});
			});
			$('.canceldelbtn').click(function(){
				$('.delemodal').css('display','none');
			});
		});
		$(".close").click(function(){
			$('.delemodal').css('display','none');
		});
	</script>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>