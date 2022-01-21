<?php
session_start();

//Imports
require "../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


//If user has authed before
if( isset($_COOKIE["access_token_oauth_token"]) && isset($_COOKIE["access_token_oauth_token_secret"]) ){
  header('Location: https://www.nftnuke.co.uk?auth=true');
  exit();
}else{

  //UNSET OLD auth
  unset($_COOKIE['access_token_oauth_token']);
  setcookie('access_token_oauth_token', null, -1, '/');
  unset($_COOKIE['access_token_oauth_token_secret']);
  setcookie('access_token_oauth_token_secret', null, -1, '/');
  unset($_COOKIE['oauth_token']);
  setcookie('oauth_token', null, -1, '/');
  unset($_COOKIE['oauth_token_secret']);
  setcookie('oauth_token_secret', null, -1, '/');

  sleep(1);

  //Config
  define('CONSUMER_KEY', 'API_KEY');
  define('CONSUMER_SECRET', 'API_KEY');
  define('OAUTH_CALLBACK', 'https://www.nftnuke.co.uk/ajax/save_auth.php');

  //Connection init and Temp Token request
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
  $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

  //Store token/secret
  setcookie("oauth_token", $request_token['oauth_token'], time() + (86400 * 30), "/");
  setcookie("oauth_token_secret", $request_token['oauth_token_secret'], time() + (86400 * 30), "/");
  /*$_SESSION["oauth_token"] =  $request_token['oauth_token'];
  $_SESSION["oauth_token_secret"] = $request_token['oauth_token_secret'];*/

  //redirect user to twitter
  $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

  header('Location: ' . $url);
  exit();

}

?>
