$(document).ready(function (){

    var listeGuncelle=function (){
        var havayolu=$("#havayoluSelect option:selected").val();
        $.ajax({
            type: "POST",
            url: "havayoluhavalimani",
            dataType: "json",
            data: {listeleHavayoluHavalimani: 'listeleHavayoluHavalimani', havayoluNo: havayolu},
            success: function (data) {
                var i;
                $("#havayoluHavalimaniTable").html(" ");
                $("#havayoluHavalimaniTable").append("<tr><th>Havalimanı Kodu</th><th>Havalimanı Adı</th><th>İşlem</th></tr>");
                for (i = 0; i < data.length; i++) {
                    $("#havayoluHavalimaniTable").append("<tr> " +
                        "<td>" + data[i][0]['havalimaniKodu'] + "</td>" +
                        "<td>" + data[i][0]['havaAlaniAdi'] + "</td>" +
                        "<td><button class='btn btn-sm btn-danger silHH'>Kaldır</button></td>" +
                        "</tr>");

                }
            }
        });
        $.ajax({
            type: "POST",
            url: "havayoluhavalimani",
            dataType: "json",
            data: {selectHavalimani: 'selectHavalimani', havayoluNo: havayolu},
            success: function (data) {
                var i;
                $("#havalimaniSelect").html("<option>Seçiniz</option>");
                for (i = 0; i < data.length; i++) {
                    $("#havalimaniSelect").append("<option value="+data[i][0]['havalimaniKodu']+">"+data[i][0]['havaAlaniAdi']+"</option>");
                }
            }
        });
    }

    <!--HavayoluHavalimaniListele-->
    $("#havayoluSelect").change(function (){
        listeGuncelle();
    });
    <!--/HavayoluHavalimaniListele-->
    <!--HavayoluHavalimanıEkle-->
    $("#HHEkle").click(function (){
        var havayolu=$("#havayoluSelect option:selected").val();
        var havalimani=$("#havalimaniSelect option:selected").val();
        $.ajax({
            type: "POST",
            url: "havayoluhavalimani",
            data: {ekleHH: 'ekleHH',no:havayolu,kod:havalimani},
            success: function (data) {
                $('#havayoluHavalimaniEkle').modal('hide');
                listeGuncelle();
            }
        });
    });
    <!--/HavayoluHavalimanıEkle-->
    <!--HavayoluHavalimaniSil-->
    $("#havayoluHavalimaniTable").on('click',".silHH",function (){
        $tr = $(this).closest('tr');
        var dataHH = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        console.log(dataHH);
        var kod=dataHH[0];
        var adi=dataHH[1];
        var havayoluNo=$("#havayoluSelect option:selected").val();
        var havayoluAdi=$("#havayoluSelect option:selected").text();
        $('#havayoluHavalimaniSilTitle').html(" ");
        $('#havayoluHavalimaniSilTitle').prepend(havayoluAdi+" için "+adi +" bilgisini silmek istediğinize emin misiniz?");
        $('#havayoluHavalimaniSil').modal('show');
        $("#HHSil").on('click',function ()
        {
            $.ajax({
                type: "POST",
                url: "havayoluhavalimani",
                data: {silHH: 'silHH', no: havayoluNo, kod: kod},
                success: function (data) {
                    $('#havayoluHavalimaniSil').modal('hide');
                    listeGuncelle();
                }
            });
        });
    });
    <!--/HavayoluHavalimaniSil-->


});