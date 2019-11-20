@extends('layouts.layout_main')

@section('content')
  @if(Auth::user()->permission == 0)
    <p class="search-title">Та энэ хэсэг рүү нэвтрэх боломжгүй</p>
  @else
    <script>
      var getEeljUrl = "{{ url('/get/eelj') }}";
    </script>
    <form action="{{ url('/import/excel') }}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
        <label>Ажиллагааны нэр</label>
        <select class="form-control" name="country" id="country" required>
          <option value="0">Сонгоно уу</option>
          @foreach ($countries as $country)
            <option value="{{$country->id}}">{{$country->countryName}}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
        <label>Ээлж</label>
        <select class="form-control" name="eelj" id="eelj" required>
        </select>
    </div>
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-9">
        {{ csrf_field() }}
        <label>Зөвхөн excel файл оруулах боломжтой</label>
        <input type="file" name="fileExcel" id="filePdf" class="form-control">
        <button type="submit" class="btn btn-success" name="btnUploadExcel">Файл оруулах</button>
    </div>
    </form>
    <div class="clearfix"></div>
    @if(isset($errors) && count($errors) > 0)
      <h3><strong>Дараах мөрүүд алдаатай байна</strong></h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Регистрийн дугаар</th>
            <th>Овог</th>
            <th>Нэр</th>
            <th>Хүйс</th>
            <th>Анги</th>
            <th>Албан тушаал</th>
            <th>Улс</th>
            <th>Ээлж</th>
            <th>Салбар</th>
            <th>Цол</th>
            <th>Ажиллагааны албан тушаал</th>
            <th>Алдааны тайлбар</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($errors as $error)
              <tr>
                <th>{{$error->RD}}</th>
                <th>{{$error->ovog}}</th>
                <th>{{$error->ner}}</th>
                <th>{{$error->huis}}</th>
                <th>{{$error->unit}}</th>
                <th>{{$error->albanTushaal}}</th>
                <th>{{$error->uls}}</th>
                <th>{{$error->eelj}}</th>
                <th>{{$error->salbar}}</th>
                <th>{{$error->tsol}}</th>
                <th>{{$error->a_alban_tushaal}}</th>
                <th>{{$error->tailbar}}</th>
              </tr>
            @endforeach
        </tbody>
      </table>
    @endif
    <script src="{{ url('/public/js/excel/excel.js') }}"></script>
  @endif
@endsection
