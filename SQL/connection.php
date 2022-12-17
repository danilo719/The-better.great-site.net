<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website";


try{
    // Connection
    $conn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
    $PDO = new PDO($conn, $username,$password);

    // Error Mode
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>