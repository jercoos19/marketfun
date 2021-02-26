<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		#imsort{
			position :relative;
			max-width:400px;
			max-height:350px;
			width:400px;
			height:280px;
			line-height:25px;
			margin-right:50px;
			margin-top:10px;
			background:#f0f0f0;
			float: left;
			word-break: break-all;
			word-wrap: break-word; 
		//滑鼠移入移出效果
			transition: background 1s;
			-webkit-transition: background 1s;
		}
		#imsort:hover {
			background: lightblue;
		}
		#outsort{
			position :relative;
			max-width:1500px;
			margin-top:50px;
			border:0px blue solid;
			margin-right:10px;
			top : 50px;
			left : 50px;
			float: left;
		}
		#ime{
			width:100%;
			over-flow:hidden; 
			height:150px;
			border-top-left-radius: 5px;
			border-top-right-radius: 5px;
		}
		#loadmore{
			border:0;
			border-radius:100px;
			font-weight:bold;
			font-family:PMingLiU;
			outline:none;
			background-color:#006599;
			font-size:16px;
			position:relative;
			margin-top:50px;
			height:30px;
			width:250px;
			top:60px;
			left:441px;
			color:#ffffff;
		}
		#loadmore:hover{
			color:#003C9D;
			background-color:#fff;
			border:2px #006599 solid;
		}
		#fname{
			color:black;
			font-weight:bold;
			font-family:PMingLiU;
			font-size:18px;
			padding:10px;
		}
		#fdate{
			color:#969696;
			padding:0px;
			font-size:16px;
			font-weight:bold;
			
		}
		#fadr{
			color:#969696;
			font-size:16px;
			font-weight:bold;
			padding:5px;
		}
		#far #edate #ename
		{
			-webkit-font-smoothing: antialiased;
		}
		#txt_blocksearch{
			position :relative;
			left: 50px;
			width:300px;
			height:40px;
		}
		#datasort{
			position :relative;
			float:left;
			left: 50px;
			height: 40px;
			width: 100px;
		}
		.memword{
			position: relative;
			text-align: center;
			font-size: 1.1rem;
			padding: 0px 0px;
		}
		.memberin{
			font-size: 1.1rem;
			padding: 0px 0px;
			text-align: center;
		}
		.lihr{
			font-size: 1.1rem;
			display: inline;
			margin-right:32px;
			margin-top:30px;
		}
		#areac{
			posotion:relative;
			float:right;
			margin-right:130px;
		}
		.areaclass{
			width:120px;
			height:40px;
			border:0;
			outline:none;
			font-weight:bold;
			font-family:PMingLiU;
			font-size:16px;
			background-color:#006599;
			color:#ffffff;
		}
		</style>
		<script src="js/jquery-1.11.3.min.js"></script>
		<script>
			//載入更多資料
			$(document).ready(function(){
				var datacount = document.getElementById("daan").value;
				var blockCount = 6;
				$("#loadmore").click(function(){
					blockCount = blockCount + 6;
					$("#outblock").load("load-outblock.php", {
						blockNewCount: blockCount,
						selectNewVal : $('#datasort').val(),
					});
					//按鈕消失
					if ( blockCount >= datacount){
						$("#loadmore").hide();
					}
					else if(datacount<6)
					{
						$("#loadmore").hide();
					}
					else{
					 $("#loadmore").show();
					}
				});
				//select改變
				$("#datasort").change(function() {
					blockCount=6;
					$("#loadmore").show();
				});
				$("#txt_blocksearch").keyup(function() {
					blockCount=6;
					$("#loadmore").show();
				});
				$(".areaclass").click(function() {
					blockCount=6;
					$("#loadmore").show();
				});
			});
		</script>

		<script>
			//資料排序
			var check=function(){
				var select_sort=$('#datasort').val();
				$.ajax({
					url: "f_datasearch.php",
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
		//資料搜尋
			$(document).ready(function () {
				load_data();
				function load_data(query) {
					$.ajax({
						url: "f_datasearch.php",
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
	</head>
    <body> 
		<div>
			<?php
				require_once '../funcd/dbh.php';
			?>
			<!--資料排序方式-->
			<select id="datasort" name="datasort" onchange="check()";>
				<option value="0">最新</option>	
				<option value="1">最舊</option>
				<option value="2">熱門</option>
			</select>
			<!--資料搜尋-->
			<input type="text" name="txt_blocksearch" id="txt_blocksearch" placeholder="快速搜尋" class="form-control"></input>
			<!--地區分類-->
			<div id="areac">
				<button class="areaclass" id="areanorth" value="north">北部</button>
				<button class="areaclass" id='areamid' value="mid">中部</button>
				<button class="areaclass" id="areasouth" value="south">南部</button>
				<button class="areaclass" id="areaeast" value="east">東部</button>
			</div>
			<!--點擊看更多-->
			<div id="outblock">
			</div>
			<button id="loadmore">載入更多</button>
			<?php
			//算總資料筆數
			$numsql = "SELECT * FROM field"; 
			$numrst = mysqli_query($conn,$numsql);
			echo "<input type='hidden' id='daan' name='daan' value= ".mysqli_num_rows($numrst)."> </input>";
			?>
		</div>
	</body>
</html>