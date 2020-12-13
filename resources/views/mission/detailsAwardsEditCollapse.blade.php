{{-- START MISSION NEW COLLAPSE --}}
<div class="collapse" id="collapseAwardsEdit">
  <div class="card card-body">
    <form method="post" id="frmDetailsAwardsEdit">
      <input name="_token" type="hidden" value="{{ csrf_token() }}" />
      <label class="col-md-12 control-label text-center text-warning" for="">Ажиллагааны шагнал засах</label>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Ажиллагааны нэр: </label>
          <select post-url="{{url("/mission/get/assigned/country")}}" class="form-control" name="country" id="cmbDetailsAwardsCountryEdit" />
              <option value="-1">Сонгоно уу</option>
          </select>
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
        <label>Ээлжийн дугаар</label>
        <select post-url="{{url("/mission/get/assigned/country/eelj")}}" class="form-control" name="cmbEelj" id="cmbDetailsAwardsEeljEdit">
            <option value="-1">Сонгоно уу</option>
        </select>
      </div>
      <div class="form-group col-xs-10 col-sm-6 col-md-6">
          <label for="">Тайлбар: </label>
          <input type="text" id="txtDetailsAwardsMemoEdit" class="form-control">
      </div>
      <div class="clearfix"></div>

      <div class="col-md-6" id="error_message"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button id="btnDetailsAwardsMissionNew" post-url="{{url("")}}" type="submit" class="btn btn-success btn-xs">Нэмэх</button>
        </div>
      </div>
    </form>
  </div>
</div>
{{-- END MISSION NEW COLLAPSE --}}
