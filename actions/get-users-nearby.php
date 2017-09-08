<?php
	header("Content-type: application/json");
	require("../config.php");
	$sql = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION["FBID"]."'";
	$user = mysql_query($sql);
	$user = mysql_fetch_assoc($user);
	$type = $user["user_type"];

	if($type==1){
		$sql = "SELECT * FROM `users` WHERE `user_type` = 0";
	}else{
		$sql = "SELECT * FROM `users` WHERE `user_type` = 1";
	}
	$result = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
		$array[$i] = array("name"=>(($row['user_type']==1) ? $row['user_name'] : $row['user_name']." - ".$row['comp_name']), "id"=>$row['user_id'], "about"=>(($row['user_type']==1) ? $row['user_about'] : $row['about_company']));
		$i++;
	}
	echo json_encode($array);
?>