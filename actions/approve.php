<?php
	session_start();
	require("../config.php");
	$user = mysql_query("INSERT INTO `matched` (`to`, `from`) VALUES ('".$_GET["id"]."', '".$_SESSION["FBID"]."')");
?>