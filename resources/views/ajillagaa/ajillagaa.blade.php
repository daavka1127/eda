@extends('layouts.layout_main')

@section('content')
@if(Auth::user()->permission == 0)
  <p class="search-title">Та энэ хэсэг рүү нэвтрэх боломжгүй</p>
@else
  {{-- START Country --}}
  <script>
      var correctImageUrl = "{{url('public/images/correct.png')}}";
      var wrongImageUrl = "{{url('public/images/wrong.png')}}";
      var loading_smallImageUrl = "{{url('public/images/loading_small.gif')}}";

      var newUrl = "{{ url('/new/country/') }}";
      var editUrl = "{{ url('/update/country/') }}";
      var deleteUrl = "{{ url('/delete/country/') }}";
      var showCountryUrl = "{{ url('/show/country/') }}";
      var loadingImageUrl = "{{ url('public/images/loading.gif') }}";
      var getCountriesUrl = "{{ url('/get/country') }}";
      var lastIndex = null;

      var newOperationUrl = "{{ url('/new/operation/') }}";
      var editOperationUrl = "{{ url('/update/operation/') }}";
      var deleteOperationUrl = "{{ url('/delete/operation/') }}";
      var showOperationUrl = "{{ url('/show/operation/') }}";
      var checkOperationInsert = "{{ url('/check/operation/') }}";
  </script>
  <script src="{{url('public/js/country/country.js')}}"></script>
  <script src="{{url('public/js/ajillagaa/operation.js')}}"></script>

  <div class="col-md-5">
    <div id="countries">
      <h3><strong>Ажиллагааны улс</strong></h3>
      <table class="table">
        <thead>
          <tr>
            <th>№</th>
            <th>Улс</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($countries as $country)
            <tr id="row{{$country->id}}">
              <td>{{$i}}</td>
              <td id="clCountryName{{$country->id}}">
                {{$country->countryName}}
                <input type="hidden" value="{{$country->countryName}}" id="countryName" />
              </td>
              <td>
                <input type="button" class="btn btn-warning" value="Засах" onclick="editCountry({{$country->id}}, '{{$country->countryName}}')" />
                <input type="button" class="btn btn-danger" value="Устгах" onclick="deleteCountry({{$country->id}})" />
              </td>
            </tr>
            @php $i++; @endphp
          @endforeach
          <script>lastIndex = {{$i}};</script>
        </tbody>
      </table>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newCountry">Улс нэмэх</button>
    </div>
    {!!session('success_message')!!}
    {!!session('error_message')!!}
    {{session(['success_message' => ''])}}
    {{session(['error_message' => ''])}}
    @include('country.countryNew')
    @include('country.countryEdit')
  </div>
  {{-- END Country --}}



  <div class="col-md-7">
    {{-- START OPERATION DIV --}}
    <div id="operations">
      <h3><strong>Явагдсан ажиллагаа</strong></h3>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="cmbCountry" id="cmbCountry" class="form-control">
          <option value="-1">Сонгоно уу</option>
          @foreach ($countries as $country)
              <option value="{{$country->id}}">{{$country->countryName}}</option>
          @endforeach
        </select>
      </div>
      <table class="table" id="operations">
        <thead>
          <tr>
            <th>№</th>
            <th>Улс</th>
            <th>Ээлж</th>
            <th>Явсан өдөр</th>
            <th>Ирсэн өдөр</th>
          </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($operations as $operation)
            <tr id="row{{$operation->id}}">
              <td>{{$i}}</td>
              <td>{{$operation->countryName}}</td>
              <td>{{$operation->eelj}}</td>
              <td>{{$operation->leaveDate}}</td>
              <td>{{$operation->arriveDate}}</td>
              <td>
                <input type="button" class="btn btn-warning" value="Засах" onclick="editOperation({{$operation->id}}, '{{$operation->country}}', {{$operation->eelj}}, '{{$operation->leaveDate}}', '{{$operation->arriveDate}}')" />
                <input type="button" class="btn btn-danger" value="Устгах" onclick="deleteOperation({{$operation->id}})" />
              </td>
            </tr>
            @php $i++; @endphp
          @endforeach
          <script>lastIndex = {{$i}};</script>
        </tbody>
      </table>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOperation">Ажиллагаа нэмэх</button>
    </div>
    {{-- END OPERATION DIV --}}
    @include('ajillagaa.operationNew')
    @include('ajillagaa.operationEdit')
  </div>
@endif
@endsection
