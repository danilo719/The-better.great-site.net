<?php
$menuitems = array();
$menuitems = fgetobject("menuitems", "statusID", "1", " ORDER BY weight");

foreach($menuitems as $menuitem){
  $menuitem_user = fgetobject("userid_menuitemid", "userID", $_SESSION["userID"], " and menuitemID = '".$menuitem["menuitemID"]."'");
  $selected = $menuitem_user->fetch(PDO::FETCH_ASSOC);

  if($selected["userID"] != "" || $_SESSION["roleID"] == "1"){

    ?>

  
  <div class="card">
    <a href="index.php?path=<?= $menuitem["path"] ?>&page=<?= $menuitem["homepage"] ?>">
    <?= $menuitem["icon"] ?>
      <div class="card-body">
      <p class="card-text" style="text-align: center;"><?= $menuitem["name"] ?></p>
      </div>
    </a>
  </div>   


  <?php

  }
  

}