<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user = fgetobject("users", "userID", $_SESSION["userID"]);
    $user = $user->fetch(PDO::FETCH_ASSOC);

    if(password_verify($_POST["old"], $user["password"]))
    {

        $_SESSION["alert"]["backgroundcolor"] = "red";
        $_SESSION["alert"]["color"] = "white";
        $_SESSION["alert"]["message"] = "Oeps probeer het opnieuw, Er is iets fout gegaan!";

        if($_POST["new"] != "")
        {

            $arrayvalues = array();
            $arrayvalues["password"] = password_hash($_POST['new'], PASSWORD_DEFAULT);


            fupdateobject("users", $arrayvalues, " where userID = ".$user["userID"]);

            $_SESSION["alert"]["backgroundcolor"] = "green";
            $_SESSION["alert"]["color"] = "white";
            $_SESSION["alert"]["message"] = "Wachtwoord is succesvol aangepast.";
        }
    }

    header('Location: index.php?path=settings&page=account');
    die();
}

$user = fgetobject("users", "userID", $_SESSION["userID"]);
$user = $user->fetch(PDO::FETCH_ASSOC);

$role = fgetobject("roles", "roleID", $user["roleID"]);
$role = $role->fetch(PDO::FETCH_ASSOC);

?>


<div class="wrapper bg-white mt-sm-5">
    <h1 class="pb-4 border-bottom">Account Instellingen</h1>
    <div class="d-flex align-items-start py-3 border-bottom">
        <img src="https://images.pexels.com/photos/1037995/pexels-photo-1037995.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
            class="img" alt="">
        <div class="pl-sm-4 pl-2" id="img-section">
            <b>Profile Photo</b>
            <p>(nog niet mogelijk)</p>
            <button disabled class="btn button border"><b>Upload</b></button>
        </div>
    </div>
    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-6">
                <label for="firstname">Gebruikersnaam</label>
                <input type="text" class="bg-light form-control" value="<?= $user["username"] ?>" disabled>
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="lastname">Rechten</label>
                <input type="text" class="bg-light form-control" value="<?= $role["name"] ?>" disabled>
            </div>
        </div>
        <form action="http://localhost/The-better.great-site.net/index.php?path=settings&page=account" method="POST">
        <div class="row py-2">
            <div class="col-md-6">
                <label for="email">Oud Wachtwoord</label>
                <input type="password" class="bg-light form-control" name="old" value="">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="phone">Nieuw Wachtwoord</label>
                <input type="password" class="bg-light form-control" name="new" value="">
            </div>
        </div>
        <div class="py-3 pb-4 border-bottom">
            <button type="submit" class="btn btn-primary mr-3">Wijzigingen opslaan</button>
        </div>
        <div class="d-sm-flex align-items-center pt-3" id="deactivate">
            <div>
                <b>Dit zijn jouw account gegevens</b>
                <p></p>
            </div>
        </div>
        </form>
    </div>
</div>