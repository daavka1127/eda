$(document).ready(function(){
    $("#btnReadmore").click(function(){
        alert("AAA");
        alert(data["RD"]);
    });
});


function btnDetailsEmp(register){
  getEmp(register);
}

function getEmp(register){
    $.ajax({
        type: 'post',
        url: getEmpByRDUrl,
        data: {_token: csrf, register:register},
        success:function(response){
            if(response.length > 0){
                $("#lblRd").empty();
                $("#lblRd").append("Регистрийн дугаар: " + register);
                $("#lblLastName").empty();
                $("#lblLastName").append("Овог: " + response[0].lastName);
                $("#lblFirstName").empty();
                $("#lblFirstName").append("Нэр: " + response[0].firstname);
                $("#lblUnit").empty();
                $("#lblUnit").append("Анги: " + response[0].unit);
                $("#lblAlbanTushaal").empty();
                $("#lblAlbanTushaal").append("Анги: " + response[0].rank);
            }
        }
    });
}
