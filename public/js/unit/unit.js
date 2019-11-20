var checkUnitID = false;
$(document).ready(function(){
    $("#btnNewUnit").click(function(){
        var proceed = true;
        if($("#id").val() == ""){
            alertify.error('Ангийн код талбараа оруулна уу!!!');
            proceed = false;
        }
        if(checkUnitID == false){
          alertify.error('Ангийн код бүртгэлтэй байна!!!');
          proceed = false;
        }
        if($("#unitParent").val() == "-1"){
            alertify.error('Харъяа талбараа оруулна уу!!!');
            proceed = false;
        }
        if($("#unit").val() == ""){
            alertify.error('Анги талбараа оруулна уу!!!');
            proceed = false;
        }
        if(proceed){
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type:'POST',
                url:newUrl,
                data:{
                    _token: csrf,
                    id:$("#id").val(),
                    unitParent:$("#unitParent").val(),
                    unit:$("#unit").val(),
                    memo:$("#memo").val()
                },
                success:function(data){
                    alertify.alert(data);
                    $('#datatable').DataTable().ajax.reload();
                    checkUnitID = false;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                }
            });
        }
    });
});



$(document).ready(function(){
    $("#id").keyup(function(){
        if($("#id").val() != ""){
          var csrf = $('meta[name=csrf-token]').attr("content");
          $("#error_message").empty();
          $("#error_message").append('<img width="30" src="' + loading_smallImageUrl + '" /> <label class="control-label">Уншиж байна...</label>');
          $.ajax({
              type:'POST',
              url:checkUnitIDUrl,
              data:{
                  _token: csrf,
                  id: $("#id").val()
              },
              success:function(data){
                  if(data > 0){
                      $("#error_message").empty();
                      $("#error_message").append('<img width="30" src="' + wrongImageUrl + '" /> <label class="control-label">Бүртгэлтэй байна</label>');
                      checkUnitID = false;
                  }
                  else{
                      $("#error_message").empty();
                      $("#error_message").append('<img width="30" src="' + correctImageUrl + '" /> <label class="control-label">Боломжтой байна</label>');
                      checkUnitID = true;
                  }
              },
              error:function(XMLHttpRequest, textStatus, errorThrown) {
                  $("#error_message").empty();
                  $("#error_message").append('<img width="30" src="' + wrongImageUrl + '" /> <label class="control-label">Алдаа гарлаа.</label>');
              }
          });
        }
        else{
            $("#error_message").empty();
        }


    });
});



$(document).on('click', '#editUnit', function () {
    var id = $(this).closest("tr").find('td:eq(0)').text();
    var unitParent = $(this).closest("tr").find('td:eq(1)').text();
    var unit = $(this).closest("tr").find('td:eq(2)').text();
    var memo = $(this).closest("tr").find('td:eq(3)').text();
    checkUnitID = true;

    $("#numbEditId").val(id);
    $("#hidEditOldId").val(id);
    $("#cmbEditUnitParent").val(unitParent);
    $("#txtEditUnit").val(unit);
    $("#txtEditMemo").val(memo);
    $("#editUnitModal").modal('show');
});

$(document).ready(function(){
    $("#numbEditId").keyup(function(){
        if($("#numbEditId").val() != $("#hidEditOldId").val() && $("#numbEditId").val() != ''){
            var csrf = $('meta[name=csrf-token]').attr("content");
            $("#error_message1").empty();
            $("#error_message1").append('<img width="30" src="' + loading_smallImageUrl + '" /> <label class="control-label">Уншиж байна...</label>');
            $.ajax({
                type:'POST',
                url:checkUnitIDUrl,
                data:{
                    _token: csrf,
                    id: $("#numbEditId").val()
                },
                success:function(data){
                    if(data > 0){
                        $("#error_message1").empty();
                        $("#error_message1").append('<img width="30" src="' + wrongImageUrl + '" /> <label class="control-label">Бүртгэлтэй байна</label>');
                        checkUnitID = false;
                    }
                    else{
                        $("#error_message1").empty();
                        $("#error_message1").append('<img width="30" src="' + correctImageUrl + '" /> <label class="control-label">Боломжтой байна</label>');
                        checkUnitID = true;
                    }
                },
                error:function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#error_message1").empty();
                    $("#error_message1").append('<img width="30" src="' + wrongImageUrl + '" /> <label class="control-label">Алдаа гарлаа.</label>');
                }
            });
        }
        else{
            $("#error_message1").empty();
            checkUnitID = true;
        }
        if($("#numbEditId").val() == $("#hidEditOldId").val()){
            checkUnitID = true;
        }
    });
});


$(document).ready(function(){
    $("#btnEditUnit").click(function(){
        var proceed = true;
        if($("#numbEditId").val() == ""){
            alertify.error('Ангийн код талбараа оруулна уу!!!');
            proceed = false;
        }
        if($("#numbEditId").val() == $("#hidEditOldId").val()){
            checkUnitID = true;
        }
        if(checkUnitID == false){
          alertify.error('Ангийн код бүртгэлтэй байна!!!');
          proceed = false;
        }
        if($("#cmbEditUnitParent").val() == "-1"){
            alertify.error('Харъяа талбараа оруулна уу!!!');
            proceed = false;
        }
        if($("#txtEditUnit").val() == ""){
            alertify.error('Анги талбараа оруулна уу!!!');
            proceed = false;
        }
        if(proceed){
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type:'POST',
                url:editUrl,
                data:{
                    _token: csrf,
                    id:$("#numbEditId").val(),
                    old_id:$("#hidEditOldId").val(),
                    unitParent:$("#cmbEditUnitParent").val(),
                    unit:$("#txtEditUnit").val(),
                    memo:$("#txtEditMemo").val()
                },
                success:function(data){
                    alertify.alert(data);
                    $('#datatable').DataTable().ajax.reload();
                    checkUnitID = false;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                }
            });
        }
    });
});



$(document).on('click', '#deleteUnit', function () {
    var id = $(this).closest("tr").find('td:eq(0)').text();
    alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
      if (e) {
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'POST',
            url: deleteUnitUrl,
            data: {_token: csrf, id : id},
            success:function(data){
                alertify.alert("Амжилттай устлаа.");
                $('#datatable').DataTable().ajax.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
            }
        })
      } else {
          alertify.error('Устгах үйлдэл цуцлагдлаа.');
      }
    });
});
