<?php
	require("../config.php");
	header("Content-type: application/json");
	$user = mysql_query("SELECT * FROM `users` WHERE `user_id` = '".$_SESSION["FBID"]."'");
	$user = mysql_fetch_assoc($user);
	$type = $user["user_type"];
	if($_SERVER["REQUEST_METHOD"]){
		if($type==1){
			$sql = mysql_query("UPDATE `users` SET `user_jobs` = '".mysql_escape_string($_POST['jobs'])."', `user_skills` = '".mysql_escape_string($_POST['skills'])."', `user_about` = '".mysql_escape_string($_POST['about'])."' WHERE `user_id` = '".$_SESSION['FBID']."'");
			$array = array("success" => true);
		}else{
			$sql = mysql_query("UPDATE `users` SET `comp_name` = '".mysql_escape_string($_POST['comp_name'])."', `comp_address` = '".mysql_escape_string($_POST['comp_address'])."', `about_company` = '".mysql_escape_string($_POST['about_company'])."' WHERE `user_id` = '".$_SESSION['FBID']."'");
			$array = array("success" => true);
		}
	}else{
		$array = array("success" => false);
	}
	echo json_encode($array);
?>