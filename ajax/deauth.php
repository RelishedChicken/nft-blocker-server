<?php
unset($_COOKIE['access_token_oauth_token']);
setcookie('access_token_oauth_token', null, -1, '/');
unset($_COOKIE['access_token_oauth_token_secret']);
setcookie('access_token_oauth_token_secret', null, -1, '/');
unset($_COOKIE['oauth_token']);
setcookie('oauth_token', null, -1, '/');
unset($_COOKIE['oauth_token_secret']);
setcookie('oauth_token_secret', null, -1, '/');

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
      <h1>Now you've done that, you should be able to head <a href='https://www.nftnuke.co.uk/ajax/twitter_auth.php'>here</a></h1>
      
    </div>
    <div class='apeCape'></div>
  </body>
</html>";
exit();
?>
