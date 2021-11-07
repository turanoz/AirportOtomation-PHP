<?php
header('Content-Type: text/html; charset=utf-8');
$dbhost = 'localhost';
$dbuser = 'siltasel_engin';
$dbpass = 'engin1234';
$dbname = 'siltasel_havayolu';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_POST['listeleHavayolu']))
{
    $listeleHavayolu = $baglan->query("SELECT * FROM firmalar ORDER BY firmaNo ASC");
    $listeleHavayolu->execute();
    $result = array();
    while ($row = $listeleHavayolu->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("no"=>$row["firmaNo"],"fA"=>$row["firmaAdi"],"fT"=>$row["firmaTel"],"fB"=>$row["firmaBiletSatisWeb"]);
    }
    echo json_encode($result);
}
if (isset($_POST['ekleHavayolu'])) {
    $iHAdi = $_POST['iHAdi'];
    $iHTel = $_POST['iHTel'];
    $iHBiletSatisWeb = $_POST['iHBiletSatisWeb'];
    $insertHavayoluQuery = $db->query("insert into firmalar(firmaAdi,firmaTel,firmaBiletSatisWeb) values ('$iHAdi','$iHTel','$iHBiletSatisWeb')");
    if ($insertHavayoluQuery) {
        echo "Başarılı bir şekilde eklendi";

    } else {
        echo " Hata !!";
    }

}
if (isset($_POST['guncelleHavayolu'])) {
    $eHNo = $_POST['eHNo'];
    $eHAdi = $_POST['eHAdi'];
    $eHTel = $_POST['eHTel'];
    $eBiletSatis = $_POST['eBiletSatis'];
    $updateQuery = $db->query("update firmalar set firmaAdi='$eHAdi',firmaTel='$eHTel',firmaBiletSatisWeb='$eBiletSatis' where firmaNo='$eHNo'");
    if ($updateQuery) {
        echo "Başarılı bir şekilde güncellendi";
    } else {
        echo " Hata !!";
    }
}
if (isset($_POST['silHavayolu'])) {
    $deleteFirmaQuery = $db->query("DELETE FROM firmalar WHERE firmaNo='{$_POST['firmaNo']}'");
    if ($deleteFirmaQuery) {
        echo "Başarılı bir şekilde silindi";
    } else {
        echo " Hata !!";
    }
}

?>