function btnClickAdminUpdate(id){
  $("#modalUpdateAdmin").modal();
  $("#modalContent").html('<img src="' + loadingImageUrl + '" />');
  var csrf = $('meta[name=csrf-token]').attr("content");
  $.ajax({
      type: 'post',
      url: getCheckPassword,
      data: {_token: csrf, id:id},
      success:function(response){
        $("#modalContent").html('');
        $("#modalContent").html(response);
      }
  });
}

function btnCheckPassword(id){
  var csrf = $('meta[name=csrf-token]').attr("content");
  $.ajax({
      type: 'post',
      url: checkPasswordUrl,
      data: {_token: csrf, checkPassword:$("#txtCheckPassword").val(), id:id},
      success:function(response){
        if(response=="error"){
          alertify.error('Нууц үг буруу байна!!!');
        }
        else{
          $("#modalContent").html('');
          $("#modalContent").html(response);
        }
      }
  });
}


function btnResetPasswordAdmin_click(id){
  $("#modalUpdateAdmin").modal();
  $("#modalContent").html('<img src="' + loadingImageUrl + '" />');
  var csrf = $('meta[name=csrf-token]').attr("content");
  $.ajax({
      type: 'post',
      url: passwordResetUrl,
      data: {_token: csrf, id:id},
      success:function(response){
        $("#modalContent").html('');
        $("#modalContent").html(response);
      }
  });
}
