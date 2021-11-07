create database siltasel_havayolu;
use siltasel_havayolu;
create table admin(

yoneticiNo int primary key,
yoneticiadi varchar(35),
yoneticipass varchar(35)

);

insert into admin values (1,"turan","123");


create table firmalar(

firmaNo int primary key,
firmaAdi varchar(40),
firmaTel varchar(11)
 
);

insert into firmalar values (1,"Türk Hava Yolları","02124440849");
insert into firmalar values (2,"Pegasus Hava Yolları","02124440849");
insert into firmalar values (3,"Emirates Hava Yolları","02123154545");

create table ulkeler(
ulkeKodu varchar(4) primary key,
ulkeAdi varchar(25)
);

insert into ulkeler values ("TR","Türkiye");
insert into ulkeler values ("FR","Fransa");
insert into ulkeler values ("NL","Hollanda");

create table havalimani(
ulkeKodu varchar(4),
havalimaniKodu varchar(4) primary key,
sehirAdi varchar(25),
havaAlaniAdi varchar(40),
constraint FK_ulkeSehir foreign key (ulkeKodu) references ulkeler(ulkeKodu)
);

insert into havalimani values ("TR","ETR","Bursa","ETR Havaalanı");
insert into havalimani values ("TR","SAW","İstanbul","Sabiha Gökçen Havaalanı");
insert into havalimani values ("TR","IST","İstanbul","İstanbul Yeni Havaalanı");
insert into havalimani values ("TR","ESB","Ankara","Esenboğa Havaalanı");
insert into havalimani values ("TR","VAS","Sivas","Nuri Demiroğ Havaalanı");
insert into havalimani values ("FR","ORY","Paris","Orly Havaalanı");


create table firmaHavalimani(
havalimaniKodu varchar(4),
firmaNo int,
constraint FK_havalimaniFirma foreign key (havalimaniKodu) references havalimani(havalimaniKodu),
constraint FK_firmaHavalimani foreign key (firmaNo) references firmalar(firmaNo)
);

insert into firmaHavalimani values ("SAW",2);
insert into firmaHavalimani values ("IST",2);
insert into firmaHavalimani values ("ESB",2);
insert into firmaHavalimani values ("VAS",2);


create table durumlar(
durumNo int primary key,
durumAdi varchar(25)
);

insert into durumlar values (1,"İNDİ");
insert into durumlar values (2,"KALKTI");
insert into durumlar values (3,"İPTAL");
insert into durumlar values (4,"KAPI KAPANDI");
insert into durumlar values (5,"KONTUAR AÇIK");


create table kapilar(
kapiNo int primary key,
kapiAdi varchar(10)
);

insert into kapilar values (1,"A Kapısı");
insert into kapilar values (2,"B Kapısı");
insert into kapilar values (3,"C Kapısı");
insert into kapilar values (4,"D Kapısı");


create table ucuslar(
ucusNo varchar(8) primary key,
firmaNo int,
planlanan datetime,
tahmini datetime ,
kHavalimaniKodu varchar(4),
vHavalimaniKodu varchar(4),
kapiNo int,
durumNo int,
constraint FK_FirmaUcus foreign key (firmaNo) references firmalar(firmaNo),
constraint FK_HavalimaniUcusK foreign key (kHavalimaniKodu) references havalimani(havalimaniKodu),
constraint FK_HavalimaniUcusV foreign key (vHavalimaniKodu) references havalimani(havalimaniKodu),
constraint FK_KapiUcus foreign key (kapiNo) references kapilar(kapiNo),
constraint FK_durumUcus foreign key (durumNo) references durumlar(durumNo)

);
									/*9999-12-31 23:59:59*/
insert into ucuslar values ("TK141",2,"2021-04-26 00:23:15","2021-04-26 00:23:15","ETR","ESB",1,2);
insert into ucuslar values ("TK236",1,"2021-04-26 00:23:55","2021-04-26 00:23:45","IST","ETR",2,1);
insert into ucuslar values ("TK358",3,"2021-04-26 00:23:15","2021-04-26 00:23:15","ORY","ETR",3,2);

create table calisan_kategori (
id int primary key,
adi varchar(20));

insert into calisan_kategori values (1,"Temizlik");
insert into calisan_kategori values (2,"Güvenlik");
insert into calisan_kategori values (3,"Servis Personeli");
insert into calisan_kategori values (4,"Nakliyeci");
insert into calisan_kategori values(5,"Mühendis");


create table calisanlar (
sicilNo int primary key,
kategori_id int,
tcNo varchar(11),
adi varchar(25),
soyadi varchar(15),
telNo varchar(11),
constraint FK_calisanKategori foreign key (kategori_id) references calisan_kategori(id)
);

insert into calisanlar values (181307024,5,"12365478901","Ramazan","Kaplaner","05326521425");
insert into calisanlar values (181307066,5,"12366578901","Engin","Beyazgül","05466521425");
insert into calisanlar values (181307006,5,"12365487901","Turan","Öz","05362521425");



create table arac_kategori(
kategori_id int primary key,
arac_turu varchar(25) 
);

