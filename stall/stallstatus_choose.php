
<?php
    session_start();
    require_once "../funcd/dbh.php";
    $uid=$_SESSION['userid'];
    //0等待 1同意 2拒絕
    if(isset($_GET["stallstatus"])){
        switch(isset($_GET["stallstatus"])){
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
    else{
        $sql="Select * from stall where U_Id='$uid'";
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
                    </div>
                </div>
<?php
            }
        }
        else{
            echo "<div class='noresult'><h3>目前沒有已申請的攤位</h3></div>";
        }
    }
    else{
        echo "sqlerror";
    }
?>
