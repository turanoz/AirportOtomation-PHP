<?php
header('Content-Type: text/html; charset=utf-8');
$dbhost = 'localhost';
$dbuser = 'siltasel_engin';
$dbpass = 'engin1234';
$dbname = 'siltasel_havayolu';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_POST['listeleUcuslar']))
{
    $listeleUcuslar = $baglan->query("SELECT distinct(ucuslar.ucusNo),firmalar.firmaAdi,ucuslar.planlanan,ucuslar.tahmini,ucuslar.kHavalimaniKodu,ucuslar.vHavalimaniKodu,kapilar.kapiAdi,durumlar.durumAdi FROM ucuslar,firmalar,kapilar,durumlar,havalimani WHERE ucuslar.kapiNo=kapilar.kapiNo AND ucuslar.firmaNo=firmalar.firmaNo AND ucuslar.durumNo=durumlar.durumNo ORDER BY ucuslar.planlanan desc ");
    $listeleUcuslar->execute();
    $result = array();
    while ($row = $listeleUcuslar->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("no"=>$row["ucusNo"],"fA"=>$row["firmaAdi"],"p"=>tarihFormat($row["planlanan"]),"t"=>tarihFormat($row["tahmini"]),"k"=>$row["kHavalimaniKodu"],"v"=>$row["vHavalimaniKodu"],"kA"=>$row["kapiAdi"],"d"=>$row["durumAdi"]);
    }
    echo json_encode($result);
}
if (isset($_POST['listeleKapiUcuslar']))
{

    $listeleKapiUcuslar = $baglan->query("SELECT kapiNo,kapiAdi FROM kapilar");
    $listeleKapiUcuslar->execute();
    $result = array();
    while ($row = $listeleKapiUcuslar->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array($row);
    }
    echo json_encode($result);
}
if (isset($_POST['listeleDurumUcuslar']))
{

    $listeleDurumUcuslar = $baglan->query("SELECT durumNo,durumAdi FROM durumlar");
    $listeleDurumUcuslar->execute();
    $result = array();
    while ($row = $listeleDurumUcuslar->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array($row);
    }
    echo json_encode($result);
}

if (isset($_POST['guncelleUcuslar'])) {
    //e= Edit
    $eUcusNo = $_POST['eUcusNo'];
    $eHavayolu = $_POST['eHavayolu'];
    $ePTarihSaat = $_POST['ePTarihSaat'];
    $eTTarihSaat = $_POST['eTTarihSaat'];
    $eKHavalimani = $_POST['eKHavalimani'];
    $eVHavalimani = $_POST['eVHavalimani'];
    $eKapi = $_POST['eKapi'];
    $eDurum = $_POST['eDurum'];
    if ($eKHavalimani != $eVHavalimani && ($eKHavalimani == "ETR" || $eVHavalimani == "ETR"))
    {
        $updateQuery = $db->query("UPDATE ucuslar  SET  firmaNo = '$eHavayolu',planlanan ='$ePTarihSaat' ,tahmini = '$eTTarihSaat',kHavalimaniKodu = '$eKHavalimani',vHavalimaniKodu = '$eVHavalimani',kapiNo ='$eKapi',durumNo = '$eDurum'  WHERE ucusNo = '$eUcusNo'");
        if ($updateQuery)
        {
            echo "Başarılı bir şekilde güncellendi";
        }
    }
    else
    {
        echo "Yanlış havalimanı seçimi !!";
    }
}
if (isset($_POST['ekleUcuslar'])) {
    //i= Insert
    $iUcusNo = $_POST['iUcusNo'];
    $iHavayolu = $_POST['iHavayolu'];
    $iPTarihSaat = $_POST['iPTarihSaat'];
    $iTTarihSaat = $_POST['iTTarihSaat'];
    $iKHavalimani = $_POST['iKHavalimani'];
    $iVHavalimani = $_POST['iVHavalimani'];
    $iKapi = $_POST['iKapi'];
    $iDurum = $_POST['iDurum'];

    if ($iKHavalimani != $iVHavalimani && ($iKHavalimani == "ETR" || $iVHavalimani == "ETR"))
    {
        $insertUcusQuery = $db->query("INSERT INTO ucuslar VALUES('$iUcusNo','$iHavayolu' ,'$iPTarihSaat','$iTTarihSaat','$iKHavalimani','$iVHavalimani','$iKapi','$iDurum')");
        if ($insertUcusQuery)
        {
            echo "Başarılı bir şekilde eklendi";
        }
    }
    else
    {
        echo "Yanlış havalimanı seçimi !!";
    }
}
if (isset($_POST['silUcuslar'])) {
    $deleteUcusQuery = $db->query("DELETE FROM ucuslar WHERE ucusNo='{$_POST['dUcusNo']}'");
    if ($deleteUcusQuery) {
        echo "Uçuş başarılı bir şekilde silindi";
    }
    else {
        echo " Hata !!";
    }
}

if (isset($_POST['listeleHHSelectUcuslar']))
{
    $hNo= $_POST['havayoluNo'];
    $listeleHHSelectUcuslar = $baglan->query("SELECT havalimani.havalimaniKodu,havalimani.havaAlaniAdi FROM havalimani,firmaHavalimani where firmaHavalimani.havalimaniKodu=havalimani.havalimaniKodu and firmaHavalimani.firmaNo='$hNo'");
    $listeleHHSelectUcuslar->execute();
    $result = array();
    while ($row = $listeleHHSelectUcuslar->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array($row);
    }
    echo json_encode($result);
}


?>