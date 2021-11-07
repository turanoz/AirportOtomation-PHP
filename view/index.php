<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap5.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
    <link rel="icon" href="<?=URL.'img/logo.png'?>">
    <style>
        html {
            scroll-behavior: smooth;
        }
        .logo
        {
            width: 150px;
            transition-duration: 0.4s;
        }
        .nav-item
        {
            text-align: center;
        }
    </style>

    <title>ETR AIRPORT</title>
</head>
<body>
<!--Menü -->
<header>
    <a href="" id="anasayfa"></a>
    <nav class="navbar navbar-sm bg-dark navbar-dark navbar-expand-md fixed-top">
        <div class="container">
            <a href="<?= $config['url'] ?>" class="navbar-brand">
                <img class="d-inline-block logo align-text-top" src="<?=URL?>img/logomain.png" alt="ETR Airport">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul id="anamenu" class="navbar-nav ms-auto ">
                    <li class="nav-item"><a href="#anasayfa" class="nav-link">Anasayfa</a></li>
                    <li class="nav-item"><a href="#ucusbilgiekrani" class="nav-link">Uçuş Bilgi Ekranı</a></li>
                    <li class="nav-item"><a href="#havayollari" class="nav-link">Havayolları</a></li>
                    <li class="nav-item"><a href="#hizmetlerimiz" class="nav-link">Hizmetler</a></li>
                    <li class="nav-item"><a href="#bizkimiz" class="nav-link">Biz Kimiz</a></li>
                    <li class="nav-item"><a href="login" target="_blank" class="nav-link"><i class="fas fa-user"></i>&nbsp;Giriş Yap</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Menü Bitti -->
<!--Giriş -->
<section class="bg-blue py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 py-5">
                <h1 class="display-2 font-italic">İşimizin başında olduğumuz doğrudur...</h1>
                <p class="lead">
                    Yıllardır olduğu gibi bugünde hizmetlerimizi aksatmamanın, kalitenin öncüsü olmanın gururunu
                    yaşıyoruz. İyi ki varsınız...
                </p>
            </div>
        </div>
        <a href="" id="ucusbilgiekrani"></a>
    </div>
