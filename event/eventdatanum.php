
<?php
    require_once '../funcd/dbh.php';
    if(isset($_GET["areaselect"])){
        $areaname=array("%台北%","%新北%","%基隆%","%桃園%","%宜蘭%","%新竹%","%苗栗%","%台中%","%彰化%","%南投%","%雲林%","%嘉義%","%台南%","%高雄%","%屏東%","%花蓮%","%台東%");
        $areaeng=array("tpe","ntpc","kel","tyn","ila","hsz","zmi","txg","chw","ntc","yun","cyi","tnn","khh","pif","hun","ttt");
        for($i=0;$i<17;$i++){
            if($_GET['areaselect']==$areaeng[$i]){
                $sql = "SELECT * FROM event WHERE E_Addr LIKE '{$areaname[$i]}'";
            }
        }
        echo $_GET["areaselect"];
    }
?>
