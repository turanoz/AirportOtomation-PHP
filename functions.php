<?php
function controller($controllerName)
{
    $controllerName = strtolower($controllerName);
    return PATH.'/controller/'.$controllerName.'.php';
}
function view($viewName)
{
    $viewName = strtolower($viewName);
    return PATH.'/view/'.$viewName.'.php';
}
function seflink($text)
{
    $text = mb_strtolower($text,"UTF-8");
    $text = str_replace(
        ['ı','ğ','ü','ç','ö','ş'],
        ['i','g','u','c','o','s'],
        $text
    );
    $text = preg_replace('@[^a-z0-9]@','-',$text);
    return $text;
}
function tarihFormat($tarih)
{
    $tarih = substr($tarih,0,16);
    $tarih = explode(" ",$tarih);
    $tarihm = explode("-",$tarih[0]);
    $tariha = $tarihm[2].".".$tarihm[1].".".$tarihm[0];
    $saat = $tarih[1];
    return $tariha." ".$saat;
}


?>