$(document).ready(function(){
    $("#btnDeleteMission").click(function(){
        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
            if(e){
                var csrf = $('meta[name=csrf-token]').attr("content");
                $.ajax({
                    type:'POST',
                    url:deleteUrl,
                    data:{
                        _token: csrf,
                        id:data["id"]
                    },
                    success:function(data){
                        if(data == "00"){
                            alertify.error("Алдаа гарлаа!!!");
                        }
                        else{
                            alertify.alert(data);
                            refresh();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                    }
                });
            }
            else {
                alertify.error('Устгах үйлдэл цуцлагдлаа.');
            }
        });
    });
});
