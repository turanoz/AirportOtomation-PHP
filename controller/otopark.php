<?php

$dbhost = 'localhost';
$dbuser = 'siltasel_engin';
$dbpass = 'engin1234';
$dbname = 'siltasel_havayolu';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_POST['kategoriListele'])){
    $otoparkKategoriListele = $baglan->query("select kategori_id,arac_turu from arac_kategori");
    $otoparkKategoriListele->execute();
    $result = array();
    while ($row = $otoparkKategoriListele->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("id"=>$row['kategori_id'],"arac_turu"=>$row['arac_turu']);
    }
    echo json_encode($result);
}


if (isset($_POST['otoparkGirisRaporListele']))
{
    $otoparkGirisRaporListele = $baglan->query("select otopark.id,arac_kategori.arac_turu,otopark.plk_no,otopark.tarih from otopark,arac_kategori where otopark.arac_turu=arac_kategori.kategori_id and otopark.yon=1 order by otopark.id desc");
    $otoparkGirisRaporListele->execute();
    $result = array();
    while ($row = $otoparkGirisRaporListele->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("id"=>$row['id'],"arac_turu"=>$row['arac_turu'],"plk_no"=>$row['plk_no'],"tarih"=>tarihFormat($row['tarih']),);
    }
    echo json_encode($result);
}

$arac_turu = $db->query("select kategori_id,arac_turu from arac_kategori")->fetchAll();
$otoparkYon = $db->query("select * from otopark_yon")->fetchAll();
$otoparkgiris = $baglan->query("CREATE TEMPORARY TABLE girisTarih select otopark_tahsilat.fisno,arac_kategori.arac_turu,otopark.tarih from otopark_tahsilat,otopark,arac_kategori where otopark_tahsilat.girisTarihSaat = otopark.id and otopark.arac_turu=arac_kategori.kategori_id");
$otoparkcikis = $baglan->query("CREATE TEMPORARY TABLE cikisTarih select otopark_tahsilat.fisno,otopark.tarih  from otopark_tahsilat,otopark where otopark_tahsilat.cikisTarihSaat = otopark.id");
if (isset($_POST['otoparkTahsilatRapor']))
{
    $otoparkTahsilatRapor = $baglan->query("SELECT distinct otopark_tahsilat.fisno, girisTarih.arac_turu, otopark_tahsilat.plaka, girisTarih.tarih as 'giris',cikisTarih.tarih as 'cikis',otopark_tahsilat.ucret FROM ((otopark_tahsilat INNER JOIN girisTarih ON otopark_tahsilat.fisno = girisTarih.fisno) INNER JOIN cikisTarih ON otopark_tahsilat.fisno = cikisTarih.fisno) order by cikisTarih.tarih desc ");
    $otoparkTahsilatRapor->execute();
    $result = array();
    while ($row = $otoparkTahsilatRapor->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("fisno"=>$row['fisno'],"arac_turu"=>$row['arac_turu'],"plaka"=>$row['plaka'],"giris"=>tarihFormat($row['giris']),"cikis"=>tarihFormat($row['cikis']),"ucret"=>$row['ucret']);
    }
    echo json_encode($result);
}
$otoparkReset = $baglan->query("drop table girisTarih,cikisTarih");
if (isset($_POST['otoparkTarih'])) {
    echo date("d.m.Y H:i");
}

if (isset($_POST['otoparkGirisYapanlarPlaka'])) {

    $otoparkGirisYapanlarPlaka = $db->query("select fisno,plaka from otopark,otopark_tahsilat where otopark_tahsilat.girisTarihSaat=otopark.id and isnull(cikisTarihSaat);")->fetchAll();
    foreach ($otoparkGirisYapanlarPlaka as $item) {
        echo "<option value=" . $item['plaka'] . ">" . $item['plaka'] . "</option>";
    }

}

if (isset($_POST['cikis'])) {
    $cikis = $_POST['cikis'];
    $giris = $_POST['giris'];
    $sonuc = new tarihfarki($cikis, $giris);
    echo round(($sonuc->gun * 24) + $sonuc->saat + ($sonuc->dakika / 100), 2);
}

if (isset($_POST['otoparkCikisTahsilat']))
{
    $plaka = $_POST['plaka'];
    $otoparkCikisTahsilat = $baglan->query("select fisno,plaka,otopark.arac_turu,otopark.tarih from otopark,otopark_tahsilat where otopark_tahsilat.girisTarihSaat=otopark.id and isnull(cikisTarihSaat) and plaka='{$plaka}' limit 1;");
    $otoparkCikisTahsilat->execute();
    $result = array();
    while ($row = $otoparkCikisTahsilat->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array("arac_turu"=>$row['arac_turu'],"tarih"=>tarihFormat($row['tarih']));
    }
    echo json_encode($result);
}


if (isset($_POST['kalinanSure'])) {
    $sure = $_POST['kalinanSure'];
    $arac_turu = $_POST['arac_turu'];
    $sureFiyatHesapla = $db->query("select fiyat from otopark_ucretleri where arac_turu='$arac_turu' and ( baslangic< '$sure' and  '$sure'<=bitis )")->fetchArray();
    echo $sureFiyatHesapla['fiyat'];
}

