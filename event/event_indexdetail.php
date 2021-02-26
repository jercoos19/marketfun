<div class="event_index">
    <?php
        require_once '../funcd/dbh.php';
    ?>
    <div class="e_toolbar">
        <!--資料排序方式-->
        <select id="datasort" name="datasort" onchange="check()";>	
            <option value="0">最新刊登</option>	
            <option value="1">開始日期最近</option>
            <option value="2">熱門市集</option>
        </select>
        <!--資料搜尋-->
        <input type="text" name="txt_blocksearch" id="txt_blocksearch" placeholder="快速搜尋" class="form-control">
        <!--地區分類-->
        <select class='regiondetail'>
            <option>請選擇</option>
            <option value='花蓮市'>花蓮市</option>
            <option value='壽豐鄉'>壽豐鄉</option>
            <option value='吉安鄉'>吉安鄉</option>
            
        </select>
        <div id="areac">
            <button class="areaclass" id="areanorth" value="north">北部</button>
            <button class="areaclass" id='areamid' value="mid">中部</button>
            <button class="areaclass" id="areasouth" value="south">南部</button>
            <button class="areaclass" id="areaeast" value="east">東部</button>	
        </div>
    </div>
    <!--點擊看更多-->
    <center>
    <div id="outblock">
    </div>
    <button id="loadmore">載入更多</button>
    </center>
    <?php
    //算總資料筆數
    $numsql = "SELECT * FROM event"; 
    $numrst = mysqli_query($conn,$numsql);
    echo "<input type='hidden' id='daan' name='daan' value= ".mysqli_num_rows($numrst).">";
    ?>
</div>