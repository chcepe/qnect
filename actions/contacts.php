<?php
	header("Content-type: application/json");
	require("../config.php");
	$sql = "SELECT * FROM `matched` WHERE `from` = '".$_SESSION["FBID"]."' || `to` = '".$_SESSION["FBID"]."'";
	$result = mysql_query($sql);
	$i = 0;
	$ids;
	$array;
	while ($row = mysql_fetch_assoc($result)) {
		$sql = mysql_query("SELECT * FROM `matched` WHERE (`from` = '".$row["to"]."' AND `to` = '".$row["from"]."') OR (`from` = '".$row["from"]."' AND `to` = '".$row["to"]."')");
		$count = mysql_num_rows($sql);
		if($count>=2){
			if($row["from"]==$_SESSION["FBID"]){
				$user = $row["to"];
			}else{
				$user = $row["from"];
			}
			if(!in_array($user, $ids)){
				$result1 = mysql_query("SELECT * FROM `users` WHERE `user_id` = '".$user."'");
				$result1 = mysql_fetch_assoc($result1);
				$array[$i]["name"] = (($result1["user_type"]==1) ? $result1["user_name"] : $result1["comp_name"]." - ".$result1["user_name"]);
				$array[$i]["id"] = $result1["user_id"];
				$ids[$i] = $user;
				$i++;
			}
		}
	}
	echo json_encode($array);
?>