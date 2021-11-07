<?php
header('Content-Type: text/html; charset=utf-8');
$dbhost = 'localhost';
$dbuser = 'siltasel_engin';
$dbpass = 'engin1234';
$dbname = 'siltasel_havayolu';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_POST['selectHavalimani']))
{
    $hNo= $_POST['havayoluNo'];
    $selectHavalimani = $baglan->query("select havalimani.havalimaniKodu,havalimani.havaAlaniAdi from havalimani where havalimani.havalimaniKodu not in (SELECT havalimani.havalimaniKodu FROM havalimani,firmaHavalimani where firmaHavalimani.havalimaniKodu = havalimani.havalimaniKodu and firmaHavalimani.firmaNo='$hNo')");
    $selectHavalimani->execute();
    $result = array();
    while ($row = $selectHavalimani->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array($row);
    }
    echo json_encode($result);
}


if (isset($_POST['listeleHavayoluHavalimani']))
{
        $hNo= $_POST['havayoluNo'];
        $listeleHavayoluHavalimani = $baglan->query("SELECT havalimani.havalimaniKodu,havalimani.havaAlaniAdi FROM havalimani,firmaHavalimani where firmaHavalimani.havalimaniKodu=havalimani.havalimaniKodu and firmaHavalimani.firmaNo='$hNo'");
        $listeleHavayoluHavalimani->execute();
        $result = array();
        while ($row = $listeleHavayoluHavalimani->fetch(PDO::FETCH_ASSOC)) {
            $result[] = array($row);
        }
        echo json_encode($result);
}
if (isset($_POST['silHH'])) {
    $no= $_POST['no'];
    $kod= $_POST['kod'];
    $deleteHHQuery = $db->query("DELETE FROM firmaHavalimani WHERE havalimaniKodu='$kod' and  firmaNo='$no' limit 1");
    if ($deleteHHQuery) {
        echo "Başarılı bir şekilde silindi";
    } else {
        echo " Hata !!";
    }
}
if (isset($_POST['ekleHH'])) {
    $no= $_POST['no'];
    $kod= $_POST['kod'];
    $insertHHQuery = $db->query("insert into firmaHavalimani values('$kod','$no')");
    if ($insertHHQuery) {
        echo "Başarılı bir şekilde eklendi";
    } else {
        echo " Hata !!";
    }
}
?>