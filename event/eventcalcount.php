<?php
    require_once '../funcd/dbh.php';
    if(isset($_GET['eidnum'])){
        $eidnum = $_GET['eidnum'];
    }
    $sql="UPDATE event SET E_Clicknum = E_Clicknum+1 WHERE E_Id='$eidnum'";
    $result = mysqli_query($conn,$sql) or die("Error");
?>