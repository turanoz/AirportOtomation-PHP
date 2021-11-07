<?php
header('Content-Type: text/html; charset=utf-8');
$dbhost = 'localhost';
$dbuser = 'siltasel_engin';
$dbpass = 'engin1234';
$dbname = 'siltasel_havayolu';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);


if (isset($_POST['listeleCalisanlar']))
{
    $listeleCalisanlar = $baglan->query("select calisanlar.sicilNo,calisan_kategori.adi as 'kadi',calisanlar.tcNo,calisanlar.adi,calisanlar.soyadi,calisanlar.telNo from calisanlar,calisan_kategori where calisanlar.kategori_id=calisan_kategori.id order by sicilNo asc");
    $listeleCalisanlar->execute();
    $result = array();
    while ($row = $listeleCalisanlar->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("sNo"=>$row["sicilNo"],"kA"=>$row["kadi"],"TC"=>$row["tcNo"],"adi"=>$row["adi"],"sAdi"=>$row["soyadi"],"tNo"=>$row["telNo"],);
    }
    echo json_encode($result);
}
if (isset($_POST['listeleCalisanlarKategori']))
{
    $listeleCalisanlarKategori = $baglan->query("SELECT id,adi FROM calisan_kategori");
    $listeleCalisanlarKategori->execute();
    $result = array();
    while ($row = $listeleCalisanlarKategori->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array($row);
    }
    echo json_encode($result);
}
if (isset($_POST['ekleCalisanlar'])) {
    $iCAdi = $_POST['iCAdi'];
    $iCTc = $_POST['iCTc'];
    $iCSoyadi = $_POST['iCSoyadi'];
    $iCKategori = $_POST['iCKategori'];
    $iCTel = $_POST['iCTel'];
    $insertCalisan = $baglan->query("insert into calisanlar(kategori_id,tcNo,adi,soyadi,telNo) values('$iCKategori','$iCTc','$iCAdi','$iCSoyadi','$iCTel')");
    if ($insertCalisan) {
        echo "Çalışan başarılı bir şekilde eklendi";

    } else {
        echo " Hata !!";
    }
}
if (isset($_POST['guncelleCalisanlar'])) {
    $eCSicil = $_POST['eCSicil'];
    $eCAdi = $_POST['eCAdi'];
    $eCTc = $_POST['eCTc'];
    $eCSoyadi = $_POST['eCSoyadi'];
    $eCKategori = $_POST['eCKategori'];
    $eCTel = $_POST['eCTel'];
    $updatecalisan = $db->query("update calisanlar set sicilNo='$eCSicil',kategori_id='$eCKategori',tcNo='$eCTc',adi='$eCAdi',soyadi='$eCSoyadi',telNo='$eCTel' where sicilNo='$eCSicil'");
    if ($updatecalisan) {
        echo "Çalışan bilgileri başarılı bir şekilde güncellendi";
    } else {
        echo " Hata !!";
    }
}
if (isset($_POST['silCalisanlar'])) {
    $deletecalisan = $db->query("DELETE FROM calisanlar WHERE sicilNo='{$_POST['sicilNo']}'");
    if ($deletecalisan) {
        echo "Çalışan başarılı bir şekilde silindi";
    } else {
        echo " Hata !!";
    }
}
if (isset($_POST['ekleMeslekCalisanlar'])) {
    $iMAdi = $_POST['iMAdi'];
    $insertMeslek = $db->query("insert into calisan_kategori(adi) values('$iMAdi')");
    if ($insertMeslek) {
        echo "Meslek başarılı bir şekilde eklendi";
    } else {
        echo " Hata !!";
    }
}


?>