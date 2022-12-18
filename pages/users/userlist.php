<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_SESSION['roleID'] == "1")
    {
        if($_POST['button'] == "edit")
        {
            $_SESSION["selected_ID"] = $_POST['userID'];
        }
        elseif($_POST['button'] == "delete" && $_POST['userID'] != "")
        {
            fdeleteobject("users", "userID", $_POST['userID']);

            $_SESSION["alert"]["backgroundcolor"] = "orange";
            $_SESSION["alert"]["color"] = "white";
            $_SESSION["alert"]["message"] = "Delete succesvol";

        }
        else
        {
            foreach ($_POST as $key => $value)
            {
                if($key != "sport_ID" && $value == "" || $key == "aantalPlaatsen" && $value <= "0")
                {
                    $_SESSION["alert"]["backgroundcolor"] = "red";
                    $_SESSION["alert"]["color"] = "white";
                    $_SESSION["alert"]["message"] = "De gegevens zijn niet goed ingevuld";

                    header("location: index.php?path=users&page=userlist");
                    die();
                }
            }

            $arrayvalues = array();
            $arrayvalues['sportNaam']           = $_POST['sportNaam'];
            $arrayvalues['aantalPlaatsen']      = $_POST['aantalPlaatsen'];
            $arrayvalues['status']              = $_POST['Status'];
            $arrayvalues['gebruikersID']        = $_POST['cordinator'];

            if($_POST['sport_ID'] != "")
            {
                fupdateobject("sporten", $arrayvalues, " Where sport_ID = '".$_POST['sport_ID']."'");

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "De sport is succesvol bijgewerkt";
            }
            else
            {
                finsertobject("sporten", $arrayvalues);

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "De sport is succesvol aangemaakt";
            }
        }
    }

    header("location: index.php?path=users&page=userlist");
    die();
}
?>
<div class="text-center mt-5" style="margin: 10%">
    <h1>Gebruikers</h1>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Gebruikersnaam</th>
        <th>Rechten</th>
        <th>Eind datum</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $users = array();
    $users = fgetobject('users', 'statusID', '1', " OR statusID = '0'");
    foreach ($users as $user)
    {

        $role = fgetobject("roles", "roleID", $user["roleID"]);
        $selectedrole = $role->fetch(PDO::FETCH_ASSOC);

        ?>
        <tr>
            <td><?=$user['username'];?></td>
            <td><?=$selectedrole['name'];?></td>
            <td><?= $user["enddate"];?></td>
            <td></td>
            <td>
                <?php
                if($_SESSION['roleID'] == "1")
                 {
                 ?>
                 <form action="index.php?path=users&page=userlist" method="POST">
                     <input type="hidden" name="button" value="delete">
                     <input type="hidden" name="userID" value="<?=$user['userID'];?>">
                     <button type="submit" <?php if($user["userID"] == "1"){ echo "disabled";} ?> class="btn btn-primary float-right ml-1 mr-1">
                         Verwijderen
                     </button>
                 </form>
                 <form action="index.php?path=users&page=userlist" method="POST">
                     <input type="hidden" name="button" value="edit">
                     <input type="hidden" name="userID" value="<?=$user['userID'];?>">
                     <button type="submit" <?php if($user["userID"] == "1"){ echo "disabled";} ?> class="btn btn-primary float-right ml-1 mr-1">
                         Bewerken
                     </button>
                 </form>
                 <?php
                 }
                
                 ?>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>


<?php
if($_SESSION['roleID'] == "1")
{
?>
<!-- Button trigger modal -->
<form action="index.php?path=users&page=userlist" method="POST">
    <input type="hidden" name="button" value="edit">
    <input type="hidden" name="userID" value="-1">
    <button type="submit" class="btn btn-primary">
        Toevoegen
    </button>
</form>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php
            if ($_SESSION["selected_ID"] >= 0 && $_SESSION["selected_ID"] != "")
            {
                $selected = fgetobject('sporten', 'sport_ID', $_SESSION["selected_ID"]);
                $selected = $selected->fetch(PDO::FETCH_ASSOC);

                $type = "bijwerken";

                $ID = '';
                $status = '';
                $sportNaam = '';
                $aantalPlaatsen = '';
                $gebruikersID = '';

                $ID = $selected['sport_ID'];
                $status = $selected['status'];
                $sportNaam = $selected['sportNaam'];
                $aantalPlaatsen = $selected['aantalPlaatsen'];
                $gebruikersID = $selected['gebruikersID'];

                echo "<script type='text/javascript'>
                            $(document).ready(function(){
                            $('#Modal').modal('show');
                            });
                            </script>";
                $_SESSION["selected_ID"] = "";
            }
            elseif($_SESSION["selected_ID"] == -1)
            {
                $type = "aanmaken";

                $ID = '';
                $status = '';
                $sportNaam = '';
                $aantalPlaatsen = '';
                $gebruikersID = '';

                echo "<script type='text/javascript'>
                            $(document).ready(function(){
                            $('#Modal').modal('show');
                            });
                            </script>";
                $_SESSION["selected_ID"] = "";
            }
            ?>
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Sport <?= $type ?></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="index.php?path=content&page=lijst">
                    <input type="hidden" name="sport_ID" id="ID" value="<?= $ID ?>"/>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Status</label>
                        <div class="col-md-6">
                            <?php
                            $open = "";
                            $gesloten = "";
                            if($status == 1 || $status == "")
                            {
                                $open = "checked";
                            }
                            elseif($status == 0)
                            {
                                $gesloten = "checked";
                            }
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" <?= $open ?> required type="radio" name="Status" id="Radios1" value="1">
                                <label class="form-check-label" for="Radios1">
                                    Open
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" <?= $gesloten ?> required type="radio" name="Status" id="Radios2" value="0">
                                <label class="form-check-label" for="Radios2">
                                    Gesloten
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Sportnaam</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" required class="form-control" name="sportNaam" value="<?= $sportNaam ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Max aantal plaatsen</label>
                        <div class="col-md-6">
                            <input type="number" id="aantalPlaatsen" required class="form-control" name="aantalPlaatsen" value="<?= $aantalPlaatsen ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Cordinator</label>
                        <div class="col-md-6">
                            <select class="form-select" required name="cordinator">
                                <option></option>
                                <?php
                                $docenten = array();
                                $docenten = fgetobject('gebruikers', 'rechten_ID', '10', ' OR rechten_ID = -1');
                                foreach ($docenten as $docent)
                                {
                                    $selectedDocent = "";
                                    if($gebruikersID == $docent['gebruikersID'])
                                    {
                                        $selectedDocent = "selected";
                                    }
                                    echo "<option ".$selectedDocent." value='".$docent['gebruikersID']."'>".$docent['voornaam']." ".$docent['tussenvoegsel']." ".$docent['achternaam']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-4">
                        <button id="btn-registeren" type="submit" class="btn btn-primary">
                            <?= ucfirst($type); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>