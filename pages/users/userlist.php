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
        elseif($_POST['userID'] != "1")
        {
            
            foreach ($_POST as $key => $value)
            {
                if($key != "userID" && $value == "" &&  $key != "password")
                {
                    $_SESSION["alert"]["backgroundcolor"] = "red";
                    $_SESSION["alert"]["color"] = "white";
                    $_SESSION["alert"]["message"] = "De gegevens zijn niet goed ingevuld";

                    header("location: index.php?path=users&page=userlist");
                    die();
                }
            }

            $arrayvalues = array();
            $arrayvalues['statusID']      = $_POST['statusID'];
            $arrayvalues['username']      = $_POST['username'];
            $arrayvalues['roleID']        = $_POST['roleID'];
            $arrayvalues['enddate']       = $_POST['enddate'];

            if($_POST['password'] != "")
            {
                $arrayvalues['password']      = password_hash($_POST['password'],PASSWORD_DEFAULT); //password_verify($plaintext_password, $hash);
            }
            
            if($_POST['userID'] != "")
            {
                $check = fgetobject("users", "username", $_POST['username'], " and userID != ".$_POST['userID']);
                $selected = $check->fetch(PDO::FETCH_ASSOC);
                
                if($selected)
                {
                    $_SESSION["alert"]["backgroundcolor"] = "red";
                    $_SESSION["alert"]["color"] = "white";
                    $_SESSION["alert"]["message"] = "Helaas de naam bestaat al.";
    
                    header("location: index.php?path=users&page=userlist");
                    die();
                }

                fupdateobject("users", $arrayvalues, " Where userID = '".$_POST['userID']."'");

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "De gebruiker is succesvol bijgewerkt";
            }
            else
            {
                $check = fgetobject("users", "username", $_POST['username']);
                $selected = $check->fetch(PDO::FETCH_ASSOC);
                
                if($selected)
                {
                    $_SESSION["alert"]["backgroundcolor"] = "red";
                    $_SESSION["alert"]["color"] = "white";
                    $_SESSION["alert"]["message"] = "Helaas de naam bestaat al.";
    
                    header("location: index.php?path=users&page=userlist");
                    die();
                }

                finsertobject("users", $arrayvalues);

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "De gebruiker is succesvol aangemaakt";
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                     </button>
                 </form>
                 <form action="index.php?path=users&page=userlist" method="POST">
                     <input type="hidden" name="button" value="edit">
                     <input type="hidden" name="userID" value="<?=$user['userID'];?>">
                     <button type="submit" <?php if($user["userID"] == "1"){ echo "disabled";} ?> class="btn btn-primary float-right ml-1 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                     </button>
                 </form>
                 <form action="index.php?path=users&page=usermenuitems" method="POST">
                     <input type="hidden" name="username" value="<?=$user['username'];?>">
                     <input type="hidden" name="userID" value="<?=$user['userID'];?>">
                     <button type="submit" <?php if($user["userID"] == "1"){ echo "disabled";} ?> class="btn btn-primary float-right ml-1 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-3-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1z"/>
                        </svg>
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
                $selected = fgetobject('users', 'userID', $_SESSION["selected_ID"]);
                $selected = $selected->fetch(PDO::FETCH_ASSOC);

                $type = "bijwerken";

                $ID = '';
                $username = '';
                $password = '';
                $roleID = '';
                $enddate = '';
                $statusID = '';

                $ID = $selected['userID'];
                $username = $selected['username'];
                $password = '';
                $roleID = $selected['roleID'];
                $enddate = $selected['enddate'];
                $statusID = $selected['statusID'];

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
                $username = '';
                $password = '';
                $roleID = '';
                $enddate = '';
                $statusID = '';

                echo "<script type='text/javascript'>
                            $(document).ready(function(){
                            $('#Modal').modal('show');
                            });
                            </script>";
                $_SESSION["selected_ID"] = "";
            }
            ?>
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Gebruiker <?= $type ?></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="index.php?path=users&page=userlist">
                    <input type="hidden" name="userID" id="ID" value="<?= $ID ?>"/>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Status</label>
                        <div class="col-md-6">
                            <?php
                            $active = "";
                            $inactive = "";
                            if($statusID == 1 || $statusID == "")
                            {
                                $active = "checked";
                            }
                            elseif($statusID == 0)
                            {
                                $inactive = "checked";
                            }
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" <?= $active ?> required type="radio" name="statusID" id="Radios1" value="1">
                                <label class="form-check-label" for="Radios1">
                                    Actief
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" <?= $inactive ?> required type="radio" name="statusID" id="Radios2" value="2">
                                <label class="form-check-label" for="Radios2">
                                    Inactief
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Gebruikersnaam</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" required class="form-control" name="username" value="<?= $username ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Wachtwoord</label>
                        <div class="col-md-6">
                            <input type="password" id="sportNaam" class="form-control" name="password" value="<?= $password ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Rechten</label>
                        <div class="col-md-6">
                            <select class="form-select" style="width: 100%; height: 100%;" required name="roleID">
                                <option></option>
                                <?php
                                $roles = array();
                                $roles = fgetobject('roles', 'roleID', '1', ' OR roleID != -1');
                                foreach ($roles as $role)
                                {
                                    $selectedrole = "";
                                    if($roleID == $role['roleID'])
                                    {
                                        $selectedrole = "selected";
                                    }
                                    echo "<option ".$selectedrole." value='".$role['roleID']."'>".$role['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Eind datum</label>
                        <div class="col-md-6">
                            <input type="date" id="sportNaam" required class="form-control" name="enddate" value="<?= $enddate ?>" autofocus>
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