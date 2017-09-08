<?php
	header("Content-type: application/json");
	require("../config.php");
	$sql = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION["FBID"]."'";
	$user = mysql_query($sql);
	$user = mysql_fetch_assoc($user);
	$type = $user["user_type"];
	if($type==1){
		$array = array("name" => $user["user_name"], "about" => $user["user_about"]);
	}else{
		$array = array("name" =>  $user["comp_name"]." - ".$user["user_name"], "about" => $user["about_company"]);
	}
	echo json_encode($array);
?>