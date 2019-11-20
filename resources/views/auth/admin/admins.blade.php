@extends('layouts.layout_main')
@section('content')
@if(Auth::user()->permission == 0)
  <p class="search-title">Та энэ хэсэг рүү нэвтрэх боломжгүй</p>
@else
  <script>
    var checkPasswordUrl = "{{ url("/check/admin/password") }}";
    var loadingImageUrl = "{{ url("/public/images/loading.gif") }}";
    var getCheckPassword= "{{ url("/get/checkPassword") }}";
    var passwordResetUrl = "{{ url('/show/password/reset') }}";
  </script>
  <script src="{{url('public/js/admin/admin.js')}}"></script>
  <div class="clearfix"></div>
  @if(isset($successMessage))
    <div class="alert alert-success">
      <strong>{{$successMessage}}</strong>
    </div>
  @endif
  @if(isset($error))
    <div class="alert alert-danger">
      <strong>{{$error}}</strong>
    </div>
  @endif
  @if(isset($success))
    <div class="alert alert-success">
      <strong>{{$success}}</strong>
    </div>
  @endif
  <h3><strong>Админ засах</strong></h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Нэр</th>
        <th>Цахим хаяг</th>
        <th>Админы төрөл</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @if(count($admins)>0)
        @php
          $i=1;
        @endphp
        @foreach ($admins as $admin)
          <tr>
            <th>{{$i}}</th>
            <th>{{$admin->name}}</th>
            <th>{{$admin->email}}</th>
            <th>
              @if($admin->permission == 1)
                Бүрэн эрхтэй
              @else
                Хязгаарлагдмал эрхтэй
              @endif
            </th>
            <th>
                <input type="button" id="btnUpdateAdmin" onclick="btnClickAdminUpdate({{$admin->id}})" value="Засах">
                <input type="button" id="btnResetPasswordAdmin" onclick="btnResetPasswordAdmin_click({{$admin->id}})" value="Нууц үг солих">
            </th>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  {{-- START NEW COUNTRY --}}
  <div class="modal fade" id="modalUpdateAdmin">
    <div class="modal-dialog" style="width:30%;">
      <div class="modal-content">

        <div class="modal-header">
          <h3 class="modal-title">Админ эрх засах</h3>
          <button type="button" class="close" data-dismiss="modal">X</button>
        </div>

        <div class="modal-body">
          {{-- <form id="frmNewCountry" action="{{ action('countryController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"> --}}
          <div id="modalContent">

          </div>
        </div>

        <div class = "modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
        </div>

      </div>
    </div>
  </div>
  {{-- END NEW COUNTRY --}}
@endif
@endsection
