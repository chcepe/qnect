<?php
require("config.php");
session_start();
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
FacebookSession::setDefaultApplication($facebook_app[0],$facebook_app[1]);
$helper = new FacebookRedirectLoginHelper($web_url."/login.php");
try {
	$session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
} catch(Exception $ex) {
}
if (isset($session)) {
	$request = new FacebookRequest( $session, 'GET', '/me' );
	$response = $request->execute();
	$graphObject = $response->getGraphObject();
	$_SESSION["ACCESS_TOKEN"] = trim($session->getAccessToken());
	$_SESSION["FBID"] = $graphObject->getProperty('id');           
	$_SESSION["FULLNAME"] = $graphObject->getProperty('name');
	$_SESSION["EMAIL"] =  $graphObject->getProperty('email');
	mysql_query("INSERT IGNORE INTO `users` SET `user_id` = '".$_SESSION["FBID"]."', `user_type` = '1', `user_name` = '".$_SESSION["FULLNAME"]."'");
	header("Location: index.php");
} else {
	$loginUrl = $helper->getLoginUrl();
	header("Location: ".$loginUrl);
}
?>