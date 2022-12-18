<?php
$menuitemsIDs = array();
$menuitemsIDs = fgetobject("userid_menuitemid", "userID", $_SESSION["userID"]);

foreach($menuitemsIDs as $selectedmenuitemID){
  
  $menuitems = array();
  $menuitems = fgetobject("menuitems", "menuitemID", $selectedmenuitemID["menuitemID"], " ORDER BY weight ASC");
  $selectedmenuitems = $menuitems->fetch(PDO::FETCH_ASSOC);
  ?>

  
  <div class="card" style="width: 15%; margin-top: 10%; border-width: 0px;">
    <a href="index.php?path=<?= $selectedmenuitems["path"] ?>&page=<?= $selectedmenuitems["homepage"] ?>">
      <?= $selectedmenuitems["icon"] ?>
      <div class="card-body">
      <p class="card-text" style="text-align: center; font-size: 20px"><?= $selectedmenuitems["name"] ?></p>
      </div>
    </a>
  </div>   


  <?php
}
?>



