<html>
<?php
header("Content-Type:text/html; charset=utf-8");
$conn = @mysqli_connect("127.0.0.1", "root", "", "MRDB") or die("NO");
mysqli_query($conn, 'SET NAMES utf8'); 

$delete=$_GET["dog"];
$sql="DELETE FROM event WHERE E_Id ={$delete}";

$rst = @mysqli_query($conn,$sql );

$rowDeleted=mysqli_affected_rows($conn);

if($rowDeleted>0)
{
	echo "資料刪除成功";
	
}
else
{
	echo "資料刪除失敗";
}
 
?>
<a href='http://127.0.0.1:1000/code2/editev.html'>回新增刪除頁</a>
</html>