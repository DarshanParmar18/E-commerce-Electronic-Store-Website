<?php
$db_name = "mysql:host=localhost;dbname=shop_db";
$db_user = "root";
$db_password = "";


$conn = new PDO($db_name, $db_user, $db_password);



function unique_id()
{
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charsLength = strlen($chars);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $chars[mt_rand(0, $charsLength - 1)];
    }
    return $randomString;
}
