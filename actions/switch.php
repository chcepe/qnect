<?php
	require("../config.php");
	$user = mysql_query("SELECT * FROM `users` WHERE `user_id` = '".$_SESSION["FBID"]."'");
	$user = mysql_fetch_assoc($user);
	$type = $user["user_type"];
	$sql = "UPDATE `users` SET `user_type` = '".(($type==1) ? 0 : 1)."' WHERE `user_id` = '".$_SESSION["FBID"]."'";
	mysql_query($sql);
	
	header("Location: ../index.php")
?>