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

    <!-- Havayolu Listele -->
    $.ajax({
        type: "POST",
        url: "havayolu",
        dataType: "json",
        data: {listeleHavayolu: 'havayoluListele'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#listeleHavayoluTable").append("<tr> " +
                    "<td>" + data[i]['no'] + "</td>" +
                    "<td>" + data[i]['fA'] + "</td>" +
                    "<td>" + data[i]['fT'] + "</td>" +
                    "<td>" + data[i]['fB'] + "</td>" +
                    "<td><button class='btn btn-sm btn-success havayoluGuncelle'>Güncelle</button></td>" +
                    "<td><button class='btn btn-sm btn-danger px-4 havayoluSil'>Sil</button></td>" +
                    "</tr>");
                $("#eHavayolu").append("<option value="+data[i]['no']+">"+data[i]['fA']+"</option>");
                $("#iHavayolu").append("<option value="+data[i]['no']+">"+data[i]['fA']+"</option>");
                $("#havayoluSelect").append("<option value="+data[i]['no']+">"+data[i]['fA']+"</option>");
            }
        }
    });
    <!-- /Havayolu Listele -->
    <!--Havayolu Güncelle-->
    $("#listeleHavayoluTable").on('click','.havayoluGuncelle', function () {
        $('#havayoluGuncelleModal').modal('show');
        $tr = $(this).closest('tr');
        var dataHavayolu = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#eHNo').val(dataHavayolu[0]);
        $('#eHAdi').val(dataHavayolu[1]);
        $('#eHTel').val(dataHavayolu[2]);
        $('#eBiletSatis').val(dataHavayolu[3]);
    });
    $("#guncelleHavayoluForm").on('click',function (){

        var no=$('#eHNo').val();
        var adi=$('#eHAdi').val();
        var tel=$('#eHTel').val();
        var bilet=$('#eBiletSatis').val();

        $.ajax({
            type: "POST",
            url: "havayolu",
            data: {guncelleHavayolu: 'guncelleHavayolu',eHNo:no,eHAdi:adi,eHTel:tel,eBiletSatis:bilet},
            success: function (data) {
                alert(data);
                location.href = "#havayollari";
            }
        });

        setTimeout(function (){
            location.reload();
        },1000);



    });
    <!--/Havayolu Güncelle-->
    <!--Havayolu Sil-->
    $("#listeleHavayoluTable").on('click',".havayoluSil",function (){
        $tr = $(this).closest('tr');
        var dataUcuslar = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        var dFNo=dataUcuslar[0];
        var fAdi=dataUcuslar[1];
        $('#silHavayoluAdi').html(" ");
        $('#silHavayoluAdi').prepend(fAdi+" bilgisini silmek istediğinize emin misiniz?");
        $('#havayoluSilModal').modal('show');
        $("#silHavayoluForm").on('click',function (){
            $.ajax({
                type: "POST",
                url: "havayolu",
                data: {silHavayolu: 'silHavayolu',firmaNo:dFNo},
                success: function (data) {
                    alert(data);
                    location.href = "#havayollari";
                }
            });

            setTimeout(function (){
                location.reload();
            },1000);
        });
    });
    <!--/Havayolu Sil-->
    <!--Havayolu Ekle-->
    $("#ekleHavayoluForm").on('click',function (){
        var adi=$('#iHAdi').val();
        var tel=$('#iHTel').val();
        var bilet=$('#iHBiletSatisWeb').val();
        $.ajax({
            type: "POST",
            url: "havayolu",
            data: {ekleHavayolu: 'ekleHavayolu',iHAdi:adi,iHTel:tel,iHBiletSatisWeb:bilet},
            success: function (data) {
                alert(data);
                location.href = "#havayollari";
            }
        });

        setTimeout(function (){
            location.reload();
        },1000);
    });
    <!--/Havayolu Ekle-->



});