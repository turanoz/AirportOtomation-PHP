<?php
header('Content-Type: text/html; charset=utf-8');
$dbhost = 'localhost';
$dbuser = 'siltasel_engin';
$dbpass = 'engin1234';
$dbname = 'siltasel_havayolu';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);


//Listele Havalimanı
if (isset($_POST['listeleHavalimani']))
{
    $listeleHavalimani = $baglan->query("select ulkeler.ulkeAdi , havalimani.sehirAdi, havalimani.havaAlaniAdi,havalimani.havalimaniKodu from havalimani,ulkeler where ulkeler.ulkeKodu=havalimani.ulkeKodu");
    $listeleHavalimani->execute();
    $result = array();
    while ($row = $listeleHavalimani->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("uA"=>$row["ulkeAdi"],"hK"=>$row["havalimaniKodu"],"hA"=>$row["havaAlaniAdi"],"sA"=>$row["sehirAdi"]);
    }
    echo json_encode($result);
}
//Listele Ülke
if (isset($_POST['listeleUlkeHavalimani']))
{

    $listeleUlkeHavalimani = $baglan->query("SELECT ulkeAdi,ulkeKodu FROM ulkeler");
    $listeleUlkeHavalimani->execute();
    $result = array();
    while ($row = $listeleUlkeHavalimani->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array($row);
    }
    echo json_encode($result);
}
//Ekle
if (isset($_POST['ekleHavalimani'])) {
    $iHLUlke = $_POST['iHLUlke'];
    $iHLAdi = $_POST['iHLAdi'];
    $iHLSehir = $_POST['iHLSehir'];
    $iHLKodu = $_POST['iHLKodu'];
    $insertHavalimani = $baglan->query("insert into havalimani values('$iHLUlke','$iHLKodu','$iHLSehir','$iHLAdi')");
    if ($insertHavalimani) {
        echo "Havalimanı başarılı bir şekilde eklendi";

    } else {
        echo " Hata !!";
    }

}
//Güncelle
if (isset($_POST['guncelleHavalimani'])) {
    $eHLUlke = $_POST['eHLUlke'];
    $eHLAdi = $_POST['eHLAdi'];
    $eHLSehir = $_POST['eHLSehir'];
    $eHLKodu = $_POST['eHLKodu'];
    $updateHL = $db->query("update havalimani set ulkeKodu=(select ulkeKodu from ulkeler where ulkeAdi='$eHLUlke'),havalimaniKodu='$eHLKodu',sehirAdi='$eHLSehir',havaAlaniAdi='$eHLAdi' where havalimaniKodu='$eHLKodu'");
    if ($updateHL) {
        echo "Başarılı bir şekilde güncellendi";
    } else {
        echo " Hata !!";
    }
}
//Sil
if (isset($_POST['silHavalimani'])) {
    $silHavalimani = $db->query("DELETE FROM havalimani WHERE havalimaniKodu='{$_POST['dHLKod']}'");
    if ($silHavalimani) {
        echo "Havalimanı başarılı bir şekilde silindi";
    } else {
        echo " Hata !!";
    }
}
//Ülke Ekle
if (isset($_POST['ekleUlkeHavalimani'])) {
    $iUlkeAdi = $_POST['iUlkeAdi'];
    $iUlkeKodu = $_POST['iUlkeKodu'];
    $iUlkeQuery = $db->query("insert into ulkeler values('$iUlkeKodu','$iUlkeAdi')");
    if ($iUlkeQuery) {
        echo "Eklendi";
    } else {
        echo " Hata !!";
    }
}

?>