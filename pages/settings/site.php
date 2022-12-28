<div class="wrapper bg-white mb-5" style="margin-top: 15%;">
    <h1 class="pb-4 border-bottom">Site Instellingen</h1>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Icon</th>
            <th>Naam</th>
            <th>Gewicht</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $menuitems = array();
        $menuitems = fgetobject('menuitems', 'statusID', '1');
        foreach ($menuitems as $menuitem) {
        ?>
            <tr>
                <td style="width: 5%;"><?= $menuitem['icon']; ?></td>
                <td><?= $menuitem['name']; ?></td>
                <td><?= $menuitem['weight']; ?></td>
                <td></td>
                <td>
                    <?php
                    if ($_SESSION['roleID'] == "1") {
                    ?>
                        <form action="index.php?path=settings&page=siteEdit" method="POST">
                            <input type="hidden" name="button" value="delete">
                            <input type="hidden" name="menuitemID" value="<?= $menuitem['menuitemID']; ?>">
                            <button type="submit" class="btn btn-primary float-right ml-1 mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </form>
                        <form action="index.php?path=settings&page=siteEdit" method="POST">
                            <input type="hidden" name="button" value="edit">
                            <input type="hidden" name="menuitemID" value="<?= $menuitem['menuitemID']; ?>">
                            <button type="submit" class="btn btn-primary float-right ml-1 mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
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
if ($_SESSION['roleID'] == "1") {
?>
    <form action="index.php?path=settings&page=siteEdit" method="POST">
        <input type="hidden" name="button" value="edit">
        <input type="hidden" name="menuitemID" value="-1">
        <button type="submit" class="btn btn-primary">
            Toevoegen
        </button>
    </form>
    <form style="float: right; margin-bottom: 20%" action="index.php?path=settings&page=account" method="POST">
        <?php
        $site = fgetobject('site', 'siteID', "1");
        $selectedsite = $site->fetch(PDO::FETCH_ASSOC);

        if ($selectedsite["statusID"] == "1" && $_SESSION["roleID"] == "1") {
            echo '<button type="submit" class="btn btn-danger mr-3">Zet site op onderhoud!</button>';
        } elseif ($selectedsite["statusID"] == "2" && $_SESSION["roleID"] == "1") {
            echo '<button type="submit" class="btn btn-danger mr-3">Zet site online!</button>';
        }
        ?>
        <input name="siteStatus" hidden value="<?= $selectedsite["statusID"] ?>">
    </form>
<?php
} 
?>