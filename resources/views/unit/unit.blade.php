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
                 "url": "{{ url('units/ajax') }}",
                 "dataType": "json",
                 "type": "POST",
                 "data":{ _token: "{{csrf_token()}}"}
               },
        "columns": [
            { data: "id", name: "id" },
            { data: "unitParent", name: "unitParent" },
            { data: "unit", name: "unit" },
            { data: "memo", name: "memo" },
            { data: "action", name: "action" }
            ]
    });
});


    var newUrl = "{{ url('/new/unit/') }}";
    var editUrl = "{{ url('/update/unit/') }}";
    var deleteUnitUrl = "{{ url('/delete/unit') }}";
    var checkUnitIDUrl = "{{ url('/check/units/') }}";
    var loading_smallImageUrl = "{{url('public/images/loading_small.gif')}}";
    var correctImageUrl = "{{url('public/images/correct.png')}}";
    var wrongImageUrl = "{{url('public/images/wrong.png')}}";
</script>

<div class="form-group col-md-12">
      <h3><strong>Анги байгууллагууд</strong></h3>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
        <thead>
          <tr>
            <th>Ангийн код</th>
            <th>Харъяа</th>
            <th>Анги</th>
            <th>Тайлбар</th>
            <th style="width:16%"></th>
          </tr>
        </thead>

      </table>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newUnit">Анги нэмэх</button>
</div>

<script src="{{url('public/js/unit/unit.js')}}"></script>
@include('unit.unitNew')
@include('unit.unitEdit')
@endif
@endsection
