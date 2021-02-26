<?php
    require_once '../funcd/dbh.php';
    if(isset($_GET['fidnum'])){
        $fidnum = $_GET['fidnum'];
    }
    $sql="UPDATE field SET F_Clicknum = F_Clicknum+1 WHERE F_Id='$fidnum'";
    $result = mysqli_query($conn,$sql) or die("Error");
?>