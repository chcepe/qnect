<?php
	session_start();
	$allow_splash = true;
	$splash_delay = 5; //seconds
	$facebook_app = array("874530559356868", "4488f95c0b61b74f5912e9c03bb3725d");
	$root = $_SERVER["DOCUMENT_ROOT"]."/my-qnect";
	$web_url = "http://localhost/my-qnect";

	$conn = mysql_connect("localhost", "root", "");
	if(!$conn){
		die("Error".mysql_error());
	}
	mysql_select_db("qnect");
?>