<?php
$sorgu = $baglan->query("SELECT distinct(ucuslar.ucusNo),firmalar.firmaAdi,ucuslar.planlanan,ucuslar.tahmini,ucuslar.kHavalimaniKodu,ucuslar.vHavalimaniKodu,kapilar.kapiAdi,durumlar.durumAdi FROM ucuslar,firmalar,kapilar,durumlar,havalimani WHERE ucuslar.kapiNo=kapilar.kapiNo AND ucuslar.firmaNo=firmalar.firmaNo AND ucuslar.durumNo=durumlar.durumNo AND kHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu='TR') AND vHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu='TR')");
$sorgu2 = $baglan->query("SELECT distinct(ucuslar.ucusNo),firmalar.firmaAdi,ucuslar.planlanan,ucuslar.tahmini,ucuslar.kHavalimaniKodu,ucuslar.vHavalimaniKodu,kapilar.kapiAdi,durumlar.durumAdi FROM ucuslar,firmalar,kapilar,durumlar,havalimani
WHERE ucuslar.kapiNo=kapilar.kapiNo AND ucuslar.firmaNo=firmalar.firmaNo AND ucuslar.durumNo=durumlar.durumNo
AND (ucuslar.ucusNo='{$_GET['s']}' OR ucuslar.khavalimaniKodu='{$_GET['s']}' OR ucuslar.vHavalimaniKodu='{$_GET['s']}')");
$sorgu3 = $baglan->query("SELECT distinct(ucuslar.ucusNo),firmalar.firmaAdi,ucuslar.planlanan,ucuslar.tahmini,ucuslar.kHavalimaniKodu,ucuslar.vHavalimaniKodu,kapilar.kapiAdi,durumlar.durumAdi FROM ucuslar,firmalar,kapilar,durumlar,havalimani WHERE ucuslar.kapiNo=kapilar.kapiNo AND ucuslar.firmaNo=firmalar.firmaNo AND ucuslar.durumNo=durumlar.durumNo AND (kHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu!='TR') OR vHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu!='TR'))");
$arac_turu=$baglan->query("select kategori_id,arac_turu from arac_kategori")->fetchAll();
$indexhavayolu=$baglan->query("SELECT * FROM firmalar");
$hizmetlerimiz=$baglan->query("select * from hizmetlerimiz");
require view('index');

?>