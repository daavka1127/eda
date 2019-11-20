@extends('layouts.layout_main')

@section('content')
@section('content')
@if(Auth::user()->permission == 0)
  <p class="search-title">Та энэ хэсэг рүү нэвтрэх боломжгүй</p>
@else

  <!-- Datatables -->
  <script src="{{url('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

  <script>


$(document).ready(function() {
    $('#datatable').DataTable( {
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
                 "url": "{{ url('/get/sectors/by/country') }}",
                 "dataType": "json",
                 "type": "POST",
                 "data":{ _token: "{{csrf_token()}}", id: $("#cmbCountry").val()}
               },
        "columns": [
            { data: "id", name: "id" },
            { data: "countryName", name: "countryName" },
            { data: "sectorName", name: "sectorName" },
            { data: "action", name: "action" }
            ]
    });
});


    var newUrl = "{{ url('/new/sector') }}";
    var editUrl = "{{ url('/update/sector/') }}";
    var deleteUrl = "{{ url('/delete/sector') }}";
    var getSector = "{{ url('/get/sectors/by/country') }}";
    var loading_smallImageUrl = "{{url('public/images/loading_small.gif')}}";
    var correctImageUrl = "{{url('public/images/correct.png')}}";
    var wrongImageUrl = "{{url('public/images/wrong.png')}}";
</script>

<div class="form-group col-md-9">
      <div class="row">
        <div class="col-md-5">
          <h4 class="fore-red"><strong>Ажиллагааны нэр -> </strong></h4>
        </div>
        <div class="col-md-5">
          <select class="form-control" id="cmbCountry">
              <option value="-1">Сонгоно уу<option>
            @foreach($countries as $country)
              <option value="{{$country->id}}">{{$country->countryName}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <h3><strong>Цэргийн багийн салбар, нэгж</strong></h3>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
        <thead>
          <tr>
            <th>ID</th>
            <th>Улс</th>
            <th>Салбар</th>
            <th style="width:30%"></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newSector">Салбар нэмэх</button>
</div>

<script src="{{url('public/js/sector/sector.js')}}"></script>
@include('sector.sectorNew')
@include('sector.sectorEdit')
@endif
@endsection
