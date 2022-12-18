<?php
//error_reporting(0);
session_start();

include 'SQL/connection.php';
include 'inc/class.inc.php';

if (isset($_GET['page']) && !isset($_SESSION['ingelogd'])) {
    $page = 'login';
    $path = 'guest';

}
elseif (isset($_SESSION['ingelogd']))
{
    if(isset($_GET['page']) && $_GET['page'] == "uitloggen")
    {
        session_destroy();
        session_start();
        header('Location: index.php?path=guest&page=login');
        die();
    }
    elseif(isset($_GET['path']) && isset($_GET['page']) && $_GET['path'] != "guest")
    {
        $page = $_GET['page'];
        $path = $_GET['path'];
    }
    else
    {
        $path = "";
        $page = "home";
    }

}
else
{
    session_destroy();
    session_start();
    header('Location: index.php?path=guest&page=login');
    die();
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>the better great website</title>
    <!-- website icon -->
    <link rel="icon" href="" />
    <!-- jquery script -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- bootstrap script -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- bootstrap stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css" type="text/css">

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php
    include 'inc/navbar/navbar.php';
?>

    <?php
    if(isset($_SESSION["alert"]["backgroundcolor"]) && isset($_SESSION["alert"]["color"]) && isset($_SESSION["alert"]["message"]))
    {
    ?>
        <div class="alert" style="background-color: <?= $_SESSION["alert"]["backgroundcolor"] ?>; color: <?=$_SESSION["alert"]["color"]?>">
            <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $_SESSION["alert"]["message"] ?>
        </div>
    <?php
        unset($_SESSION["alert"]["message"]);
        unset($_SESSION["alert"]["backgroundcolor"]);
        unset($_SESSION["alert"]["color"]);
    }
    
    if($page == "login"){
        include 'pages/'.$path.'/'.$page.'.php';
    }
    else
    {?>
        <div class="container">
            <?php 
            
            if($path != "")
            {
                
                include 'pages/'.$path.'/'.$page.'.php';
            }
            else
            {
                include 'pages/'.$page.'.php';
            }
            
            ?>
        </div>
    <?php
    }
    ?>
    
</body>
</html>