</section>
<!--Giriş Bitti -->
<!-- Uçuşlar -->
<section class="bg-light py-5">
    <div class="container-fluid container-md">
        <div class="row">
            <h1 class="text-center"><i class="fad fa-plane"></i>&nbsp;Uçuşlar</h1>
            <form method="get" action="http://havayolu.turanoz.com.tr/#ucusbilgiekrani">
                <ul id="myTab" class="nav nav-tabs justify-content-center">
                    <li class="nav-item"><a class="nav-link active" href="#ichatlar" data-bs-toggle="tab">İç Hatlar</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#dishatlar" data-bs-toggle="tab">Dış Hatlar</a></li>
                    <li class="nav-item">
                        <input name="s" class="form-control" style=" width: 250px;margin-left: 5px;" type="text" placeholder="Uçuş numarası / Şehir / Havayolu Kodu">
                    </li>
                    <li class="nav-item">
                        <input type="submit" style="width: 50px;margin-left: 5px;" class="form-control" value="Ara">
                    </li>
                </ul>
            </form>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="ichatlar">
                <table id="ucuslar1" class="table text-center">
                    <tr>
                        <th>Uçuş No</th>
                        <th>Havayolu</th>
                        <th>Planlanan</th>
                        <th>Tahmini</th>
                        <th>Kalkış</th>
                        <th>Varış</th>
                        <th>Kapı</th>
                        <th>Durum</th>
                    </tr>
                    <?php if (!empty($_GET[s])) {
                        foreach ($sorgu2 as $item) { ?>
                            <tr>
                                <td><?= $item['ucusNo'] ?></td>
                                <td><?= $item['firmaAdi'] ?></td>
                                <td><?= tarihFormat($item['planlanan']) ?></td>
                                <td><?= tarihFormat($item['tahmini']) ?></td>
                                <td><?= $item['kHavalimaniKodu'] ?></td>
                                <td><?= $item['vHavalimaniKodu'] ?></td>
                                <td><?= $item['kapiAdi'] ?></td>
                                <td><?= $item['durumAdi'] ?></td>
                            </tr>
                        <?php }
                    } else {
                        foreach ($sorgu as $item) { ?>
                            <tr>
                                <td><?= $item['ucusNo'] ?></td>
                                <td><?= $item['firmaAdi'] ?></td>
                                <td><?= tarihFormat($item['planlanan']) ?></td>
                                <td><?= tarihFormat($item['tahmini']) ?></td>
                                <td><?= $item['kHavalimaniKodu'] ?></td>
                                <td><?= $item['vHavalimaniKodu'] ?></td>
                                <td><?= $item['kapiAdi'] ?></td>
                                <td><?= $item['durumAdi'] ?></td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>
            <div class="tab-pane fade" id="dishatlar">
                <table id="ucuslar2" class="table text-center">
                    <tr>
                        <th>Uçuş No</th>
                        <th>Havayolu</th>
                        <th>Planlanan</th>
                        <th>Tahmini</th>
                        <th>Kalkış</th>
                        <th>Varış</th>
                        <th>Kapı</th>
                        <th>Durum</th>
                    </tr>
                    <?php if (!empty($_GET[s])) {
                        foreach ($sorgu2 as $item) { ?>
                            <tr>
                                <td><?= $item['ucusNo'] ?></td>
                                <td><?= $item['firmaAdi'] ?></td>
                                <td><?= tarihFormat($item['planlanan']) ?></td>
                                <td><?= tarihFormat($item['tahmini']) ?></td>
                                <td><?= $item['kHavalimaniKodu'] ?></td>
                                <td><?= $item['vHavalimaniKodu'] ?></td>
                                <td><?= $item['kapiAdi'] ?></td>
                                <td><?= $item['durumAdi'] ?></td>
                            </tr>
                        <?php }
                    } else {
                        foreach ($sorgu3 as $item) { ?>
                            <tr>
                                <td><?= $item['ucusNo'] ?></td>
                                <td><?= $item['firmaAdi'] ?></td>
                                <td><?= tarihFormat($item['planlanan']) ?></td>
                                <td><?= tarihFormat($item['tahmini']) ?></td>
                                <td><?= $item['kHavalimaniKodu'] ?></td>
                                <td><?= $item['vHavalimaniKodu'] ?></td>
                                <td><?= $item['kapiAdi'] ?></td>
                                <td><?= $item['durumAdi'] ?></td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>
        </div>
        <a href="" id="havayollari"></a>
    </div>
</section>
<!-- Uçuşlar Bitti-->
<!-- Havayolları -->
<section style="background-color: #D2DCE6" class="py-5">
    <div class="container">
        <div class="row">
            <h1 class="text-center mb-4"><i class="fab fa-telegram-plane"></i>&nbsp;Havayolları</h1>
            <p class="text-center w-100 lead">ETR Havalimanı’ndan düzenli sefer gerçekleştirmekte olan havayolları listesi aşağıdaki gibidir;</p>
            <table class="table text-center">
                <tr>
                    <th>Havayolları</th>
                    <th>İletişim Bilgileri</th>
                    <th>Bilet Satış</th>
                </tr>
                <?php $ilkdongu = 0;
                foreach ($indexhavayolu as $item) {
                $ilkdongu += 1; ?>
                <tr>
                    <td>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#firmaModal<?= $item['firmaNo'] ?>">
                            <?= $item['firmaAdi'] ?>
                        </a>
                    </td>
                    <td><?= $item['firmaTel'] ?></td>
                    <td><a class="btn" target="_blank" href="<?= $item['firmaBiletSatisWeb'] ?>"><?= $item['firmaBiletSatisWeb'] ?></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade " id="firmaModal<?= $item['firmaNo'] ?>" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?= $item['firmaAdi'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row">
                                    <span class="col-md-3 col-sm-3"><b>Ülke</b></span>
                                    <span class="col-md-3 col-sm-3"><b>Şehir</b></span>
                                    <span class="col-md-6 col-sm-6"><b>Havaalanı</b></span>
                                </div>
                            <?php
                            $sayac = 0;
                            $indexhavayoluFirma = $baglan->query("select ulkeler.ulkeAdi,havalimani.sehirAdi,havalimani.havaAlaniAdi from ulkeler,havalimani where ulkeler.ulkeKodu=havalimani.ulkeKodu and havalimani.havalimaniKodu in(select firmaHavalimani.havalimaniKodu from firmaHavalimani where firmaHavalimani.firmaNo =(Select firmalar.firmaNo from firmalar where firmaNo={$item['firmaNo']}))");
                            foreach ($indexhavayoluFirma as $item) { ?>
                                <?php if ($sayac <= $ilkdongu || $sayac > $ilkdongu) { ?>
                                    <div class="row">
                                        <span class="col-md-3 col-sm-3"><?= $item['ulkeAdi'] ?></span>
                                        <span class="col-md-3 col-sm-3"><?= $item['sehirAdi'] ?></span>
                                        <span class="col-md-6 col-sm-6"><?= $item['havaAlaniAdi'] ?></span>
                                    </div>
                                <?php } else {
                                } ?>
                                <?php $sayac = $sayac + 1;
                            } ?>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  } ?>
            </table>
        </div>
    </div>
    <a href="" id="hizmetlerimiz"></a>
    <!--Havayolu Seferleri Bitti -->
</section>
<!-- Havayolları Bitti -->
<!-- Hizmetlerimiz -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <h1 class="text-center w-100 mb-4 "><i class="fas fa-toolbox"></i>&nbsp; Hizmetlerimiz</h1>
            <p class="text-center w-100 lead"> Bünyemizde bulunan hizmetler; </p>
            <table class="table">
                <tr>
                    <td><h1 class="display-5"> Otopark</h1></td>
                </tr>
                <tr>
                    <td>
                        <table class="table text-center">
                            <tr>
                                <th>Araç Tipi</th>
                                <th>Ücretler</th>
                            </tr>
                            <?php foreach ($arac_turu as $item) { ?>
                            <tr>
                                <td><?=$item['arac_turu']?></td>
                                <td><button data-bs-toggle="modal" data-bs-target="#otoparkBackdrop" style="background-color: #0D6EFD; color: aliceblue" class="btn btn-sm ucretListeleBtn">Listele</button></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- Ücret Modal -->
            <div class="modal fade" id="otoparkBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Ücret Listesi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                        </div>
                        <div id="ucretListeleTable" class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table">


            <?php foreach ($hizmetlerimiz as $item) { ?>
                <tr>
                    <td><h1 class="display-5"> <?= $item['hizmetAdi'] ?></h1></td>
                </tr>
                <tr>
                    <td><p align="justify" class="lead ">
                            <?= $item['aciklama'] ?>
                        </p></td>
                </tr>

            <?php } ?>
            </table>
        </div>
    </div>
</section>
<!-- Hizmetlerimiz Bitti -->
<!-- Footer -->
<a href="" id="bizkimiz"></a>
<footer style="background-color: #E4E4E4" class="py-5">
    <div class="container">
        <div class="row">
            <h2 class="text-center pb-1"><i class="far fa-fist-raised"></i> &nbsp; Saygılarımızla</h2>
            <p class="text-center lead mb-0">Bu sitenin tüm hakları üç kişi içinde toplanmıştır. Sitemizin tüm
                süreçlerini ; </p>
            <div style="background-color: transparent; border: none" class="card col-md-4 text-center">
                <p class="lead pt-3">Turan Öz<br>181307006@kocaeli.edu.tr</p>
            </div>
            <div style="background-color: transparent; border: none" class=" card col-md-4 text-center">
                <p class="lead pt-3">Engin Beyazgül<br>181307066@kocaeli.edu.tr</p>
            </div>
            <div style="background-color: transparent; border: none" class=" card col-md-4 text-center">
                <p class="lead pt-3">Ramazan Kaplaner<br>181307024@kocaeli.edu.tr</p>
            </div>
            <p class="lead text-center">yönetmiştir. Sitemizi ziyaret edip desteklerinizi esirgemediğiniz için teşekkür ederiz.. </p>
            <p class="lead text-center">&copy;1860-2021</p>

        </div>
    </div>
</footer>

<!-- Footer Bitti -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js?=v<?= time() ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (){
        $("#covidModal").modal('show');


        $(".ucretListeleBtn").click(function () {
            $tr = $(this).closest('tr');
            var ucretListele = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            var arac_turu=ucretListele[0];
            $("#staticBackdropLabel").html(" ");
            $("#staticBackdropLabel").prepend(arac_turu+" Ücret Listesi");

            $.ajax({
                type: "POST",
                url: "otopark",
                data: {mainUcretListele: 'mainUcretListele', ucretAracTuru: arac_turu},
                success: function (data) {
                    $("#ucretListeleTable").html(" ");
                    $("#ucretListeleTable").html(data);
                }
            });
        });
        $(document).scroll(function(){
            if($(document).scrollTop() == 0)
            $(".logo").css("width","150px");
            else
            $(".logo").css("width","100px");
        });
    });
</script>



<div class="modal fade" id="covidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-nurse"></i>&nbsp;&nbsp; Covid-19</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yaşadığımız bu yeni dönemde terminalimizden başlayacak tüm seyahatlerinizi daha sağlıklı yapmanız için, süreçlerimizi daha güvenli hale getirdik. Çünkü sizi ve sevdiklerinizi önemsiyoruz.</p>
                <img class="mx-auto d-block w-50" src="https://www.eiopa.europa.eu/sites/default/files/styles/eiopa_image_style/public/images/cdc-covid19-950x535px.jpg?itok=sfalPb6p" alt="covid-19">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>