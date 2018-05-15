
<?php

// připojení k tabulce users
// později potřeba předělat do databaze.php
//pozn.: jedná se o soubor z testování

session_start();

$DB_host = "localhost";
$DB_user = "holanmic";
$DB_pass = "";
$DB_name = "holanmic";

try
{
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}


include_once 'class.user.php';
$user = new USER($DB_con);