@extends('layouts.layout_report_portrait')

@section('content')
<script>
  $(document).ready(function(){
    window.print();
    window.onfocus=function(){ window.close();}
  });
</script>
  <div class="main">
      <h5 class="title"><strong>Энхийг дэмжих-Цэргийн хамтын ажиллагааны хэлтсийн лавлагаа </strong></h5>
      <p class="date">{{$dateString}}</p>
      <p class="report-body">
          Регистрийн дугаар {{$empRow->RD}}<br>
          {{$empRow->lastName}} овогтой {{$empRow->firstname}} нь
          хүйс: {{$empRow->sex}} анги: {{$empRow->unitName}}<br>
          Ажиллагааны туршлага:<br>
      </p>
      <table id="dtMissions" class="table table-striped table-bordered" style="width:100%;">
        <thead>
          <tr>
            <th>Ажиллагааны нэр</th>
            <th>Ээлж</th>
            <th>Салбар</th>
            <th>Ажиллагааны цол</th>
            <th>Ажиллагааны албан тушаал</th>
            <th>Бүртгэл хийсэн огноо</th>
            <th>Админ</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($missions as $mission)
            <tr>
              <th>{{$mission->countryName}}</th>
              <th>{{$mission->eelj}}</th>
              <th>{{$mission->sectorName}}</th>
              <th>{{$mission->RankName}}</th>
              <th>{{$mission->operationRank}}</th>
              <th>{{$mission->date}}</th>
              <th>{{$mission->name}}</th>
            </tr>
          @endforeach
        </tbody>
      </table>
      @if($awards->count() > 0)
        <p class="awards">Шагнал:<br></p>
        <table id="dtMissions" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <th>Ажиллагааны нэр</th>
            <th>Ээлж</th>
            <th>Шагнал</th>
            <th>Бүртгэл хийсэн огноо</th>
            <th>Админ</th>
          </thead>
          <tbody>
            @foreach ($awards as $award)
              <tr>
                <th>{{$award->countryName}}</th>
                <th>{{$award->eelj}}</th>
                <th>{{$award->tailbar}}</th>
                <th>{{$award->date}}</th>
                <th>{{$award->name}}</th>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
      @if($punishments->count() > 0)
        <p class="punishments">Шийтгэл:<br></p>
        <table id="dtMissions" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <th>Ажиллагааны нэр</th>
            <th>Ээлж</th>
            <th>Шийтгэл</th>
            <th>Бүртгэл хийсэн огноо</th>
            <th>Админ</th>
          </thead>
          <tbody>
            @foreach ($punishments as $punishment)
              <tr>
                <th>{{$punishment->countryName}}</th>
                <th>{{$punishment->eelj}}</th>
                <th>{{$punishment->tailbar}}</th>
                <th>{{$punishment->date}}</th>
                <th>{{$punishment->name}}</th>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
      @if($punishments->count() > 0)
        <p class="punishments">Сургалт дамжаа:<br></p>
        <table id="dtMissions" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <th>Сургалтын төрөл</th>
            <th>Улс</th>
            <th>Тайлбар</th>
            <th>Явсан огноо</th>
            <th>Ирсэн огноо</th>
            <th>Бүртгэсэн огноо</th>
            <th>Админ</th>
          </thead>
          <tbody>
            @foreach ($trainings as $training)
              <tr>
                <th>{{$training->trainingTypeName}}</th>
                <th>{{$training->trainingCoutnry}}</th>
                <th>{{$training->trainingName}}</th>
                <th>{{$training->leaveDate}}</th>
                <th>{{$training->arriveDate}}</th>
                <th>{{$training->date}}</th>
                <th>{{$training->name}}</th>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
  </div>
@endsection
