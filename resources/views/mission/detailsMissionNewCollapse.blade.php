{{-- START MISSION NEW COLLAPSE --}}
<div class="collapse" id="collapseMissionNew">
  <div class="card card-body">
    <form method="post" id="frmMissionDetailsMissionEditAndNew">
      <input name="_token" type="hidden" value="{{ csrf_token() }}" />
      <label class="col-md-12 control-label text-center text-success" for="">Ажиллагааны мэдээлэл нэмэх</label>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Ажиллагааны нэр: </label>
          <select class="form-control" name="country" id="cmbDetailsCountryNew" />
              <option value="-1">Сонгоно уу</option>
              @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->countryName}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
        <label>Ээлжийн дугаар</label>
        <select class="form-control" name="cmbEelj" id="cmbDetailsEeljNew">
            <option value="-1">Сонгоно уу</option>
        </select>
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Цол: </label>
          <input type="text" id="txtDetailsRankNew" class="form-control">
      </div>
      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
          <label for="">Ажиллагааны албан тушаал: </label>
          <input type="text" id="txtDetailsPositionNew" class="form-control">
      </div>
      <div class="clearfix"></div>

      <div class="col-md-6" id="error_message"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button id="btnDetailsMissionNew" post-url="{{url("new/mission/only/mission")}}" type="submit" class="btn btn-success btn-xs">Нэмэх</button>
        </div>
      </div>
    </form>
  </div>
</div>
{{-- END MISSION NEW COLLAPSE --}}
