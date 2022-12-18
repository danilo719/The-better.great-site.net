<?php
if(isset($_SESSION['ingelogd']))
{
    $menuitems = array();
    //$menuitems["sporten"] = "index.php?path=content&page=lijst";

?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php?"></a>
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
            <li><a href="index.php?path=settings&page=profiel">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg> Instellingen</a>
            </li>
            <li><a href="index.php?page=uitloggen"><span class="glyphicon glyphicon-log-in"></span> Uitloggen</a></li>
        </ul>
    </div>
</nav>
<?php
}
?>