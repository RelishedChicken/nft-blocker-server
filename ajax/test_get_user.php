<?php

require "../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//Start Session
session_start();

//Get user access
$access_token = [
  'oauth_token' => $_COOKIE["access_token_oauth_token"],
  'oauth_token_secret' =>  $_COOKIE["access_token_oauth_token_secret"]
];
//$access_token = $_SESSION['access_token'];

if(isset($_REQUEST['query'])){
  $q = $_REQUEST['query'];
}else{
  die("No query set");
}

//Config
define('CONSUMER_KEY', 'API_KEY');
define('CONSUMER_SECRET', 'API_KEY');

//Connect and get data
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$connection->setApiVersion('2');
