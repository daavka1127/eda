$(document).ready(function(){
  $("#upBaingaShagnalMinut").click(function(){
    var minut = parseInt($("#baingaShagnalMinutVal").val(), 10);
    minut = minut+1;
    $("#baingaShagnalMinutVal").val(minut);
    var strMinut = "";
    if(minut >= 0 && minut < 10){
      strMinut = "0" + minut;
    }
    else{
      strMinut = minut;
    }
    $("#baingaShagnalMinut").empty();
    $("#baingaShagnalMinut").append(strMinut);
  });


  $("#downBaingaShagnalMinut").click(function(){
    var minut = parseInt($("#baingaShagnalMinutVal").val(), 10);
    minut = minut-1;
    $("#baingaShagnalMinutVal").val(minut);
    var strMinut = "";
    if(minut >= 0 && minut < 10){
      strMinut = "0" + minut;
    }
    else{
      minut = 0;
      $("#baingaShagnalMinutVal").val(minut);
      strMinut = "00";
    }
    $("#baingaShagnalMinut").empty();
    $("#baingaShagnalMinut").append(strMinut);
  });


  $("#upBaingaShagnalSecond").click(function(){
    var second = parseInt($("#baingaShagnalSecondVal").val(), 10);
    second = second+15;
    $("#baingaShagnalSecondVal").val(second);
    var strSecond = "";
    if(second == 60){
      strSecond = "00";
      second = 0;
      $("#baingaShagnalSecondVal").val(second);
    }
    else{
      strSecond = second;
    }
    $("#baingaShagnalSecond").empty();
    $("#baingaShagnalSecond").append(strSecond);
  });


  $("#downBaingaShagnalSecond").click(function(){
    var second = parseInt($("#baingaShagnalSecondVal").val(), 10);
    second = second-15;
    $("#baingaShagnalSecondVal").val(second);
    var strSecond = "";
    if(second <= 0){
      strSecond = "00";
      second = 0;
      $("#baingaShagnalSecondVal").val(second);
    }
    else{
      strSecond = second;
    }
    $("#baingaShagnalSecond").empty();
    $("#baingaShagnalSecond").append(strSecond);
  });
});



$(document).ready(function(){
  $("#upBaingaTorguuliMinut").click(function(){
    var minut = parseInt($("#baingaTorguuliMinutVal").val(), 10);
    minut = minut+1;
    $("#baingaTorguuliMinutVal").val(minut);
    var strMinut = "";
    if(minut >= 0 && minut < 10){
      strMinut = "0" + minut;
    }
    else{
      strMinut = minut;
    }
    $("#baingaTorguuliMinut").empty();
    $("#baingaTorguuliMinut").append(strMinut);
  });


  $("#downBaingaTorguuliMinut").click(function(){
    var minut = parseInt($("#baingaTorguuliMinutVal").val(), 10);
    minut = minut-1;
    $("#baingaTorguuliMinutVal").val(minut);
    var strMinut = "";
    if(minut >= 0 && minut < 10){
      strMinut = "0" + minut;
    }
    else{
      minut = 0;
      $("#baingaTorguuliMinutVal").val(minut);
      strMinut = "00";
    }
    $("#baingaTorguuliMinut").empty();
    $("#baingaTorguuliMinut").append(strMinut);
  });


  $("#upBaingaTorguuliSecond").click(function(){
    var second = parseInt($("#baingaTorguuliSecondVal").val(), 10);
    second = second+15;
    $("#baingaTorguuliSecondVal").val(second);
    var strSecond = "";
    if(second == 60){
      strSecond = "00";
      second = 0;
      $("#baingaTorguuliSecondVal").val(second);
    }
    else{
      strSecond = second;
    }
    $("#baingaTorguuliSecond").empty();
    $("#baingaTorguuliSecond").append(strSecond);
  });


  $("#downBaingaTorguuliSecond").click(function(){
    var second = parseInt($("#baingaTorguuliSecondVal").val(), 10);
    second = second-15;
    $("#baingaTorguuliSecondVal").val(second);
    var strSecond = "";
    if(second <= 0){
      strSecond = "00";
      second = 0;
      $("#baingaTorguuliSecondVal").val(second);
    }
    else{
      strSecond = second;
    }
    $("#baingaTorguuliSecond").empty();
    $("#baingaTorguuliSecond").append(strSecond);
  });
});
