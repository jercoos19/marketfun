<?php
session_start();
//require('member_system/dbh.php');
require_once 'dbh.php';
//collect values from the url
$U_Id = trim($_GET['x']);
$active = trim($_GET['y']);

//if id is number and the active token is not empty carry on
if(is_string($U_Id) && !empty($active)){

	//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
	$stmt = $db->prepare("UPDATE user SET active = 'Yes' WHERE U_Id = :U_Id AND active = :active");
	$stmt->execute(array(
		':U_Id' => $U_Id,
		':active' => $active
	));
	

	//if the row was updated redirect the user
	if($stmt->rowCount() == 1){

		//redirect to login page
		//header('Location: login.php?action=active');
		$_SESSION['userid'] = $U_Id;
		header('Location: ../homepage/homepage.php');
		
		exit;

	} else {
		echo "Your account could not be activated."; 
	}
	
}
?>