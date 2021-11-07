<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ETR OTOMASYON SİSTEMİ</title>
    <link rel="stylesheet" href="css/bootstrap.min.admin.css">
    <link rel="stylesheet" href="css/navbar-fixed-left.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <style>
        .admin-menu p:first-of-type
        {
            font-size: 35px;
        }
        .admin{
            display: none;
        }

        footer{
            padding-bottom: 350px;
        }
        @media only screen and (max-width: 1000px) {
            .admin-menu
            {
                display: none;
                font-size: 20px;
            }
            .admin p
            {
                font-size: 20px;
            }
            .admin{
                display: block;
            }
            .jumbotron{ margin: 0; padding: 0; width: 1000px;}
            footer{
                margin: 10px 0;
                width: 1000px;
                text-align: center;
                font-weight: lighter;
                font-size: 14px;
            }

        }
    </style>

</head>
<body style="margin-right: 0;">
    <!-- Menü Başlangıç -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-left">
        <div class="admin-menu text-center w-100">
            <p class="lead text-center w-100 "><i class="fas fa-user"></i></p>
            <p class="lead text-white w-100 text-center"><?= $_SESSION['user'] ?></p>
        </div>
        <a id="anasayfa" class="navbar-brand" href="admin" style="margin: 0 0">ETR OTOMASYON</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav">
                <li class="nav-item admin">
                    <p class="lead text-center w-100 "><i class="fas fa-user"></i></p>
                    <p class="lead text-white w-100 text-center"><?= $_SESSION['user'] ?></p>
                </li>
                <li class="nav-item">
                    <a href="admin" class="nav-link"><i class="fas fa-home"></i>&nbsp;&nbsp;Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a href="#ucuslar" id="ucuslarMenu" class="nav-link"><i class="fad fa-plane"></i>&nbsp;&nbsp;Uçuşlar</a>
                </li>
                <li class="nav-item">
                    <a href="#havayollari" id="havayollariMenu" class="nav-link"><i class="fab fa-telegram-plane"></i>&nbsp;&nbsp;Havayolları</a>
                </li>
                <li class="nav-item">
                    <a href="#havalimani" id="havalimaniMenu" class="nav-link"><i class="fas fa-road"></i>&nbsp;&nbsp;Havalimanı</a>
                </li>
                <li class="nav-item">
                    <a href="#calisanlar" id="calisanlarMenu" class="nav-link"><i class="fas fa-user-hard-hat"></i>&nbsp;&nbsp;Çalışanlar</a>
                </li>
                <li class="nav-item">
                    <a href="#otopark" id="otoparkMenu" class="nav-link"><i class="fas fa-car"></i>&nbsp;&nbsp;Otopark</a>
                </li>
                <li class="nav-item">
                    <a href="cikis" class="nav-link"><i class="fas fa-power-off"></i>&nbsp;&nbsp;Çıkış yap</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--/Menü-->
    <hr>
    <!--Uçuşlar-->
    <div id="ucuslar" class="container">
        <div class="mt-5 jumbotron bg-light">
            <h1  class="text-center w-100 my-4 "><i class="fad fa-plane"></i>&nbsp Uçuşlar</h1>
            <ul id="UcusTab" class="nav nav-tabs w-100 justify-content-center">
                <li class="nav-item"><a class="nav-link active" href="#listeleUcuslar" data-toggle="tab">Listele</a></li>
                <li class="nav-item"><a class="nav-link" href="#ekleUcuslar" data-toggle="tab">Ekle</a></li>
            </ul>
            <div class="tab-content tab">
                <!--Listele-->
                <div class="tab-pane fade show active" id="listeleUcuslar">
                    <table class="table" id="listeleUcuslarTable">
                        <tr>
                            <th>Uçuş</th>
                            <th>Havayolu</th>
                            <th>Planlanan</th>
                            <th>Tahmini</th>
                            <th>Kalkış</th>
                            <th>Varış</th>
                            <th>Kapı</th>
                            <th>Durum</th>
                        </tr>
                    </table>
                    <!--Güncelle Pop-Up-->
                    <div class="modal fade bd-example-modal-md " id="ucusGuncelleModal" tabindex="-1" role="document" aria-labelledby="UcusGuncellemeEkrani" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="UcusGuncellemeEkrani">Uçuş Güncelleme Ekranı</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="eUcusNo">Uçuş No</label>
                                            <input type="text" class="form-control" name="eUcusNo" id="eUcusNo" readonly>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="eHavayolu">Havayolu</label>
                                            <select name="eHavayolu" id="eHavayolu" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="ePTarihSaat">Planlanan</label>
                                            <input name="ePTarihSaat" id="ePTarihSaat" type="datetime-local" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eTTarihSaat">Tahmini</label>
                                            <input name="eTTarihSaat" id="eTTarihSaat" type="datetime-local" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="ekHavalimani">Kalkış</label>
                                            <select name="eKHavalimani" id="eKHavalimani" class="form-control">
                                                <option value="0">Seçiniz</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eVHavalimani">Varış</label>
                                            <select name="eVHavalimani" id="eVHavalimani" class="form-control">
                                                <option value="0">Seçiniz</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eKapi">Kapı</label>
                                            <select name="eKapi" id="eKapi" class="form-control">

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eDurum">Durum</label>
                                            <select name="eDurum" id="eDurum" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="sifirlaGuncelleUcuslarForm" type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                        <button id="guncelleUcuslarForm" class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Güncelle Pop-Up-->
                    <!--Sil-->
                    <div class="modal fade" id="ucusSilModal" tabindex="-1" role="dialog" aria-labelledby="ucusSilModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Uyarı!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="silUcusNo" class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                                    <button class="btn btn-primary" id="silUcuslarForm" >Sil</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Sil-->
                </div>
                <!--/Listele-->
                <!--Ekle-->
                <div class="tab-pane fade mt-2" id="ekleUcuslar">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="iucusNo">Uçuş No</label>
                            <input type="text" class="form-control" id="iUcusNo" name="iUcusNo" placeholder="Uçuş No">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="iHavayolu">Havayolu</label>
                            <select id="iHavayolu" name="iHavayolu" class="form-control">
                                <option value="0">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iPTarihSaat">Planlanan</label>
                            <input id="iPTarihSaat" name="iPTarihSaat" type="datetime-local" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iTTarihSaat">Tahmini</label>
                            <input id="iTTarihSaat" name="iTTarihSaat" type="datetime-local" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iKHavalimani">Kalkış</label>
                            <select id="iKHavalimani" name="iKHavalimani" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iVHavalimani">Varış</label>
                            <select id="iVHavalimani" name="iVHavalimani" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iKapi">Kapı</label>
                            <select id="iKapi" name="iKapi" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iDurum">Durum</label>
                            <select id="iDurum" name="iDurum" class="form-control">
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ucusEkleModal">
                        Ekle
                    </button>
                    <div class="modal fade" id="ucusEkleModal" tabindex="-1" role="dialog" aria-labelledby="ucusEkleModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ucusEkleModalTitle">Uçuş Ekle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Uçuş eklensin mi ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button id="ekleUcuslarForm" class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Ekle-->
            </div>
        </div>
    </div>
    <!--/Uçuşlar-->
    <hr>
    <!--Havayolları-->
    <div id="havayollari" class="container ">
        <div class="mt-5 jumbotron bg-light">
            <h1  class="text-center w-100 my-4 "><i class="fab fa-telegram-plane"></i>&nbsp;Havayolları</h1>
            <ul id="HavayoluTab" class="nav nav-tabs w-100 justify-content-center">
                <li class="nav-item"><a class="nav-link active" href="#listeleHavayolu" data-toggle="tab">Listele</a></li>
                <li class="nav-item"><a class="nav-link" href="#ekleHavayolu" data-toggle="tab">Ekle</a></li>
                <li class="nav-item"><a class="nav-link" href="#havayoluHavalimani" data-toggle="tab">Eşleştir</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="listeleHavayolu">
                    <table class="table" id="listeleHavayoluTable">
                        <tr>
                            <th>Havayolu No</th>
                            <th>Havayolu Adı</th>
                            <th>Havayolu Tel. No</th>
                            <th>Satış Sitesi</th>
                        </tr>
                    </table>
                    <!--Güncelle Pop-Up-->
                    <div class="modal fade bd-example-modal-md " id="havayoluGuncelleModal" tabindex="-1" role="document" aria-labelledby="example1ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Havayolu Güncelleme Ekranı</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eHNo">Havayolu Numarası</label>
                                            <input name="eHNo" id="eHNo" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eHAdi">Havayolu Adı</label>
                                            <input name="eHAdi" id="eHAdi" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eHTel">Havayolu Tel</label>
                                            <input name="eHTel" id="eHTel" placeholder="0(555)555-5555" type="tel"  class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eBiletSatis">Havayolu Bilet Satış</label>
                                            <input name="eBiletSatis" id="eBiletSatis"  type="text"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                        <button id="guncelleHavayoluForm" class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Güncelle Pop-Up-->
                    <!--Sil-->
                    <div class="modal fade" id="havayoluSilModal" tabindex="-1" role="dialog" aria-labelledby="havayoluSilModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Uyarı!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="silHavayoluAdi">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                                    <button class="btn btn-primary" id="silHavayoluForm">Sil</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Sil-->
                </div>
                <div class="tab-pane fade mt-2" id="ekleHavayolu">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="iHAdi">Havayolu Adı</label>
                            <input name="iHAdi" id="iHAdi" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iHTel">Havayolu Tel.</label>
                            <input name="iHTel" id="iHTel" placeholder="0(555)555-5555" type="tel"  class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iHBiletSatisWeb">Havayolu Bilet Satış</label>
                            <input name="iHBiletSatisWeb" id="iHBiletSatisWeb"  type="text"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button data-toggle="modal" data-target="#havayolueminCenter"  type="button" class="btn btn-primary">Ekle</button>
                    </div>
                    <div class="modal fade" id="havayolueminCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Havayolu Ekle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Havayolu eklensin mi ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button id="ekleHavayoluForm" class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-2" id="havayoluHavalimani">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="havayoluSelect">Havayolu Adı</label>
                            <select class="form-control" id="havayoluSelect">
                                <option>Seçiniz</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="havalimaniSelect">Havalimanı Adı</label>
                            <select class="form-control" id="havalimaniSelect">
                                <option>Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button data-toggle="modal" data-target="#havayoluHavalimaniEkle"  type="button" class="btn btn-primary">Ekle</button>
                    </div>
                    <table id="havayoluHavalimaniTable" class="table text-center">
                    </table>
                    <!--Ekle -->
                    <div class="modal fade" id="havayoluHavalimaniEkle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Ekle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="havayoluHavalimaniEkleTitle" class="modal-body">
                                    Eşleştirmeye devam edilsin mi ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button id="HHEkle" class="btn btn-primary">Değişiklikleri kaydet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Ekle -->
                    <!--Sil -->
                    <div class="modal fade" id="havayoluHavalimaniSil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Sil</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="havayoluHavalimaniSilTitle" class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button id="HHSil" class="btn btn-primary">Değişiklikleri kaydet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Sil -->
                </div>
            </div>
        </div>
    </div>
    <!--/Havayolları-->
    <hr>
    <!--Havalimanı-->
    <div id="havalimani" class="container ">
        <div class="mt-5 jumbotron bg-light">
            <h1  class="text-center w-100 my-4 "><i class="fas fa-road"></i>&nbsp;Havalİmanı</h1>
            <ul id="HavalimaniTab" class="nav nav-tabs w-100 justify-content-center">
                <li class="nav-item"><a class="nav-link active" href="#havalimanilistele" data-toggle="tab">Listele</a></li>
                <li class="nav-item"><a class="nav-link" href="#havalimaniekle" data-toggle="tab">Ekle</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="havalimanilistele">
                    <table class="table" id="listeleHavalimaniTable">
                        <tr>
                            <th>Ülke Adı</th>
                            <th>Havalİmanı Kodu</th>
                            <th>Havaalanı Adı</th>
                            <th>Şehİr Adı</th>
                        </tr>
                    </table>
                    <!--Sil-->
                    <div class="modal fade" id="havalimaniSilModal" tabindex="-1" role="dialog" aria-labelledby="havalimaniSilModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Uyarı!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Havalimanı bilgisini silmek istediğinize emin misiniz?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                                    <button class="btn btn-primary" id="silHavalimaniForm">Sil</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Sil-->
                    <!--Güncelle Pop-Up-->
                    <div class="modal fade bd-example-modal-md " id="havalimaniGuncelleModal" tabindex="-1" role="document" aria-labelledby="example1ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Havalimanı Güncelleme Ekranı</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eHLUlke">Havalimanı Ülke Adı</label>
                                            <input class="form-control" type="text" name="eHLUlke" id="eHLUlke"  readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eHLAdi">Havalimanı Adı</label>
                                            <input class="form-control" type="text" name="eHLAdi" id="eHLAdi">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eHLSehir">Havalimanı Şehir</label>
                                            <input class="form-control" type="text" name="eHLSehir" id="eHLSehir" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eHLKodu">Havalimanı Kodu</label>
                                            <input class="form-control" type="text" name="eHLKodu" id="eHLKodu" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                        <button id="guncelleHavalimaniForm" class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Güncelle Pop-Up-->
                </div>
                <div class="tab-pane fade mt-2" id="havalimaniekle">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iHLKodu">Havalimanı Kodu</label>
                            <input name="iHLKodu" id="iHLKodu"  type="text"  class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iHLAdi">Havalimanı Adı</label>
                            <input name="iHLAdi" id="iHLAdi" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iHLUlke">Ülke Adı</label>
                            <select id="iHLUlke" name="iHLUlke" class="form-control">
                            </select>
                            <a data-toggle="modal" data-target="#ulkeEkleModal" class="btn btn-success btn-sm mt-2 float-right ml-3" href="#">Ülke Ekle</a>
                            <label style="margin-top: 12.5px;" class=" float-right">Aradığınız ülke yok ise &nbsp;<i class="fas fa-arrow-right"></i></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iHLSehir">Havalimanı Şehir</label>
                            <input name="iHLSehir" id="iHLSehir"  type="text"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button data-toggle="modal" data-target="#havalimaniEkleModal"  type="button" class="btn btn-primary">Ekle</button>
                    </div>
                    <div class="modal fade" id="havalimaniEkleModal" tabindex="-1" role="dialog" aria-labelledby="havalimaniEkleModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="havalimaniEkleModalTitle">Havalimanı Ekle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Havalimanı eklensin mi ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button id="ekleHavalimaniForm"  class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Ülke Ekle -->
                    <div class="modal fade" id="ulkeEkleModal" tabindex="-1" role="dialog" aria-labelledby="ulkeEkleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ulkeEkleModalLabel">Ülke Ekle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="iUlkeKodu" class="col-form-label">Ülke Kodu</label>
                                        <input id="iUlkeKodu" type="text" class="form-control" id="iulkeKodu">
                                    </div>
                                    <div class="form-group">
                                        <label for="iUlkeAdi" class="col-form-label">Ülke Adı</label>
                                        <input id="iUlkeAdi" type="text" class="form-control" id="iulkeAdi">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                    <button id="ulkeEkleForm"  class="btn btn-primary">Ülke Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Ülke Ekle-->
                </div>
            </div>
        </div>
    </div>
    <!--/Havalimanı-->
    <hr>
    <!--Çalışanlar-->
    <div id="calisanlar" class="container ">
        <div class="mt-5 jumbotron bg-light">
            <h1  class="text-center w-100 my-4 "><i class="fas fa-user-hard-hat"></i>&nbsp; Çalışanlar</h1>
            <ul id="CalisanTab" class="nav nav-tabs w-100 justify-content-center">
                <li class="nav-item"><a class="nav-link active" href="#calisanListele" data-toggle="tab">Listele</a></li>
                <li class="nav-item"><a class="nav-link" href="#calisanEkle" data-toggle="tab">Ekle</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="calisanListele">
                    <table class="table" id="listeleCalisanlarTable">
                        <tr>
                            <th>Sicil No</th>
                            <th>Adı</th>
                            <th>Soyadı</th>
                            <th>Meslek</th>
                            <th>Tc. No</th>
                            <th>Tel. No</th>
                        </tr>
                    </table>
                    <!--Sil-->
                    <div class="modal fade" id="calisanlarSilModal" tabindex="-1" role="dialog" aria-labelledby="calisanlarSilModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Uyarı!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="silCalisanlarAdi" class="modal-body">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                                    <button class="btn btn-primary" id="silCalisanlarForm">Sil</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Sil-->
                    <!--Güncelle Pop-Up-->
                    <div class="modal fade bd-example-modal-md " id="calisanlarGuncelleModal" tabindex="-1" role="document" aria-labelledby="example1ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Çalışan Güncelleme Ekranı</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eCSicil">Çalışan Sicil No</label>
                                            <input class="form-control" type="text" name="eCSicil" id="eCSicil" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eCTc">Çalışan Tc No</label>
                                            <input class="form-control" type="text" name="eCTc" id="eCTc">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eCAdi">Çalışan Adı</label>
                                            <input class="form-control" type="text" name="eCAdi" id="eCAdi">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eCSoyadi">Çalışan Soyadı</label>
                                            <input class="form-control" type="text" name="eCSoyadi" id="eCSoyadi">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="eCKategori">Calışan Meslek</label>
                                            <select id="eCKategori" name="eCKategori" class="form-control">
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="eCTel">Çalışan Tel.</label>
                                            <input placeholder="0(555)555-5555" class="form-control" type="tel" name="eCTel" id="eCTel">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                        <button id="guncelleCalisanlarForm"   class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Güncelle Pop-Up-->
                </div>
                <div class="tab-pane fade mt-2" id="calisanEkle">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="iCTc">Tc No</label>
                            <input name="iCTc" id="iCTc"  type="text"  class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iCAdi">Adı</label>
                            <input name="iCAdi" id="iCAdi" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iCSoyadi">Soyadı</label>
                            <input name="iCSoyadi" id="iCSoyadi" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iCKategori">Meslek</label>
                            <select id="iCKategori" name="iCKategori" class="form-control">

                            </select>
                            <a data-toggle="modal" data-target="#meslekEkleModal" class="btn btn-success btn-sm mt-2 float-right ml-3" href="#">Meslek Ekle</a>
                            <label style="margin-top: 12.5px;" class=" float-right">Aradığınız Meslek yok ise &nbsp;<i class="fas fa-arrow-right"></i></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="iCTel">Çalışan Tel.</label>
                            <input  placeholder="0(555)555-5555" name="iCTel" id="iCTel"  type="tel"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button data-toggle="modal" data-target="#calisaneminCenter"  type="button" class="btn btn-primary">Ekle</button>
                    </div>
                    <div class="modal fade" id="calisaneminCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Çalışan Ekle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Çalışan eklensin mi ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button id="ekleCalisanlarForm"  class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Meslek Ekle -->
                    <div class="modal fade" id="meslekEkleModal" tabindex="-1" role="dialog" aria-labelledby="meslekEkleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="meslekEkleModalLabel">Meslek Ekle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="iMAdi" class="col-form-label">Meslek Adı</label>
                                        <input name="iMAdi" type="text" class="form-control" id="iMAdi">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                    <button id="ekleMeslekForm"  class="btn btn-primary">Meslek Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Meslek Ekle-->
                </div>
            </div>
        </div>
    </div>
    <!--/Çalışanlar-->
    <hr>
    <!--Otopark-->
    <div id="otopark" class="container ">
        <div class="mt-5 jumbotron bg-light">
            <h1  class="text-center w-100 my-4 "><i class="fas fa-car"></i>&nbsp; Otopark</h1>
            <ul id="otoparkTab" class="nav nav-tabs w-100 justify-content-center">
                <li class="nav-item"><a class="nav-link active" href="#otoparkListele" data-toggle="tab">Giriş Yapanlar</a></li>
                <li class="nav-item"><a class="nav-link" href="#otoparkKayit" id="girisCikisIslemKayit" data-toggle="tab">Giriş-Çıkış İşlemleri</a></li>
                <li class="nav-item"><a class="nav-link" href="#otoparkRapor" data-toggle="tab">Rapor</a></li>
                <li class="nav-item"><a class="nav-link" href="#ucretTarifesi" id="ucretler" data-toggle="tab">Ücret Tarifesi</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="otoparkListele">
                    <table id="otoparkGirisListele" class="table text-center">
                        <tr>
                            <th>No</th>
                            <th>Tarih Saat</th>
                            <th>Plaka</th>
                            <th>Araç Türü</th>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade mt-2" id="otoparkKayit">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="otoparkYonu">Yönü</label>
                            <select class="form-control" name="otoparkYonu" id="otoparkYonu">
                                <option value="1">Giriş</option>
                                <option value="2">Çıkış</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="arac_plaka">Plaka</label>
                            <input class="form-control" type="text" name="plaka" id="plaka">
                            <select class="form-control" name="arac_plaka_select" id="arac_plaka_select">
                                <option value="">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="arac_turu">Araç Türü</label>
                            <select class="form-control" name="arac_turu" id="arac_turu">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cikisTarihi">Tarih</label>
                            <input id="cikisTarihi" name="cikisTarihi" class="form-control" type="text" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="girisTarihi">Giriş Tarihi</label>
                            <input id="girisTarihi" name="girisTarihi" class="form-control" type="text" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="kalinanSure">Süre</label>
                                    <input id="kalinanSure" name="kalinanSure" class="form-control" type="text" readonly >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ucret">Ücret</label>
                                    <input class="form-control" type="text" name="ucret" id="ucret">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-toggle="modal" data-target="#otoparkKayitModal" type="button" class="btn btn-primary">Tamamla</button>
                    </div>
                    <div class="modal fade" id="otoparkKayitModal" tabindex="-1" role="dialog" aria-labelledby="otoparkKayitModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="otoparkKayitModal">Emin misiniz ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    İşlem gerçekleştirilsin mi ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                                    <button id="otoparkKayitForm" name="otoparkKayitForm"  class="btn btn-primary">Evet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-2" id="otoparkRapor">
                    <table id="otoparkTahsilatRapor" class="table text-center">
                        <tr>
                            <th>No</th>
                            <th>Araç Türü</th>
                            <th>Plaka No</th>
                            <th>Giriş Tarih Saat</th>
                            <th>Çıkış Tarih Saat</th>
                            <th>Ücret</th>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade mt-2" id="ucretTarifesi">
                    <table id="otoparkKategori" class="table text-center">
                        <tr>
                            <th>No</th>
                            <th>Araç Türü</th>
                            <th>İşlemler</th>
                        </tr>
                    </table>
                    <!-- İşlemler -->
                    <div class="modal fade" id="otoparkTarifeModal" tabindex="-1" role="dialog" aria-labelledby="otoparkTarifeModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="otoparkTarifeModalTitle">Ücret Tarife İşlemleri</h5>
                                    <button type="button" class="close otoparkcarpi" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="ucretAracTuru">Araç Türü</label>
                                            <input id="ucretAracTuru" type="text" class="form-control" placeholder="Araç Türü" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row mt-2">
                                        <div class="col">
                                            <button id="yeniAralik" type="button" class="form-control btn btn-md btn-success">Yeni Aralık</button>
                                        </div>
                                    </div>
                                    <div id="eskiAralikDiv" class="form-row mt-2">
                                        <div class="col">
                                            <label for="ucretBaslangic">Başlangıç</label>
                                            <select  class="form-control"  name="" id="ucretBaslangic">
                                                <option value="">Başlangıç</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="ucretBitis">Bitiş</label>
                                            <select class="form-control" name="" id="ucretBitis">
                                                <option value="">Bitiş</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="yeniAralikDiv" class="form-row mt-2">
                                        <div class="col">
                                            <label for="ucretYeniBaslangic">Başlangıç</label>
                                            <input id="ucretYeniBaslangic" class="form-control" type="number">
                                        </div>
                                        <div class="col">
                                            <label for="ucretYeniBitis">Bitiş</label>
                                            <input id="ucretYeniBitis" class="form-control" type="number">
                                        </div>
                                    </div>
                                    <div class="form-row mt-2">
                                        <div class="col">
                                            <label for="ucretFiyat">Fiyat</label>
                                            <input id="ucretFiyat" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="sifirlaOtoparkUcret"  class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <a href="" id="saveOtoparkUcret"  class="btn btn-primary">Değişiklikleri Kaydet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/İşlemler-->
                </div>
            </div>
        </div>
    </div>
    <!--/Otopark-->
    <hr>
    <footer class="text-center mb-3">
        &copy; 1860-2021 Tüm hakları kendimize saklıdır.
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/ucuslar.js?v=<?= time() ?>"></script>
    <script src="js/havayolu.js?v=<?= time() ?>"></script>
    <script src="js/havayoluhavalimani.js?v=<?= time() ?>"></script>
    <script src="js/havalimani.js?v=<?= time() ?>"></script>
    <script src="js/calisanlar.js?v=<?= time() ?>"></script>
    <script src="js/otopark.js?v=<?= time() ?>"></script>
</body>
</html>