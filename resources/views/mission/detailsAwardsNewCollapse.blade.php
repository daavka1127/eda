{{-- START MISSION NEW COLLAPSE --}}
<div class="collapse" id="collapseAwardsNew">
  <div class="card card-body">
    <form method="post" id="frmDetailsAwardsNew">
      <input name="_token" type="hidden" value="{{ csrf_token() }}" />
      <label class="col-md-12 control-label text-center text-success" for="">Ажиллагааны шагнал нэмэх</label>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Ажиллагааны нэр: </label>
          <select class="form-control" name="country" id="cmbDetailsAwardsCountryNew" />
              <option value="-1">Сонгоно уу</option>
          </select>
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
        <label>Ээлжийн дугаар</label>
        <select class="form-control" name="cmbEelj" id="cmbDetailsAwardsEeljNew">
            <option value="-1">Сонгоно уу</option>
        </select>
      </div>
      <div class="form-group col-xs-10 col-sm-6 col-md-6">
          <label for="">Тайлбар: </label>
          <input type="text" id="txtDetailsAwardsMemoNew" class="form-control">
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
