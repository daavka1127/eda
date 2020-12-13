{{-- START EMPLOYEE EDIT COLLAPSE --}}
<div class="collapse" id="collapseEmpInfo">
  <div class="card card-body">
    <form method="post" id="frmMissionDetailsEmpEdit1">
      <input name="_token" type="hidden" value="{{ csrf_token() }}" />
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Регистрийн дугаар: </label>
          <input type="text" id="txtDetailsEditRegister" maxlength="10" class="form-control">
          <input type="hidden" id="hideDetailsEditOldRegister" maxlength="10" class="form-control">
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Овог: </label>
          <input type="text" id="txtDetailsEditLastname" class="form-control">
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Нэр: </label>
          <input type="text" id="txtDetailsEditFirstname" class="form-control">
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Анги: </label>
          <input type="text" class="form-control" id="cmbDetailsEditUnit" name="cmbEditUnit" />
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
          <label for="">Албан тушаал: </label>
          <input type="text" id="txtDetailsEditRank" class="form-control">
      </div>

      <div class="clearfix"></div>

      <div class="col-md-6" id="error_message"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button id="btnDetailsEditEmpMissionPost" post-url="{{url("update/employee")}}" type="submit" class="btn btn-success btn-xs">Засах</button>
        </div>
      </div>
    </form>
  </div>
</div>
{{-- END EMPLOYEE EDIT COLLAPSE --}}
