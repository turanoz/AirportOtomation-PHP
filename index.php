<?php
session_start();
ob_start();
$config = require 'config.php';
require 'functions.php';
try {$baglan = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['database'].';charset=utf8', $config['db']['username'], $config['db']['password']);}
catch(PDOException $e) { echo $e->getMessage(); }
function autoLoadClasses($className)
{
    $classFile = __DIR__.'/classes/'. strtolower($className).'.php';
    require $classFile;
}
spl_autoload_register('autoLoadClasses');
$url = explode('/',$_SERVER['REQUEST_URI']);
unset($url[0]);
$url = array_values($url);
if(isset($url[0]) && $url[0] == trim(""))
{
    $url[0] = 'index';
}
if(file_exists(controller($url[0])))
{
    require controller($url[0]);
}
else
{
    if($_GET && !isset($_SESSION['user']))
    {
        require controller('index');
    }
    else
    {
        if($_GET)
        {
            require controller('admin');
        }
        else
        {
            require controller('404');
        }

    }
}

?>