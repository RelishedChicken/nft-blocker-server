<?php

require "../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//Start Session
session_start();

//Continue when users dc
ignore_user_abort(true);

//Get users token
$access_token = [
  'oauth_token' => $_COOKIE["access_token_oauth_token"],
  'oauth_token_secret' =>  $_COOKIE["access_token_oauth_token_secret"]
];
//$access_token = $_SESSION['access_token'];

//List of screennames
if(isset($_REQUEST['users'])){
  $users = explode(',', $_REQUEST['users']);
}else{
  die("No query set");
}

//Config
define('CONSUMER_KEY', 'API_KEY');
define('CONSUMER_SECRET', 'API_KEY');

//Connect
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

foreach ($users as $user) {
  //Block user
  $blocked = $connection->post("blocks/create", ["screen_name" => $user]);
}

echo json_encode($users);

?>
