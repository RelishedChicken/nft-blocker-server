<?php
session_start();

require "../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


//If user has authed before
//Config
define('CONSUMER_KEY', 'API_KEY');
define('CONSUMER_SECRET', 'API_KEY');

$request_token = [];
$request_token['oauth_token'] = $_COOKIE["oauth_token"];
$request_token['oauth_token_secret'] = $_COOKIE["oauth_token_secret"];

if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] != $_REQUEST["oauth_token"]) {
  echo "<html>
    <style>

      :root {
        --main-color: #E3F100;
        --secondary-color:rgb(153, 150, 0);
        --background-color: gainsboro;
        --font-color: #E3F100;
      }

      @font-face {
      font-family: myFirstFont;
          src: url(media/font.otf);
      }

      body{
        margin: 0;
        width: 100%;
        height: 100%;
        background-color: black;
      }

      h1, h2, h3, p{
        color: var(--font-color);
        font-family: myFirstFont;
        width: 100%;
        text-align: center;
      }

      .apeCape{
          position: absolute;
          min-width: 100%;
          min-height: 100%;
          background-image: url(media/background.jpg);
          background-repeat: repeat;
          opacity: 0.5;
          z-index: -1;
      }

      a{
        color: var(--font-color);
        font-family: myFirstFont;
        text-decoration: none;
        border-bottom: 4px solid var(--font-color);

      }

      .content{
          float: left;
          width: 100%;
          height: calc(100% - 100px);
      }

    </style>
    <body>
      <div class='content'>
        <h1>This is where the web developer messed up! 🤔</h1>
        <h2>If this keeps happenening, go  <a href='https://www.nftnuke.co.uk/ajax/deauth.php'>here</a></h2>
        <h3>It will eventually redirect you back to NFTNuke so you can continue eviscerating CryptoBros 🧨</h3>

      </div>
      <div class='apeCape'></div>
    </body>
  </html>";
}else{
  //Create connection

  //echo $_REQUEST['oauth_verifier'];



  //Get the 'permanent' token
  try{
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
    $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
  }catch(Abraham\TwitterOAuth\TwitterOAuthException $e){
    echo "<html>
      <style>

        :root {
          --main-color: #E3F100;
          --secondary-color:rgb(153, 150, 0);
          --background-color: gainsboro;
          --font-color: #E3F100;
        }

        @font-face {
        font-family: myFirstFont;
            src: url(media/font.otf);
        }

        body{
          margin: 0;
          width: 100%;
          height: 100%;
          background-color: black;
          color: var(--font-color);
          text-align: center;
        }

        h1, h2, h3, p{
          color: var(--font-color);
          font-family: myFirstFont;
          width: 100%;
          text-align: center;
        }

        .apeCape{
            position: absolute;
            min-width: 100%;
            min-height: 100%;
            background-image: url(media/background.jpg);
            background-repeat: repeat;
            opacity: 0.5;
            z-index: -1;
        }

        a{
          color: var(--font-color);
          font-family: myFirstFont;
          text-decoration: none;
          border-bottom: 4px solid var(--font-color);

        }

        .content{
            float: left;
            width: 100%;
        }

      </style>
      <body>
        <div class='content'>
          <h1>Seems we're missing the launch codes...</h1>
          <h2>If you are stuck here, with some errors on the page, go <a href='https://www.nftnuke.co.uk/ajax/deauth.php'>here</a></h2>
          <h3>It will eventually redirect you back to NFTNuke so you can continue eviscerating CryptoBros 🧨</h3>
        </div>
        <div class='apeCape'></div>
      </body>
    </html>";
  }

  //Set in session var for furture use
  setcookie("access_token_oauth_token", $access_token['oauth_token'], time() + (86400 * 30), "/");
  setcookie("access_token_oauth_token_secret", $access_token['oauth_token_secret'], time() + (86400 * 30), "/");
  //$_SESSION['access_token'] = $access_token;

  header('Location: https://www.nftnuke.co.uk?auth=true');
  exit();
}


?>
