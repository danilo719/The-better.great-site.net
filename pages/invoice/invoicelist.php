<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_SESSION['roleID'] == "1")
    {
        
        if($_POST['button'] == "edit")
        {
            $_SESSION["selected_ID"] = $_POST['ID'];
            
        }
        elseif($_POST['button'] == "delete" && $_POST['ID'] != "")
        {
            fdeleteobject("company", "companyID", $_POST['ID']);

            $_SESSION["alert"]["backgroundcolor"] = "orange";
            $_SESSION["alert"]["color"] = "white";
            $_SESSION["alert"]["message"] = "Delete succesvol";

        }
        else
        {
            
            foreach ($_POST as $key => $value)
            {
                if($key != "ID" && $value == "")
                {
                    $_SESSION["alert"]["backgroundcolor"] = "red";
                    $_SESSION["alert"]["color"] = "white";
                    $_SESSION["alert"]["message"] = "De gegevens zijn niet goed ingevuld";

                    header("location: index.php?path=company&page=companylist");
                    die();
                }
            }

            $arrayvalues = array();
            $arrayvalues['name']            = $_POST['name'];
            $arrayvalues['street']          = $_POST['street'];
            $arrayvalues['zipcode']         = $_POST['zipcode'];
            $arrayvalues['city']            = $_POST['city'];
            $arrayvalues['country']         = $_POST['country'];
            $arrayvalues['phonenumber']     = $_POST['phonenumber'];
            $arrayvalues['email']           = $_POST['email'];
            
            if($_POST['ID'] != "")
            {
                $check = fgetobject("company", "name", $_POST['name'], " and companyID != ".$_POST['ID']);
                $selected = $check->fetch(PDO::FETCH_ASSOC);
                
                if($selected)
                {
                    $_SESSION["alert"]["backgroundcolor"] = "red";
                    $_SESSION["alert"]["color"] = "white";
                    $_SESSION["alert"]["message"] = "Helaas de naam bestaat al.";
    
                    header("location: index.php?path=company&page=companylist");
                    die();
                }

                fupdateobject("company", $arrayvalues, " Where companyID = ".$_POST['ID']);

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "De bebrijf is succesvol bijgewerkt";
            }
            else
            {
                
                $check = fgetobject("company", "name", $_POST['name']);
                $selected = $check->fetch(PDO::FETCH_ASSOC);
                
                if($selected)
                {
                    $_SESSION["alert"]["backgroundcolor"] = "red";
                    $_SESSION["alert"]["color"] = "white";
                    $_SESSION["alert"]["message"] = "Helaas het bebrijf bestaat al.";
    
                    header("location: index.php?path=company&page=companylist");
                    die();
                }

                finsertobject("company", $arrayvalues);

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "De bebrijf is succesvol aangemaakt";
            }
        }
    }

    header("location: index.php?path=company&page=companylist");
    die();
}
?>
<div class="wrapper bg-white mt-sm-5 mb-5">
    <h1 class="pb-4 border-bottom">Facurenlijst</h1>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th></th>
        <th>Adres</th>
        <th>Telefoonnummer</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $companys = array();
    $companys = fgetobject('company', 'companyID', '0', " OR companyID != '0'");
    foreach ($companys as $company)
    {
        ?>
        <tr>
            <td><?=$company['name'];?></td>
            <td><?=$company['street']." ".$company['city'].", ".$company['country']." ".$company['zipcode']?></td>
            <td><?= $company["phonenumber"];?></td>
            <td></td>
            <td>
                <?php
                if($_SESSION['roleID'] == "1")
                 {
                 ?>
                 <form action="index.php?path=company&page=companylist" method="POST">
                     <input type="hidden" name="button" value="delete">
                     <input type="hidden" name="ID" value="<?=$company['companyID'];?>">
                     <button type="submit" class="btn btn-primary float-right ml-1 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                     </button>
                 </form>
                 <form action="index.php?path=company&page=companylist" method="POST">
                     <input type="hidden" name="button" value="edit">
                     <input type="hidden" name="ID" value="<?=$company['companyID'];?>">
                     <button type="submit" class="btn btn-primary float-right ml-1 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
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
<form action="index.php?path=company&page=companylist" method="POST">
    <input type="hidden" name="button" value="edit">
    <input type="hidden" name="ID" value="-1">
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
                $selected = fgetobject('company', 'companyID', $_SESSION["selected_ID"]);
                $selected = $selected->fetch(PDO::FETCH_ASSOC);

                $type = "bijwerken";

                $ID = '';
                $name = '';
                $street = '';
                $city = '';
                $country = '';
                $zipcode = '';
                $email = '';
                $phonenumber = '';

                $ID =           $selected['companyID'];
                $name =         $selected['name'];
                $street =       $selected['street'];
                $city =         $selected['city'];
                $country =      $selected['country'];
                $zipcode =      $selected['zipcode'];
                $email =        $selected['email'];
                $phonenumber =  $selected['phonenumber'];

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
                $name = '';
                $street = '';
                $city = '';
                $country = '';
                $zipcode = '';
                $email = '';
                $phonenumber = '';

                echo "<script type='text/javascript'>
                            $(document).ready(function(){
                            $('#Modal').modal('show');
                            });
                            </script>";
                $_SESSION["selected_ID"] = "";
            }
            ?>
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Bedrijf <?= $type ?></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="index.php?path=company&page=companylist">
                    <input type="hidden" name="ID" id="ID" value="<?= $ID ?>"/>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Bedrijfsnaam</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" required class="form-control" name="name" value="<?= $name ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" class="form-control" name="email" value="<?= $email ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Telefoonnummer</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" required class="form-control" name="phonenumber" value="<?= $phonenumber ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Straat + huisnummer</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" placeholder="straat 1" required class="form-control" name="street" value="<?= $street ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Stad</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" required class="form-control" name="city" value="<?= $city ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Land</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" required class="form-control" name="country" value="<?= $country ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Postcode</label>
                        <div class="col-md-6">
                            <input type="text" id="sportNaam" required class="form-control" name="zipcode" value="<?= $zipcode ?>" autofocus>
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