<?php
	header("Content-type: application/json");
	require("../config.php");
	$sql = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION["FBID"]."'";
	$user = mysql_query($sql);
	$user = mysql_fetch_assoc($user);
	$jobs = $user["user_jobs"];
	$jobs = explode(',', $jobs);
	$i = 0;
	$array = array();
	foreach($jobs as $job){
		$array[$i] = $job;
		$i++;
	}
	if($user["user_type"]==1){
		echo json_encode($array);
	}else{
		echo json_encode(array());
	}
?>