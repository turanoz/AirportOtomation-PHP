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
    function tcmask() {
        var num = $(this).val().replace(/\D/g, '');
        $(this).val(num.substring(0, 11));
    }

    $('#eCTc').keyup(tcmask);
    $('#iCTc').keyup(tcmask);
    <!-- Çalışan Listele -->
    $.ajax({
        type: "POST",
        url: "calisanlar",
        dataType: "json",
        data: {listeleCalisanlar: 'listeleCalisanlar'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#listeleCalisanlarTable").append("<tr> " +
                    "<td>" + data[i]['sNo'] + "</td>" +
                    "<td>" + data[i]['adi'] + "</td>" +
                    "<td>" + data[i]['sAdi'] + "</td>" +
                    "<td>" + data[i]['kA'] + "</td>" +
                    "<td>" + data[i]['TC'] + "</td>" +
                    "<td>" + data[i]['tNo'] + "</td>" +
                    "<td><button class='btn btn-sm btn-success calisanGuncelle'>Güncelle</button></td>" +
                    "<td><button class='btn btn-sm btn-danger px-4 calisanSil'>Sil</button></td>" +
                    "</tr>");
            }
        }
    });
    <!-- /Çalışan Listele -->
    <!-- Çalışan Kategori Listele -->
    $.ajax({
        type: "POST",
        url: "calisanlar",
        dataType: "json",
        data: {listeleCalisanlarKategori: 'listeleCalisanlarKategori'},
        success: function (data) {
            var i;
            for (i = 0; i < data.length; i++)
            {
                $("#iCKategori").append("<option value='"+data[i][0]['id']+"'>" + data[i][0]['adi'] + "</option>");
                $("#eCKategori").append("<option value='"+data[i][0]['id']+"'>" + data[i][0]['adi'] + "</option>");
            }
        }
    });
    <!-- /Çalışan Kategori Listele -->
    <!--Çalışan Güncelle-->
    $("#listeleCalisanlarTable").on('click','.calisanGuncelle', function () {
        $('#calisanlarGuncelleModal').modal('show');
        $tr = $(this).closest('tr');
        var dataCalisan = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        console.log(dataCalisan);
        $("#eCSicil").val(dataCalisan[0]);
        $("#eCTc").val(dataCalisan[4]);
        $("#eCAdi").val(dataCalisan[1]);
        $("#eCSoyadi").val(dataCalisan[2]);
        $("#eCTel").val(dataCalisan[5]);
        $("#eCKategori option").each(function () {
            if (dataCalisan[3] == $(this).text()) {
                var a = $(this).val();
                $('#eCKategori').val(a);
            }
        });
    });
    $("#guncelleCalisanlarForm").on('click',function (){

        var s=$("#eCSicil").val();
        var tc=$("#eCTc").val();
        var a=$("#eCAdi").val();
        var sA=$("#eCSoyadi").val();
        var t=$("#eCTel").val();
        var k= $("#eCKategori option:selected").val();

        $.ajax({
            type: "POST",
            url: "calisanlar",
            data: {guncelleCalisanlar: 'guncelleCalisanlar',eCSicil:s,eCAdi:a,eCTc:tc,eCSoyadi:sA,eCKategori:k,eCTel:t},
            success: function (data) {
                alert(data);
                location.href = "#calisanlar";
            }
        });

        setTimeout(function (){
            location.reload();
        },1000);
    });
    <!--/Çalışan Güncelle-->
    <!--Çalışan Sil-->
    $("#listeleCalisanlarTable").on('click',".calisanSil",function (){
        $tr = $(this).closest('tr');
        var dataCalisan = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        var sNo=dataCalisan[0];
        var aS=dataCalisan[1]+" "+dataCalisan[2];
        $('#silCalisanlarAdi').html(" ");
        $('#silCalisanlarAdi').prepend(aS+" bilgisini silmek istediğinize emin misiniz?");
        $('#calisanlarSilModal').modal('show');
        $("#silCalisanlarForm").on('click',function (){
            $.ajax({
                type: "POST",
                url: "calisanlar",
                data: {silCalisanlar: 'silCalisanlar',sicilNo:sNo},
                success: function (data) {
                    alert(data);
                }
            });
            location.href = "#calisanlar";
            location.reload();
        });
    });
    <!--/Çalışan Sil-->
    <!--Çalışan Ekle-->
    $("#ekleCalisanlarForm").on('click',function (){
        var tc=$("#iCTc").val();
        var adi=$("#iCAdi").val();
        var sA= $("#iCSoyadi").val();
        var t= $("#iCTel").val();
        var k= $("#iCKategori option:selected").val();
        $.ajax({
            type: "POST",
            url: "calisanlar",
            data: {ekleCalisanlar: 'ekleCalisanlar',iCTc:tc,iCAdi:adi,iCSoyadi:sA,iCTel:t,iCKategori:k},
            success: function (data) {
                alert(data);
                location.href = "#calisanlar";
            }
        });

        setTimeout(function (){
            location.reload();
        },1000);
    });
    <!--Meslek Ekle-->
    $("#ekleMeslekForm").on('click',function (){
        var adi=$("#iMAdi").val();
        $.ajax({
            type: "POST",
            url: "calisanlar",
            data: {ekleMeslekCalisanlar: 'ekleMeslekCalisanlar',iMAdi:adi},
            success: function (data) {
                alert(data);
                location.href = "#calisanlar";
            }
        });
        setTimeout(function (){
            location.reload();
        },1000);
    });
    <!--/Meslek Ekle-->
    <!--/Çalışan Ekle-->

});