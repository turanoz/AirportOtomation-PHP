$(document).ready(function (){

    function phoneMask() {
        var num = $(this).val().replace(/\D/g, '');
        $(this).val(num.substring(0, 1) + '(' + num.substring(1, 4) + ')' + num.substring(4, 7) + '-' + num.substring(7, 11));
    }

    $('[type="tel"]').keyup(phoneMask);

    function tarihayarla(datetime) {
        var main = datetime.split(" ");
        var maindate = main[0];
        var date = maindate.split(".");
        var sumdate = date[2] + "-" + date[1] + "-" + date[0];
        var time = main[1];
        return sumdate + "T" + time;
    }
    <!-- Havalimanı Listele -->
    $.ajax({
        type: "POST",
        url: "havalimani",
        dataType: "json",
        data: {listeleHavalimani: 'listeleHavalimani'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#listeleHavalimaniTable").append("<tr> " +
                    "<td>" + data[i]['uA'] + "</td>" +
                    "<td>" + data[i]['hK'] + "</td>" +
                    "<td>" + data[i]['hA'] + "</td>" +
                    "<td>" + data[i]['sA'] + "</td>" +
                    "<td><button class='btn btn-sm btn-success havalimaniGuncelle'>Güncelle</button></td>" +
                    "<td><button class='btn btn-sm btn-danger px-4 havalimaniSil'>Sil</button></td>" +
                    "</tr>");
                $("#eKHavalimani").append("<option value=" + data[i]['hK'] + ">" + data[i]['hA'] + "</option>");
                $("#eVHavalimani").append("<option value=" + data[i]['hK'] + ">" + data[i]['hA'] + "</option>");


            }
        }
    });
    <!-- /Havalimanı Listele -->
    <!-- Havalimanı Ülke Listele -->
    $.ajax({
        type: "POST",
        url: "havalimani",
        dataType: "json",
        data: {listeleUlkeHavalimani: 'listeleUlkeHavalimani'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#iHLUlke").append("<option value='"+data[i][0]['ulkeKodu']+"'>" + data[i][0]['ulkeAdi'] + "</option>");
            }
        }
    });
    <!-- /Havalimanı Listele -->
    <!--Havalimanı Ülke Güncelle-->
    $("#listeleHavalimaniTable").on('click','.havalimaniGuncelle', function () {
        $('#havalimaniGuncelleModal').modal('show');
        $tr = $(this).closest('tr');
        var dataHavalimani = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $("#eHLUlke").val(dataHavalimani[0]);
        $("#eHLAdi").val(dataHavalimani[2]);
        $("#eHLSehir").val(dataHavalimani[3]);
        $("#eHLKodu").val(dataHavalimani[1]);
    });
    $("#guncelleHavalimaniForm").on('click',function (){

        var ulke=$("#eHLUlke").val();
        var adi=$("#eHLAdi").val();
        var sehir=$("#eHLSehir").val();
        var kodu=$("#eHLKodu").val();

        $.ajax({
            type: "POST",
            url: "havalimani",
            data: {guncelleHavalimani: 'guncelleHavalimani',eHLUlke:ulke,eHLAdi:adi,eHLSehir:sehir,eHLKodu:kodu},
            success: function (data) {
                alert(data);
                location.href = "#havalimani";
            }
        });

        setTimeout(function (){
            location.reload();
        },1000);

    });
    <!--/Havalimanı Güncelle-->
    <!--Havalimanı Sil-->
    $("#listeleHavalimaniTable").on('click',".havalimaniSil",function (){
        $tr = $(this).closest('tr');
        var dataHavalimani = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        var kod=dataHavalimani[1];
        var adi=dataHavalimani[2];
        $('#silHavalimaniAdi').html(" ");
        $('#silHavalimaniAdi').prepend(adi+" bilgisini silmek istediğinize emin misiniz?");
        $('#havalimaniSilModal').modal('show');
        $("#silHavalimaniForm").on('click',function (){
            $.ajax({
                type: "POST",
                url: "havalimani",
                data: {silHavalimani: 'silHavalimani',dHLKod:kod},
                success: function (data) {
                    alert(data);
                    location.href = "#havalimani";
                }
            });

            setTimeout(function (){
                location.reload();
            },1000);
        });
    });
    <!--/Havalimanı Sil-->
    <!--Havalimanı Ekle-->
    $("#ekleHavalimaniForm").on('click',function (){
        var ulke=$("#iHLUlke").val();
        var adi=$("#iHLAdi").val();
        var sehir=$("#iHLSehir").val();
        var kodu=$("#iHLKodu").val();
        $.ajax({
            type: "POST",
            url: "havalimani",
            data: {ekleHavalimani: 'ekleHavalimani',iHLUlke:ulke,iHLAdi:adi,iHLSehir:sehir,iHLKodu:kodu},
            success: function (data) {
                alert(data);
                location.href = "#havalimani";
            }
        });
        setTimeout(function (){
            location.reload();
        },1000);

    });
    <!--Ulke Ekle-->
    $("#ulkeEkleForm").on('click',function (){
        var kod=$("#iUlkeKodu").val();
        var adi=$("#iUlkeAdi").val();
        $.ajax({
            type: "POST",
            url: "havalimani",
            data: {ekleUlkeHavalimani: 'ekleUlkeHavalimani',iUlkeKodu:kod,iUlkeAdi:adi},
            success: function (data) {
                alert(data);
                location.href = "#havalimani";
            }
        });
        setTimeout(function (){
            location.reload();
        },1000);


    });
    <!--/Ulke Ekle-->
    <!--/Havalimanı Ekle-->



});