var sayac=$("#ucuslar1 tr").length;
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const s = urlParams.get('s');
if(sayac<=1){
    $("#ucuslar1").html("<tr><td colspan='6' align='center'>"+s+" Bulunamadı</td></tr>");
    $("#ucuslar2").html("<tr><td colspan='6' align='center'>"+s+" Bulunamadı</td></tr>");
}
