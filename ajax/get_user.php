<?php
session_start();

require "../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//Config
define('CONSUMER_KEY', 'API_KEY');
define('CONSUMER_SECRET', 'API_KEY');

//Get users token
$access_token = [
  'oauth_token' => $_COOKIE["access_token_oauth_token"],
  'oauth_token_secret' =>  $_COOKIE["access_token_oauth_token_secret"]
];

//$access_token = $_SESSION['access_token'];

//Connect and get data
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$user = $connection->get('account/verify_credentials', ['tweet_mode' => 'extended', 'include_entities' => 'true']);

//Send data back for ajax
echo json_encode($user);