if (isset($_POST['otoparkGirisTahsilat'])) {
    $yonu = $_POST['otoparkGirisTahsilatyonu'];
    $plaka = $_POST['otoparkGirisTahsilatplaka'];
    $select_plaka = $_POST['otoparkGirisTahsilatselect_plaka'];
    $arac_turu = $_POST['otoparkGirisTahsilatarac_turu'];
    $cikis_tarihi = $_POST['otoparkGirisTahsilatcikis_tarihi'];
    $giris_tarihi = $_POST['otoparkGirisTahsilatgiris_tarihi'];
    $ucret = $_POST['otoparkGirisTahsilatucret'];

    if ($yonu == 1) {
        $insertOtoparkGiris = $baglan->query("insert into otopark(arac_turu,yon,plk_no,tarih) values ('$arac_turu','$yonu','$plaka','$cikis_tarihi');");
        $insertOtoparkTahsilatGiris = $baglan->query("insert into otopark_tahsilat(plaka,girisTarihSaat) values('$plaka',(select id from otopark where yon=1 and plk_no='$plaka' ORDER BY tarih desc limit 1));");
        echo "Başarılı bir şekilde giriş yapıldı..";
    } else if ($yonu == 2) {
        $insertOtoparkCikis = $baglan->query("insert into otopark(arac_turu,yon,plk_no,tarih) values ('$arac_turu','$yonu','$select_plaka','$cikis_tarihi');");
        $updateOtoparkTahsilatCikis = $baglan->query("update otopark_tahsilat set cikisTarihSaat=((select id from otopark where yon=2 and plk_no='$select_plaka' order by tarih desc limit 1)),ucret='$ucret' where fisno=(select fisno from otopark_tahsilat where plaka='$select_plaka' ORDER BY fisno desc limit 1);");
        echo "Başarılı bir şekilde çıkış yapıldı..";
    } else {
        echo "Sorun var";
    }

}

if (isset($_POST['saveOtopark'])) {
    $ucretAracTuru = $_POST['ucretAracTuru'];
    $ucretBaslangic = $_POST['ucretBaslangic'];
    $ucretBitis = $_POST['ucretBitis'];
    $ucretYeniBaslangic = $_POST['ucretYeniBaslangic'];
    $ucretYeniBitis = $_POST['ucretYeniBitis'];
    $ucretFiyat = $_POST['ucretFiyat'];
    $arac_turu_id=$db->query("select kategori_id from arac_kategori where arac_turu='$ucretAracTuru'")->fetchArray();
    $otopark_ucret_id = $db->query("select otopark_ucretleri.id from otopark_ucretleri,arac_kategori where otopark_ucretleri.arac_turu=arac_kategori.kategori_id and arac_kategori.arac_turu='$ucretAracTuru' and otopark_ucretleri.baslangic='$ucretBaslangic' and otopark_ucretleri.bitis='$ucretBitis'")->fetchArray();

    if ($ucretYeniBaslangic && $ucretYeniBitis)
    {
        $insertOtoparkUcret=$db->query("insert into otopark_ucretleri(arac_turu,baslangic,bitis,fiyat) values ('{$arac_turu_id['kategori_id']}','$ucretYeniBaslangic','$ucretYeniBitis','$ucretFiyat')");
        echo "Yeni değerler başarılı bir şekilde eklendi..";
    }
    else
    {
        $otopark_ucret=$db->query("update otopark_ucretleri set fiyat='$ucretFiyat' where id='{$otopark_ucret_id['id']}'");
        echo "Güncelleme başarılı bir şekilde gerçekleştirildi..";
    }

}
if (isset($_POST['kategoriGetir'])) {

    $arac_turu = $_POST['ucretAracTuru'];

    $kategoriGetir = $baglan->query("select otopark_ucretleri.id,otopark_ucretleri.baslangic,otopark_ucretleri.bitis,otopark_ucretleri.fiyat from otopark_ucretleri,arac_kategori where arac_kategori.kategori_id=otopark_ucretleri.arac_turu and arac_kategori.arac_turu='$arac_turu'");
    $kategoriGetir->execute();
    $result = array();
    while ($row = $kategoriGetir->fetch(PDO::FETCH_ASSOC)) {
        $result[] = array($row);
    }
    echo json_encode($result);


}
if (isset($_POST['fiyatGetir'])) {

    $ucretFiyat = $_POST['ucretFiyat'];
    $fiyatGetir = $db->query("select fiyat from otopark_ucretleri where id='$ucretFiyat'")->fetchArray();
    echo $fiyatGetir['fiyat'];

}

if (isset($_POST['mainUcretListele']))
{
    $aracTuru = $_POST['ucretAracTuru'];
    $mainUcretListele=$db->query("select baslangic,bitis,fiyat from otopark_ucretleri,arac_kategori where otopark_ucretleri.arac_turu=arac_kategori.kategori_id and  arac_kategori.arac_turu='$aracTuru'")->fetchAll();
    echo "<table class='table text-center'>
                <tr>
                    <th>Saat Aralığı</th>
                    <th>Fiyat</th>
                </tr>";
    foreach ($mainUcretListele as $item){

        echo "<tr>
                <td>{$item['baslangic']}-{$item['bitis']} Saat</td>
                <td>{$item['fiyat']} ₺</td>
             </tr>";
    }
    echo "</table>";

}



?>