@extends('layouts.layout_main')

@section('content')
@if(Auth::user()->permission == 0)
  <p class="search-title">Та энэ хэсэг рүү нэвтрэх боломжгүй</p>
@else
  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-9">
    <form action="{{ url('/upload/pdf') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <label>Зөвхөн *.pdf өргөтгөлтэй файл оруулах боломжтой</label>
      <input type="file" name="filePdf" id="filePdf" class="form-control">
      <button type="submit" class="btn btn-success" name="btnUploadPdf">Файл оруулах</button>
    </form>
  </div>
@endif
@endsection
