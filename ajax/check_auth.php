<?php

//Start session
session_start();
echo json_encode(isset($_COOKIE["access_token_oauth_token"]) && isset($_COOKIE["access_token_oauth_token_secret"]));

 ?>
