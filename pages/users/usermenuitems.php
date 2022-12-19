<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST['userID'] != "1" && $_POST['type'] == "menuitems")
    {
        $activemenuitems = fgetobject("userid_menuitemid", "userID", $_POST["userID"]);
        foreach($activemenuitems as $activemenuitem)
        {

            fdeleteobject("userid_menuitemid", "userID", $_POST['userID'], "and menuitemID = ".$activemenuitem["menuitemID"]);

        }

        foreach($_POST as $key => $value)
        {
            if($key != "userID" && $key != "type")
            {

                $arrayvalues = array();
                $arrayvalues["userID"]          = $_POST["userID"];
                $arrayvalues["menuitemID"]      = $value;

                finsertobject("userid_menuitemid", $arrayvalues);
            }
        }
        $_SESSION["alert"]["backgroundcolor"] = "green";
        $_SESSION["alert"]["color"] = "white";
        $_SESSION["alert"]["message"] = "De nieuwe pagina's zijn zichbaar";

        header("location: index.php?path=users&page=userlist");
        die();
    }
}

$menuitems = fgetobject("menuitems", "statusID", "1", " order by weight");

?>

<div class="text-center mt-5" style="margin: 10%">
    <h1>Menu voor <?=$_POST['username'];?> </h1>
</div>

<form action="index.php?path=users&page=usermenuitems" method="POST">
    <input type="hidden" name="userID" value="<?= $_POST['userID']; ?>">
    <input type="hidden" name="type" value="menuitems">

    <?php
    foreach($menuitems as $menuitem)
    {
        $checked = "";

        $activemenuitem = fgetobject("userid_menuitemid", "userID", $_POST["userID"], " and menuitemID = ".$menuitem['menuitemID']);
        $activemenuitem = $activemenuitem->fetch(PDO::FETCH_ASSOC);

        if($activemenuitem["menuitemID"] != '')
        {
            $checked = "checked";
            
        }

        
    ?>

    <div class="form-check pl-0">
        <input id="stackedCheck1" name="<?=$menuitem['menuitemID'];?>" value="<?=$menuitem['menuitemID'];?>" class="form-check-input" type="checkbox" data-toggle="toggle" <?= $checked ?>>
        <label for="stackedCheck1" class="form-check-label"><?= $menuitem["name"] ;?></label>
    </div>

    <?php
    }
    ?>

    

    <a href="index.php?path=users&page=userlist" class="btn btn-primary float-right ml-1 mr-1">
        Stoppen
    </a>
    <button type="submit" <?php if ($_POST["userID"] == "1") {echo "disabled";} ?> class="btn btn-primary float-right ml-1 mr-1">
        Opslaan
    </button>
</form>
<script>$('#toggle-demo').bootstrapToggle('on')</script>