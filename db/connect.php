<?php
$dbhost='localhost';
$dbname='forum';
$dbuser='root';
$dbpassword='';

try
{
$db_connect= new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpassword);
$db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db_connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
}
catch(PDOException $db_error)
{
    echo "Błąd połączenia z bazą danych </br>". $db_error;
}