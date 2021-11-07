$(document).ready(function () {

    function tarihayarla(datetime) {
        var main = datetime.split(" ");
        var maindate = main[0];
        var date = maindate.split(".");
        var sumdate = date[2] + "-" + date[1] + "-" + date[0];
        var time = main[1];
        return sumdate + "T" + time;
    }
    <!-- OTOPARK İŞLEMLERİ -->

    $("#yeniAralikDiv").hide();
    $("#yeniAralik").click(function () {
        $("#eskiAralikDiv").hide("slow");
        $("#yeniAralikDiv").show("slow");
        $("#yeniAralik").hide("slow");
        $("#ucretBaslangic").html(" ");
        $("#ucretBaslangic").append("<option value=''>Başlangıç</option>");
        $("#ucretBitis").html(" ");
        $("#ucretBitis").append("<option value=''>Bitiş</option>");
        $("#ucretFiyat").val(" ");

    });
    $("#sifirlaOtoparkUcret").click(function () {
        $("#eskiAralikDiv").show("slow");
        $("#yeniAralikDiv").hide("slow");
        $("#yeniAralik").show("slow");
        $("#ucretBitis").html(" ");
        $("#ucretBitis").append("<option value=''>Bitiş</option>");
        $("#ucretBaslangic").html(" ");
        $("#ucretBaslangic").append("<option value=''>Başlangıç</option>");
        $("#ucretFiyat").val(" ");
    });
    $(".otoparkcarpi").click(function () {
        $("#eskiAralikDiv").show("slow");
        $("#yeniAralikDiv").hide("slow");
        $("#yeniAralik").show("slow");
        $("#ucretBitis").html(" ");
        $("#ucretBitis").append("<option value=''>Bitiş</option>");
        $("#ucretBaslangic").html(" ");
        $("#ucretBaslangic").append("<option value=''>Başlangıç</option>");
        $("#ucretFiyat").val(" ");
    });

    <!--Otopark Giriş Rapor Listele -->
    $.ajax({
        type: "POST",
        url: "otopark",
        dataType: "json",
        data: {otoparkGirisRaporListele: 'otoparkGirisRaporListele'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++) {
                $("#otoparkGirisListele").append("<tr>" +
                    "<td>" + i + "</td>" +
                    "<td>" + data[i]['tarih'] + "</td>" +
                    "<td>" + data[i]['plk_no'] + "</td>" +
                    "<td>" + data[i]['arac_turu'] + "</td>" +
                    "</tr>");
            }
        }
    });
    <!--/Otopark Giriş Rapor Listele -->
    <!--Otopark Tahsilat Rapor Listele -->
    $.ajax({
        type: "POST",
        url: "otopark",
        dataType: "json",
        data: {otoparkTahsilatRapor: 'otoparkTahsilatRapor'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++) {
                $("#otoparkTahsilatRapor").append("<tr>" +
                    "<td>" + i + "</td>" +
                    "<td>" + data[i]['arac_turu'] + "</td>" +
                    "<td>" + data[i]['plaka'] + "</td>" +
                    "<td>" + data[i]['giris'] + "</td>" +
                    "<td>" + data[i]['cikis'] + "</td>" +
                    "<td>" + data[i]['ucret'] + "</td>" +
                    "</tr>");
            }
        }
    });
    <!--/Otopark Tahsilat Rapor Listele -->
    <!--Otopark Kategori Listele -->
    $.ajax({
        type: "POST",
        url: "otopark",
        dataType: "json",
        data: {kategoriListele: 'kategoriListele'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++) {
                $("#otoparkKategori").append("<tr>" +
                    "<td>" + data[i]['id'] + "</td>" +
                    "<td>" + data[i]['arac_turu'] + "</td>" +
                    "<td><button data-toggle='modal' data-target='#otoparkTarifeModal' class='btn btn-sm btn-success islem'>İşlemler</button></td>" +
                    "</tr>");
                $("#arac_turu").append("<option value='" + data[i]['id'] + "'>" + data[i]['arac_turu'] + "</option>");
            }
        }
    });
    <!--/Otopark Kategori Listele -->

    $("#arac_plaka_select").hide();
    $("#ucret").prop("disabled", true);
    $.saatGuncelle = function () {
        $.ajax({
            type: "POST",
            url: "otopark",
            data: {otoparkTarih: 'tarih'},
            success: function (data) {
                $('#cikisTarihi').val(data);
            }
        });
    }
    $.saatGuncelle();
    setInterval("$.saatGuncelle()", 60000);

    $.ajaxLoad = function () {
        $.ajax({
            type: "POST",
            url: "otopark",
            data: {otoparkGirisYapanlarPlaka: 'otoparkGirisYapanlarPlaka'},
            success: function (data) {
                $('#arac_plaka_select').html("<option>Seçiniz</option>");
                $('#arac_plaka_select').append(data);
            }
        });
    }

    $("#otoparkYonu").change(function () {
        if ($("#otoparkYonu").val() == 2) {
            $("#plaka").hide();
            $("#arac_plaka_select").toggle("slow");
            $("#arac_turu").prop("disabled", true)
            $.ajaxLoad();
        } else if ($("#otoparkYonu").val() == 1) {
            $("#plaka").toggle("slow");
            $("#arac_plaka_select").hide();
            $("#girisTarihi").val(" ");
            $("#kalinanSure").val("");
            $("#arac_turu").prop("disabled", false);
        }
    });

    $("#arac_plaka_select").change(function () {
        var plaka = $("#arac_plaka_select").val();
        $.ajax({
            type: "POST",
            url: "otopark",
            dataType: "json",
            data: {otoparkCikisTahsilat: 'otoparkCikisTahsilat', plaka: plaka},
            success: function (data) {
                $("#arac_turu").val(data[0]["arac_turu"]);
                $("#girisTarihi").val(data[0]["tarih"]);
            }
        });
        setTimeout(function () {
            var girisTarihi = $("#girisTarihi").val();
            console.log(girisTarihi);
            var cikisTarihi = $("#cikisTarihi").val();
            $.ajax({
                type: "POST",
                url: "otopark",
                data: {giris: girisTarihi, cikis: cikisTarihi},
                success: function (data) {
                    $("#kalinanSure").val(data + " Saat");
                }
            });

        }, 300)
        setTimeout(function () {
            var sure = $("#kalinanSure").val();
            var arac_turu = $("#arac_turu").val();
            $.ajax({
                type: "POST",
                url: "otopark",
                data: {kalinanSure: sure, arac_turu: arac_turu},
                success: function (data) {
                    $("#ucret").val(data + " ₺");
                }
            });
        }, 700);
    });




    $("#otoparkKayitForm").click(function () {

        var yonu = $("#otoparkYonu").val();
        var arac_turu = $("#arac_turu").val();
        var plaka = $("#plaka").val();
        var select_plaka = $("#arac_plaka_select").val();
        var giris_tarihi = tarihayarla($("#girisTarihi").val());
        var cikis_tarihi = tarihayarla($("#cikisTarihi").val());
        var ucret = $("#ucret").val();

        $.ajax({
            type: "POST",
            url: "otopark",
            data: {
                otoparkGirisTahsilat: 'otoparkGirisTahsilat',
                otoparkGirisTahsilatyonu: yonu,
                otoparkGirisTahsilatarac_turu: arac_turu,
                otoparkGirisTahsilatplaka: plaka,
                otoparkGirisTahsilatselect_plaka: select_plaka,
                otoparkGirisTahsilatgiris_tarihi: giris_tarihi,
                otoparkGirisTahsilatcikis_tarihi: cikis_tarihi,
                otoparkGirisTahsilatucret: ucret
            },
            success: function (data) {
                $('#otoparkKayitModal').modal('toggle')
                $("#arac_plaka_select").html("<option>Seçiniz</option>");
                alert(data);
                location.reload();
            }
        });
        $("#otoparkKayitModal").modal("hide");
    });



    $('#girisCikisIslemKayit').tab('show');
    $("#ucretler").click(function () {
        $.ajax({
            type: "POST",
            url: "otopark",
            data: {otoparkKategori: "otoparkKategori"},
            success: function (data) {
                $("#otoparkKategori").append(data);
            }
        });
    });

    $("#otoparkKategori").on('click', '.islem', function () {
        $tr = $(this).closest('tr');
        var dataUcretTarife = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $("#ucretAracTuru").val(dataUcretTarife[1]);
        $.ajax({
            type: "POST",
            url: "otopark",
            dataType: "json",
            data: {kategoriGetir: 'kategori', ucretAracTuru: dataUcretTarife[1]},
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    $("#ucretBaslangic").append("<option value='" + data[i][0]['id'] + "'>" + data[i][0]['baslangic'] + "</option>");
                    $("#ucretBitis").append("<option value='" + data[i][0]['id'] + "'>" + data[i][0]['bitis'] + "</option>");
                    $("#ucretFiyat").append("<option value='" + data[i][0]['id'] + "'>" + data[i][0]['fiyat'] + "</option>");
                }
            }
        });
    });

    $('#ucretBaslangic').change(function () {
        $("#ucretBitis").val($("#ucretBaslangic").val());
        var ucretFiyat = $("#ucretBaslangic").val()
        $.ajax({
            type: "POST",
            url: "otopark",
            dataType: "json",
            data: {fiyatGetir: 'fiyat', ucretFiyat: ucretFiyat},
            success: function (data) {
                $("#ucretFiyat").val(data);
            }
        });
    })
    $('#ucretBitis').change(function () {
        $("#ucretBaslangic").val($("#ucretBitis").val());
        var ucretFiyat = $("#ucretBitis").val();
        $.ajax({
            type: "POST",
            url: "otopark",
            dataType: "json",
            data: {fiyatGetir: 'fiyat', ucretFiyat: ucretFiyat},
            success: function (data) {
                $("#ucretFiyat").val(data);
            }
        });
    })

    $("#saveOtoparkUcret").click(function () {
        var ucretAracTuru = $('#ucretAracTuru').val();
        var ucretBaslangic = $('#ucretBaslangic option:selected').text();
        var ucretBitis = $('#ucretBitis option:selected').text();
        var ucretYeniBaslangic = $('#ucretYeniBaslangic').val();
        var ucretYeniBitis = $('#ucretYeniBitis').val();
        var ucretFiyat = $('#ucretFiyat').val();
        $.ajax({
            type: "POST",
            url: "otopark",
            data: {
                saveOtopark: 'Save',
                ucretAracTuru: ucretAracTuru,
                ucretBaslangic: ucretBaslangic,
                ucretBitis: ucretBitis,
                ucretYeniBaslangic: ucretYeniBaslangic,
                ucretYeniBitis: ucretYeniBitis,
                ucretFiyat: ucretFiyat
            },
            success: function (data) {
                alert(data);
                location.reload();
            }
        });

    });



});
