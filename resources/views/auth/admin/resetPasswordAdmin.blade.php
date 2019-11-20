<form action="{{ url('/reset/password/admin') }}" method="post">
    @csrf
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
    <label for="">Шинэ нууц үг: </label>
    <input type="password" name="password" class="form-control" required>
    <input type="hidden" name="id" value="{{$id}}" class="form-control">
</div>
<div class="clearfix"></div>
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
    <label for="">Шинэ нууц үг: </label>
    <input type="password" name="passwordRepeat" class="form-control" required>
</div>
<div class="clearfix"></div>
<br>
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
    <label for="">Өөрийн нууц үг: </label>
    <input type="password" name="authPassword" class="form-control" required>
</div>
<div class="clearfix"></div>
<div class="form-group">
  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    <button type="submit" class="btn btn-success">Нууц үг солих</button>
  </div>
</div>
<div class="clearfix"></div>
</form>