insert into arac_kategori values (1,"Otomobil");
insert into arac_kategori values (2,"Kamyon");
insert into arac_kategori values (3,"Otobüs");
insert into arac_kategori values (4,"Motosiklet");

create table otopark_yon(
id int primary key,
yon_adi varchar(10)
);

insert into otopark_yon values (1,"Giriş");
insert into otopark_yon values (2,"Çıkış");


create table otopark (
id int primary key,
arac_turu int,
yon int,
plk_no varchar(10),
tarih datetime,
constraint FK_turuOtopark foreign key (arac_turu) references arac_kategori(kategori_id),
constraint FK_yonuOtopark foreign key (yon) references otopark_yon(id)
);

insert into otopark values (1,2,1,"34EU1685", "2021-04-26 01:34");
insert into otopark values (2,2,2,"34EU1685", "2021-04-26 07:34");
insert into otopark values (3,1,1,"16RMZ253", "2021-04-26 07:35");
insert into otopark values (4,1,2,"16RMZ253", "2021-04-26 22:35");



create table otopark_ucretleri(
id int primary key,
arac_turu int,
baslangic int,
bitis int,
fiyat float,
constraint FK_ucretArac foreign key (arac_turu) references arac_kategori(kategori_id)
);

insert into otopark_ucretleri values (1,1,0,1,16.75);
insert into otopark_ucretleri values (2,1,1,3,21.75);
insert into otopark_ucretleri values (3,1,3,6,34);
insert into otopark_ucretleri values (4,1,6,12,40.5);
insert into otopark_ucretleri values (5,1,12,24,54);

insert into otopark_ucretleri values (6,2,0,1,17.75);
insert into otopark_ucretleri values (7,2,1,3,22.75);
insert into otopark_ucretleri values (8,2,3,6,35);
insert into otopark_ucretleri values (9,2,6,12,41.5);
insert into otopark_ucretleri values (10,2,12,24,55);

insert into otopark_ucretleri values (11,3,0,1,18.7);
insert into otopark_ucretleri values (12,3,1,3,23.75);
insert into otopark_ucretleri values (13,3,3,6,36);
insert into otopark_ucretleri values (14,3,6,12,42.5);
insert into otopark_ucretleri values (15,3,12,24,56);

insert into otopark_ucretleri values (16,4,0,1,5);
insert into otopark_ucretleri values (17,4,1,3,7);
insert into otopark_ucretleri values (18,4,3,6,15);
insert into otopark_ucretleri values (19,4,6,12,25);
insert into otopark_ucretleri values (20,4,12,24,35);

create table otopark_tahsilat(
fis_id int primary key,
tarih datetime,
giris_id int,
cikis_id int,
ucret float,
constraint FK_tahsilatOtoparkG foreign key (giris_id) references otopark(id),
constraint FK_tahsilatOtoparkC foreign key (cikis_id) references otopark(id)
);

insert into otopark_tahsilat values (1,"2021-04-26 07:34",1,2,40.5);
insert into otopark_tahsilat values (2,"2021-04-26 22:35",3,4,54);

SELECT ucuslar.ucusNo,firmalar.firmaAdi,ucuslar.planlanan,ucuslar.tahmini,ucuslar.kHavalimaniKodu,ucuslar.vHavalimaniKodu,kapilar.kapiAdi,durumlar.durumAdi 
FROM ucuslar,firmalar,kapilar,durumlar,havalimani 
WHERE ucuslar.kapiNo=kapilar.kapiNo AND ucuslar.firmaNo=firmalar.firmaNo AND ucuslar.durumNo=durumlar.durumNo AND havalimani.ulkeKodu in (SELECT ulkeKodu FROM havalimani,ucuslar WHERE ucuslar.kHavalimaniKodu=havalimani.havalimaniKodu AND havalimani.ulkeKodu="TR");

/*DIŞ HAT*/
SELECT distinct(ucuslar.ucusNo),firmalar.firmaAdi,ucuslar.planlanan,ucuslar.tahmini,ucuslar.kHavalimaniKodu,ucuslar.vHavalimaniKodu,kapilar.kapiAdi,durumlar.durumAdi 
FROM ucuslar,firmalar,kapilar,durumlar,havalimani 
WHERE ucuslar.kapiNo=kapilar.kapiNo AND ucuslar.firmaNo=firmalar.firmaNo AND ucuslar.durumNo=durumlar.durumNo AND kHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu!="TR") OR vHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu!="TR");

/*İÇ HAT*/
SELECT distinct(ucuslar.ucusNo),firmalar.firmaAdi,ucuslar.planlanan,ucuslar.tahmini,ucuslar.kHavalimaniKodu,ucuslar.vHavalimaniKodu,kapilar.kapiAdi,durumlar.durumAdi 
FROM ucuslar,firmalar,kapilar,durumlar,havalimani 
WHERE ucuslar.kapiNo=kapilar.kapiNo AND ucuslar.firmaNo=firmalar.firmaNo AND ucuslar.durumNo=durumlar.durumNo AND kHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu!="TR") AND vHavalimaniKodu IN (SELECT havalimaniKodu FROM havalimani WHERE havalimani.ulkeKodu!="TR");
