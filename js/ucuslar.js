$(document).ready(function (){
    function tarihayarla(datetime) {
        var main = datetime.split(" ");
        var maindate = main[0];
        var date = maindate.split(".");
        var sumdate = date[2] + "-" + date[1] + "-" + date[0];
        var time = main[1];
        return sumdate + "T" + time;
    }
    <!-- Uçuş Listele -->
    $.ajax({
        type: "POST",
        url: "ucuslar",
        dataType: "json",
        data: {listeleUcuslar: 'listeleUcuslar'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#listeleUcuslarTable").append("<tr>" +
                    "<td>" + data[i]['no'] + "</td>" +
                    "<td>" + data[i]['fA'] + "</td>" +
                    "<td>" + data[i]['p'] + "</td>" +
                    "<td>" + data[i]['t'] + "</td>" +
                    "<td>" + data[i]['k'] + "</td>" +
                    "<td>" + data[i]['v'] + "</td>" +
                    "<td>" + data[i]['kA'] + "</td>" +
                    "<td>" + data[i]['d'] + "</td>" +
                    "<td><button class='btn btn-sm btn-success ucusGuncelle'>Güncelle</button></td>" +
                    "<td><button class='btn btn-sm btn-danger px-4 ucusSil'>Sil</button></td>" +
                    "</tr>");
            }
        }
    });
    <!-- /Uçuş Listele -->
    <!-- Uçuş Havalimanı Listele-->
    $("#iHavayolu").change(function (){
        $("#iKHavalimani").html("<option value='0'>Seçiniz</option>");
        $("#iVHavalimani").html("<option value='0'>Seçiniz</option>");
        var hn=$("#iHavayolu option:selected").val();
            $.ajax({
                type: "POST",
                url: "ucuslar",
                dataType: "json",
                data: {listeleHHSelectUcuslar: 'listeleHHSelectUcuslar',havayoluNo:hn},
                success: function (data) {
                    console.log(data);
                    var i;
                    for (i = 0; i < data.length; i++)
                    {
                        $("#iKHavalimani").append("<option value="+data[i][0]['havalimaniKodu']+">"+data[i][0]['havaAlaniAdi']+"</option>");
                        $("#iVHavalimani").append("<option value="+data[i][0]['havalimaniKodu']+">"+data[i][0]['havaAlaniAdi']+"</option>");
                    }
                }
            });
    });
    $("#eHavayolu").change(function () {
        $("#eKHavalimani").html("<option value='0'>Seçiniz</option>");
        $("#eVHavalimani").html("<option value='0'>Seçiniz</option>");
        var hn = $("#eHavayolu option:selected").val();
        $.ajax({
            type: "POST",
            url: "ucuslar",
            dataType: "json",
            data: {listeleHHSelectUcuslar: 'listeleHHSelectUcuslar', havayoluNo: hn},
            success: function (data) {
                var i;
                for (i = 0; i < data.length; i++) {
                    $("#eKHavalimani").append("<option value=" + data[i][0]['havalimaniKodu'] + ">" + data[i][0]['havaAlaniAdi'] + "</option>");
                    $("#eVHavalimani").append("<option value=" + data[i][0]['havalimaniKodu'] + ">" + data[i][0]['havaAlaniAdi'] + "</option>");
                }
            }
        });
    });
    $("#sifirlaGuncelleUcuslarForm").click(function (){
        $("#eKHavalimani").html("<option>Seçiniz</option>");
        $("#eVHavalimani").html("<option>Seçiniz</option>");
        $.ajax({
            type: "POST",
            url: "havalimani",
            dataType: "json",
            data: {listeleHavalimani: 'listeleHavalimani'},
            success: function (data) {
                var i;
                for (i = 0; i < data.length; i++)
                {
                    $("#eKHavalimani").append("<option value=" + data[i]['hK'] + ">" + data[i]['hA'] + "</option>");
                    $("#eVHavalimani").append("<option value=" + data[i]['hK'] + ">" + data[i]['hA'] + "</option>");
                }
            }
        });
    });

    $("#iKHavalimani").change(function (){
        var kod=$("#iKHavalimani option:selected").val();

        if (kod!="ETR")
        {
            $("#iVHavalimani").val("ETR");
        }
        else {
            $("#iVHavalimani").val("0");
        }
    });
    $("#iVHavalimani").change(function (){
        var kod=$("#iVHavalimani option:selected").val();

        if (kod!="ETR")
        {
            $("#iKHavalimani").val("ETR");
        }
        else {
            $("#iKHavalimani").val("0");
        }
    });

    $("#eKHavalimani").change(function (){
        var kod=$("#eKHavalimani option:selected").val();

        if (kod!="ETR")
        {
            $("#eVHavalimani").val("ETR");
        }
        else {
            $("#eVHavalimani").val("0");
        }
    });
    $("#eVHavalimani").change(function (){
        var kod=$("#eVHavalimani option:selected").val();

        if (kod!="ETR")
        {
            $("#eKHavalimani").val("ETR");
        }
        else {
            $("#eKHavalimani").val("0");
        }
    });

    <!-- /Uçuş Havalimanı Listele-->
    <!-- Uçuş Kapı Listele -->
    $.ajax({
        type: "POST",
        url: "ucuslar",
        dataType: "json",
        data: {listeleKapiUcuslar: 'listeleKapiUcuslar'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#eKapi").append("<option value='"+data[i][0]['kapiNo']+"'>" + data[i][0]['kapiAdi'] + "</option>");
                $("#iKapi").append("<option value='"+data[i][0]['kapiNo']+"'>" + data[i][0]['kapiAdi'] + "</option>");
            }
        }
    });
    <!-- /Uçuş Kapı Listele -->
    <!-- Uçuş Durum Listele -->
    $.ajax({
        type: "POST",
        url: "ucuslar",
        dataType: "json",
        data: {listeleDurumUcuslar: 'listeleDurumUcuslar'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#eDurum").append("<option value='"+data[i][0]['durumNo']+"'>" + data[i][0]['durumAdi'] + "</option>");
                $("#iDurum").append("<option value='"+data[i][0]['durumNo']+"'>" + data[i][0]['durumAdi'] + "</option>");

            }
        }
    });
    <!-- /Uçuş Durum Listele -->
    <!--Uçuş Ekle-->
    $("#ekleUcuslarForm").on('click',function (){

        var no=$('#iUcusNo').val();
        var fno=$("#iHavayolu option:selected").val();
        var pts=$('#iPTarihSaat').val();
        var tts=$('#iTTarihSaat').val();
        var kh=$('#iKHavalimani option:selected').val();
        var vh= $('#iVHavalimani option:selected').val();
        var kapi=$("#iKapi option:selected").val();
        var durum=$("#iDurum option:selected").val();

        $.ajax({
            type: "POST",
            url: "ucuslar",
            data: {ekleUcuslar: 'ekleUcuslar',iUcusNo:no,iHavayolu:fno,iPTarihSaat:pts,iTTarihSaat:tts,iKHavalimani:kh,iVHavalimani:vh,iKapi:kapi,iDurum:durum},
            success: function (data) {
                alert(data);
                location.href = "#Ucuslar";
            }
        });
        setTimeout(function (){
            location.reload();
        },1000);



    });
    <!--/Uçuş Ekle-->
    <!--Uçuş Güncelle-->
    $("#listeleUcuslarTable").on('click','.ucusGuncelle', function () {
        $('#ucusGuncelleModal').modal('show');
        $tr = $(this).closest('tr');
        var dataUcuslar = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        console.log(dataUcuslar);

        $("#eHavayolu option").each(function () {
            if (dataUcuslar[1] == $(this).text()) {
                var a = $(this).val();
                $('#eHavayolu').val(a);
            }
        });
        $("#eKapi option").each(function () {
            if (dataUcuslar[6] == $(this).text()) {
                var a = $(this).val();
                $('#eKapi').val(a);
            }
        });
        $("#eDurum option").each(function () {
            if (dataUcuslar[7] == $(this).text()) {
                var a = $(this).val();
                $('#eDurum').val(a);
            }
        });

        $('#eUcusNo').val(dataUcuslar[0]);
        $('#ePTarihSaat').val(tarihayarla(dataUcuslar[2]));
        $('#eTTarihSaat').val(tarihayarla(dataUcuslar[3]));
        $('#eKHavalimani').val(dataUcuslar[4]);
        $('#eVHavalimani').val(dataUcuslar[5]);
    });
    $("#guncelleUcuslarForm").on('click',function (){

        var no=$('#eUcusNo').val();
        var fno=$("#eHavayolu option:selected").val();
        var pts=$('#ePTarihSaat').val();
        var tts=$('#eTTarihSaat').val();
        var kh=$('#eKHavalimani option:selected').val();
        var vh= $('#eVHavalimani option:selected').val();
        var kapi=$("#eKapi option:selected").val();
        var durum=$("#eDurum option:selected").val();


        $.ajax({
            type: "POST",
            url: "ucuslar",
            data: {guncelleUcuslar: 'guncelleUcuslar',eUcusNo:no,eHavayolu:fno,ePTarihSaat:pts,eTTarihSaat:tts,eKHavalimani:kh,eVHavalimani:vh,eKapi:kapi,eDurum:durum},
            success: function (data) {
                alert(data);
                location.href = "#Ucuslar";
            }
        });
        setTimeout(function (){
            location.reload();
        },1000);




    });
    <!--/Uçuş Güncelle-->
    <!--Uçuş Sil-->
    $("#listeleUcuslarTable").on('click',".ucusSil",function (){
        $tr = $(this).closest('tr');
        var dataUcuslar = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        var dFNo=dataUcuslar[0];
        $('#silUcusNo').html(dFNo+" uçuş bilgisi silinsin mi?");
        $('#ucusSilModal').modal('show');
        $("#silUcuslarForm").on('click',function (){
            $.ajax({
                type: "POST",
                url: "ucuslar",
                data: {silUcuslar: 'silUcuslar',dUcusNo:dFNo},
                success: function (data) {
                    alert(data);
                    location.href = "#Ucuslar";
                }
            });
            setTimeout(function (){
                location.reload();
            },1000);

        });
    });
    <!--/Uçuş Sil-->

});