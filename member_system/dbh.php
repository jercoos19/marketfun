<?php
	header("Content-Type:text/html; charset=UTF-8");
	$conn=mysqli_connect("127.0.0.1","root","","mrdb") or die("Error");
	mysqli_query($conn, 'SET NAMES utf8');
	try {

	//create PDO connection
	$db = new PDO('mysql:host=localhost;dbname=mrdb;port=3306;charset=utf8mb4', 'root','');
    
    }catch(PDOException $e) {
	
    exit("DB CAN'T CONNECT!");
    }
?>