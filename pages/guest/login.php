<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $var = fgetobject('users', 'username', strtolower($_POST['username']));

            $selected = $var->fetch(PDO::FETCH_ASSOC);

            $today = date("Y-m-d");

            if($selected['enddate'] <= $today){

              $_SESSION["alert"]["backgroundcolor"] = "red";
              $_SESSION["alert"]["color"] = "white";
              $_SESSION["alert"]["message"] = "oeps ".$selected['username'].", uw account is verlopen";
              header('Location: index.php?path=guest&page=login');
              die();
            }

            if(password_verify($_POST['password'], $selected['password']) && $selected['username'] == strtolower($_POST['username']))
            {
                $_SESSION["ingelogd"] = true;
                $_SESSION["userID"] = $selected["userID"];
                $_SESSION["roleID"] = $selected["roleID"];

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "Succesvol ingelogd";
                header('Location: index.php?');
                die();
            }
            else
            {
                $_SESSION["alert"]["backgroundcolor"] = "red";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "oeps, u heeft niet de goede combinatie voor eem gebruikersnaam en wachtwoord";
                header('Location: index.php?path=guest&page=login');
                die();
            }
        }
        else
        {
            $_SESSION["alert"]["backgroundcolor"] = "red";
            $_SESSION["alert"]["color"] = "white";
            $_SESSION["alert"]["message"] = "Een van de velden is niet goed ingevuld.";
            header('Location: index.php?path=guest&page=login');
            die();
        }
    }
?>
<style>body{
  margin: 0;
  padding: 0;
  background: url(https://i.ibb.co/VQmtgjh/6845078.png) no-repeat;
  height: 100vh;
  font-family: sans-serif;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  overflow: hidden}@media screen and (max-width: 600px;)
  {body{background-size: cover;: fixed}}#particles-js{height: 100%}.loginBox{position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);width: 350px;min-height: 200px;background: #000000;border-radius: 10px;padding: 40px;box-sizing: border-box}.user{margin: 0 auto;display: block;margin-bottom: 20px}h3{margin: 0;padding: 0 0 20px;color: #59238F;text-align: center}.loginBox input{width: 100%;margin-bottom: 20px}.loginBox input[type="text"], .loginBox input[type="password"]{border: none;border-bottom: 2px solid #262626;outline: none;height: 40px;color: #fff;background: transparent;font-size: 16px;padding-left: 20px;box-sizing: border-box}.loginBox input[type="text"]:hover, .loginBox input[type="password"]:hover{color: #42F3FA;border: 1px solid #42F3FA;box-shadow: 0 0 5px rgba(0,255,0,.3), 0 0 10px rgba(0,255,0,.2), 0 0 15px rgba(0,255,0,.1), 0 2px 0 black}.loginBox input[type="text"]:focus, .loginBox input[type="password"]:focus{border-bottom: 2px solid #42F3FA}.inputBox{position: relative}.inputBox span{position: absolute;top: 10px;color: #262626}.loginBox input[type="submit"]{border: none;outline: none;height: 40px;font-size: 16px;background: #59238F;color: #fff;border-radius: 20px;cursor: pointer}.loginBox a{color: #262626;font-size: 14px;font-weight: bold;text-decoration: none;text-align: center;display: block}a:hover{color: #00ffff}p{color: #0000ff}</style>

<div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
        <h3>Login</h3>
        <form action="index.php?path=guest&page=login" method="post">
            <div class="inputBox"> 
              <input type="text" name="username" placeholder="Gebruikersnaam"> 
              <input type="password" name="password" placeholder="Wachtwoord"> 
            </div> 
            <input type="submit" name="" value="Inloggen">
        </form>         
    </div>