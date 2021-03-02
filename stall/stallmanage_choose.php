<?php
    require_once '../funcd/dbh.php';
    $eid=$_GET["eid"];
    //0等待 1同意 2拒絕
    if(isset($_GET["stallstatus"])){
        switch($_GET["stallstatus"]){
            case "wait":
                $sql="Select * from stall where E_Id='$eid' AND S_Status='0'";
                break;
            case "approve":
                $sql="Select * from stall where E_Id='$eid' AND S_Status='1'";
                break;
        }
    }

    $rst = @mysqli_query($conn,$sql);
    if($rst==true){
        if(mysqli_num_rows($rst)>0){
            while ($row = mysqli_fetch_array ($rst)){	
                $sname=$row['S_Name'];
                $scontent=$row['S_Content'];
                $sposition=$row['S_Position'];
                $uid=$row['U_Id'];
                $sid=$row['S_Id'];
                $utel=$row['U_Tel'];
                $saddtime=$row['S_Addtime'];
                $ename=$row['E_Name'];
?>
                <div class='stallwaitapl'>
                    <h3><?php echo "$ename"; ?></h3>
                    <hr>
                    <div class="stitle">
                        <h4>攤商名稱</h4>
                        <h4>申請者姓名</h4>
                        <h4>聯絡方式</h4>
                        <h4>申請擺攤位置</h4>
                    </div>
                    <div class="sinfo">
                        <h5><?php echo "$sname"; ?></h5>
                        <h5><?php echo "$uid"; ?></h5>
                        <h5><?php echo "$utel"; ?></h5>
                        <h5><?php echo "$sposition"; ?></h5>
                    </div>
                    <?php
                        if(isset($_GET["stallstatus"])){
                            if($_GET["stallstatus"]=='wait'){
                    ?>
                                <div class=stallcon>
                                    <button class='btapprove stallaplbtn button' name='btapprove' value='<?php echo "$sid"; ?>'>同意</button><br>
                                    <button class='btreject stallaplbtn button' name='btreject' value='<?php echo "$sid"; ?>'>拒絕</button>
                                </div>
                                <div class="scontent">
                                    <h4>商品內容</h4>
                                    <h5><?php echo "$scontent"; ?></h5>
                                </div>
                    <?php
                            }
                            else{
                    ?>
                                <div class="scontenta">
                                    <h4>商品內容</h4>
                                    <h5><?php echo "$scontent"; ?></h5>
                                </div>
                    <?php
                            }
                        }
                    ?>
                </div>
<?php	
                echo "<input type='hidden' value='$sid' class='sidnum'>";
                echo "<input type='hidden' value='$eid' class='eidnum'>";
            }
        }
        else{
            echo "<div class='stallnoresult'><h3>目前沒有等待回應的攤商</h3></div>";
        }
    }
    else{
        echo mysqli_error($conn);
    }
?>
<script src="../funcd/js/jquery-1.11.3.min.js"></script>
<script>
    $(document).ready(function(){
        $(".btapprove").click(function(){
            var sidnum = $(this).attr("value");
            var eidnum = $(".eidnum").val();
            $.ajax({
                url:"stall_approve.php?sid="+sidnum,
                data: "&eidnum="+eidnum,
                type:"GET",
                dataType:'text',
                async:true,
                success: function(message){
                    $(".srequest").html(message);
                    $(document).ajaxStop(function(){
                        window.location.reload();
                    });
                }
            });
        });
        $(".btreject").click(function(){
            var sidnum = $(this).attr("value");
            var eidnum = $(".eidnum").val();
            $.ajax({
                url:"stall_reject.php?sid="+sidnum,
                data: "&eidnum="+eidnum,
                type:"GET",
                dataType:'text',
                async:true,
                success: function(message){
                    $(".srequest").html(message);
                    $(document).ajaxStop(function(){
                        window.location.reload();
                    });
                }
            });
        });
    })
</script>