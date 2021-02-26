<?php
	if(isset($_SESSION['userid']) && $_SESSION['userid'] == TRUE):	
?>
<html>
	<head>
		<link rel="stylesheet" href="../funcd/css/field/field_index.css" type="text/css">
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
				require_once "../funcd/dbh.php";
				$sql = "SELECT * FROM field ORDER BY F_Addtime DESC ";
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
								<a href='../field/field_sub.php?fid=$fid' style='text-decoration:none;'>
									<img id='ime' src=$fimage>
									<div id='fname'>$fname</div>
									<div id='fdate'>$fdate</div>
									<div id='fadr'>$fadr</div>
									<div class='fbtcontainer'>
										<a href='../fieldae/fieldupdate.php?fid=$fid' class='fupbtn button' id='fupbtn'>修改</a>
										<button id='fdelbtn' class='fdelbtn button' value='$fid'>刪除</button><br/>
									</div>
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
					echo "<div class='noresult'><h3>目前沒有出租中的場地</h3></div>";
				}
			?>
		</div>
		<script>
			$('.fdelbtn').click(function(){
				var fid = $(this).attr("value");
				$('.delemodal').css('display','block');
				$('.definedelbtn').click(function(){
					$.ajax({
						url: "../fieldae/fielddelete.php",
						data: "&fid="+fid,
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
	</body>
</html>
<?php
	else:
		header('Location: ../member_system/login.php');
	endif;
?>