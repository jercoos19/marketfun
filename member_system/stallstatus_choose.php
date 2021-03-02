<html>
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
        <?php
            session_start();
            require_once "../funcd/dbh.php";
            $uid=$_SESSION['userid'];
            //0等待 1同意 2拒絕
            if(isset($_GET["stallstatus"])){
                switch($_GET["stallstatus"]){
                    case "all":
                        $sql="Select * from stall where U_Id='$uid'";
                        break;
                    case "wait":
                        $sql="Select * from stall where (U_Id='$uid') AND (S_Status='0')";
                        break;
                    case "approve":
                        $sql="Select * from stall where (U_Id='$uid') AND (S_Status='1')";
                        break;
                    case "reject":
                        $sql="Select * from stall where (U_Id='$uid') AND (S_Status='2')";
                        break;
                }
            }
            $rst = @mysqli_query($conn,$sql);
            if($rst==true){
                if(mysqli_num_rows($rst)>0){
                    while ($row = mysqli_fetch_array ($rst)){	
                        $ename=$row['E_Name'];
                        $sname=$row['S_Name'];
                        $scontent=$row['S_Content'];
                        $uid=$row['U_Id'];
                        $sid=$row['S_Id'];
                        $saddtime=$row['S_Addtime'];
                        $stallstatus=$row['S_Status'];
                        $sposition=$row['S_Position'];
        ?>
                        <div class='stallstatus'>
                            <h3><?php echo $ename; ?></h3>
                            <hr>
                            <div class="stasall">
                                <div class="stastitle">
                                    <h5>攤位名字</h5>
                                    <h5>擺攤位置</h5>
                                    <h5>申請狀態</h5>
                                </div>
                                <div class="stascontent">
                                    <h5><?php echo $sname; ?></h5>
                                    <h5><?php echo $sposition; ?></h5>
                                    <h5><?php
                                        switch($stallstatus){	
                                            case 0: echo "等待回應中"; break;
                                            case 1: echo "已同意"; break;
                                            case 2: echo "已拒絕"; break;
                                        }?>
                                    </h5>
                                </div>
                                <div class="stasitem">
                                    <h5>商品內容</h5>
                                    <h5><?php echo $scontent; ?></h5>
                                </div>
                                <a  class="button stalleditbtn" href='../stall/stallupdate.php?sid=<?php echo $sid; ?>'>修改</a>
                                <div style='clear:both;'></div>
                                <button class="button stalldelbtn" value="<?php echo $sid; ?>">刪除</button>
                                <div style='clear:both;'></div>
                            </div>
                        </div>
        <?php
                    }
                }
                else{
                    echo "<div class='stallnoresult'><h3>目前沒有已申請的攤位</h3></div>";
                }
            }
            else{
                echo "sqlerror";
            }
        ?>
        <script>
			$('.stalldelbtn').click(function(){
				var sid = $(this).attr("value");
				$('.delemodal').css('display','block');
				$('.definedelbtn').click(function(){
					$.ajax({
						url: "../stall/stalldelete.php",
						data: "&sid="+sid,
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