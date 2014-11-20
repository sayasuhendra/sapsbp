var x = 1;

function cek(){
    $.ajax({
        url: "cekpesan",
        cache: false,
        success: function(msg){
            $("#notifikasi").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}

$(document).ready(function(){
    cek();
	$("#pesan").click(function(){
        $("#loading").show();
        if(x==1){
            $("#pesan").css("background-color","none");
            x = 0;
        }else{
            $("#pesan").css("background-color","none","border-bottom","solid 4px #9DBAE1");
            x = 1;
        }
        $("#info").slideToggle("slow");
        //ajax untuk menampilkan pesan yang belum terbaca
        $.ajax({
            url: "lihatpesan.php",
            cache: false,
            success: function(msg){
                $("#loading").hide();
                $("#konten-info").html(msg);
            }
        });
	});
    $("#close").click(function(){
        $("#info").hide("slow");
        $("#pesan").css("background-color","none","border-bottom","solid 4px #9DBAE1");
        x = 1;
    });
});


