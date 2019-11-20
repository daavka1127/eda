function readmoreMisstionByEmp(register){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $("#detailsEmpMission").modal('show');
    $('#dtMissionByRD').dataTable().fnDestroy();
    // dataTable iig fill hiij tuhain hunii yvsan ajillagaanii medeelliig haruulj bn
    $('#dtMissionByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
        "language": {
            "lengthMenu": "_MENU_ мөрөөр харах",
            "zeroRecords": "Хайлт илэрцгүй байна",
            "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
            "infoEmpty": "Хайлт илэрцгүй",
            "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
            "sSearch": "Хайх: ",
            "paginate": {
              "previous": "Өмнөх",
              "next": "Дараахи"
            }
        },
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": getMissionByRD,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf,
                      rd: register
                    }
               },
        "columns": [
            { data: "id", name: "id" },
            { data: "countryName", name: "countryName" },
            { data: "eelj", name: "eelj" },
            { data: "sectorName", name: "sectorName" },
            { data: "RankName", name: "RankName" },
            { data: "operationRank", name: "operationRank" },
            { data: "date", name: "date" },
            { data: "name", name: "name" }
          ]
    });

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
    readmoreAwadsByRD(register);
    readmorePunishmentsByRD(register);
    readmoreTrainingsByRD(register);
}

function readmoreAwadsByRD(register){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $('#dtAwardsByRD').dataTable().fnDestroy();
    $('#dtAwardsByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
        "language": {
            "lengthMenu": "_MENU_ мөрөөр харах",
            "zeroRecords": "Шагнал байхгүй байна",
            "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
            "infoEmpty": "Хайлт илэрцгүй",
            "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
            "sSearch": "Хайх: ",
            "paginate": {
              "previous": "Өмнөх",
              "next": "Дараахи"
            }
        },
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": getAwardsReadmore,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf,
                      rd: register
                    }
               },
        "columns": [
            { data: "countryName", name: "countryName" },
            { data: "eelj", name: "eelj" },
            { data: "tailbar", name: "tailbar" },
            { data: "date", name: "date" },
            { data: "name", name: "name" }
          ]
    });
}

function readmorePunishmentsByRD(register){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $('#dtPunishmentsByRD').dataTable().fnDestroy();
    $('#dtPunishmentsByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
        "language": {
            "lengthMenu": "_MENU_ мөрөөр харах",
            "zeroRecords": "Шийтгэл байхгүй байна",
            "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
            "infoEmpty": "Хайлт илэрцгүй",
            "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
            "sSearch": "Хайх: ",
            "paginate": {
              "previous": "Өмнөх",
              "next": "Дараахи"
            }
        },
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": getPunishmentsReadmore,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf,
                      rd: register
                    }
               },
        "columns": [
            { data: "countryName", name: "countryName" },
            { data: "eelj", name: "eelj" },
            { data: "tailbar", name: "tailbar" },
            { data: "date", name: "date" },
            { data: "name", name: "name" }
          ]
    });
}

function readmoreTrainingsByRD(register){
  $('#dtTrainingsByRD').dataTable().fnDestroy();
  var csrf = $('meta[name=csrf-token]').attr("content");
  $('#dtTrainingsByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
      "language": {
          "lengthMenu": "_MENU_ мөрөөр харах",
          "zeroRecords": "Сургалт дамжаанд хамрагдаагүй",
          "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
          "infoEmpty": "Сургалт дамжаанд хамрагдаагүй",
          "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
          "sSearch": "Хайх: ",
          "paginate": {
            "previous": "Өмнөх",
            "next": "Дараахи"
          }
      },
      "processing": true,
      "serverSide": true,
      "ajax":{
               "url": getTraningsReadmore,
               "dataType": "json",
               "type": "POST",
               "data":{
                    _token: csrf,
                    rd: register
                  }
             },
      "columns": [
          { data: "trainingTypeName", name: "trainingTypeName" },
          { data: "trainingCoutnry", name: "trainingCoutnry" },
          { data: "trainingName", name: "trainingName" },
          { data: "leaveDate", name: "leaveDate" },
          { data: "arriveDate", name: "arriveDate" },
          { data: "date", name: "date" },
          { data: "name", name: "name" }
        ]
    });
}

$(document).ready(function(){
    $("#btnPrintEmpMissionDetails").click(function(){
        var newWin = window.open(printReportUrl + data['RD'], 'Print-Window');
        newWin.document.close();
        setTimeout(function(){newWin.close();},10);
    });
});
