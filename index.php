<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL</title>
</head>
<body>
</body>
<?php

include('db\connect.php');

if(array_key_exists('q', $_GET)) {
    $module = $_GET['q'];
} else {
    //default
    $module = 'topic';
}

//path to module
$dir_module = 'source/'.$module.'.php';

if(file_exists($dir_module)) {
    ob_start();
    include($dir_module);
    $content= ob_get_contents();
    ob_clean();
    include('layouts/admin.php');
} else {
    header("HTTP/1.1 404 Not Found");
    echo '404';
}
 