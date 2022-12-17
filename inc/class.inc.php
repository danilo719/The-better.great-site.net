<?php

function finsertobject($table, $arrayValues)
{
    include "SQL/connection.php";

    $placeholders = [];
    $query = "INSERT INTO ".$table." (";
    $values = "VALUES (";
    foreach($arrayValues as $key => $value)
    {
        $query .= $key.", ";
        $values .= ":".$key.", ";

        $placeholders += [':'.$key => $value];
    }

    $query = substr($query, 0, -2);
    $values = substr($values, 0, -2);


    $values.= ")";
    $query .= ") ".$values;

    $result = $PDO->prepare($query);
    $result->execute($placeholders);

    return $result;
}

function fgetobject($table, $field, $key, $addon = "")
{
    include "SQL/connection.php";

    $query = "SELECT * FROM ".$table." WHERE ".$field." = '".$key."' ";

    if($addon != "")
    {
        $query .= $addon;
    }

    $results = $PDO->prepare($query);
    $results->execute();

    return $results;
//    $var->fetch(PDO::FETCH_ASSOC);
}

function fupdateobject($table, $arrayValues, $addon)
{
    include "SQL/connection.php";


    $query = "UPDATE ".$table." SET ";
    foreach($arrayValues as $key => $value)
    {
        $query .= $key." = '".$value."', ";

    }

    $query = substr($query, 0, -2);
    $query .= $addon;

    echo $query;
    $result = $PDO->prepare($query);
    $result->execute();

    return;
}

function fdeleteobject($table, $field, $key, $addon = "")
{
    include "SQL/connection.php";

    $query = "DELETE FROM ".$table." WHERE ".$field." = '".$key."' ";

    if($addon != "")
    {
        $query .= $addon;
    }

    $results = $PDO->prepare($query);
    $results->execute();

    return;
}