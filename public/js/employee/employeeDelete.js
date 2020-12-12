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


$(document).ready(function(){
    $("#btnDeleteAllPeopleThisEelj").click(function(){
        if($("#cmbCountry").val() == '-1'){
            alertify.error('Ажиллагааны нэрээ сонгоно уу!!!');
            return;
        }
        if($("#cmbEelj").val() < 1){
            alertify.error('Ээлжээ сонгоно уу!!!');
            return;
        }
        alertify.confirm( "Энэ ээлжийн бүх хүмүүс устах гэж байна. Та устгахдаа итгэлтэй байна уу?", function (e) {
            if(e){
                var csrf = $('meta[name=csrf-token]').attr("content");
                $.ajax({
                    type:'POST',
                    url:$("#btnDeleteAllPeopleThisEelj").attr('post-url'),
                    data:{
                        _token: csrf,
                        countryID:$("#cmbCountry").val(),
                        eelj:$("#cmbEelj").val()
                    },
                    success:function(data){
                        if(data.status == "success"){
                            alertify.alert(data.msg);
                            refresh();
                        }
                        else{
                            alertify.error(data.msg);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                    }
                });
            }
        });
    });
});
