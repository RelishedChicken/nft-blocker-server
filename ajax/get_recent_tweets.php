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
$response = $connection->get("tweets/search/recent", ["query" => '#NFT OR #NFTCommunity OR #NFTCollection OR #NFTProject OR #NewNFTProfilePic', 'max_results' => 100, 'expansions' => 'author_id', 'user.fields' => 'id,name,username']);

//Turn from obj to array
$response = json_decode(json_encode($response), true);

//Add to pile before waiting and trying again
/*foreach($response['includes']['users'] as $user){
  $big_pile[] = $user;
}*/

$awfulUsers = [];
foreach($response['includes']['users'] as $user){
  $awfulUsers[] = [
    'name' => $user["name"] . " (@" . $user["username"] . ")",
    'urlName' => $user["username"],
    'id' => $user["id"]
  ];
}

echo json_encode($awfulUsers);


 ?>
