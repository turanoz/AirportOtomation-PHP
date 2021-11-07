<?php

$dbhost = 'localhost';
$dbuser = 'siltasel_engin';
$dbpass = 'engin1234';
$dbname = 'siltasel_havayolu';
$db = new db($dbhost, $dbuser, $dbpass, $dbname);
setlocale(LC_ALL, 'tr_TR.UTF-8');

if (isset($_SESSION['user']) && isset($_SESSION['pass']))
{
    require view('admin');

} else {
    echo 'yetkisiz erişim';
}
?>