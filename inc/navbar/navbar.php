<?php
if(isset($_SESSION['ingelogd']))
{
    $menuitems = array();
    $menuitems["sporten"] = "index.php?path=content&page=lijst";

?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php?">Websitenaam</a>
        </div>
        <ul class="nav navbar-nav">
            <?php
            foreach($menuitems as $key => $value)
                {
                    $activate = "";
                    if($_GET['page'] == $key)
                    {
                        $activate = "active";
                    }

                    echo '<li class="'.$activate.'"><a href="'.$value.'">'.ucfirst($key).'</a></li>';
                }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?page=profiel"><span class="glyphicon glyphicon-user"></span>Profiel</a></li>
            <li><a href="index.php?page=uitloggen"><span class="glyphicon glyphicon-log-in"></span>uitloggen</a></li>
        </ul>
    </div>
</nav>
<?php
}
?>