{{-- START NEW COUNTRY --}}
<div class="modal fade" id="detailsEmpMission">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body" id="modal-body-details">
        {{-- <form id="frmNewCountry" action="{{ action('countryController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"> --}}
        <div id="frmMissionDetails" method="post" data-parsley-validate class="form-horizontal form-label-left">
          <input name="_token" type="hidden" value="{{ csrf_token() }}" />
          <h4>Цэргийн албан хаагч</h4>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label id="lblRd">Регистрийн дугаар: ЖК89112712 </label>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label id="lblLastName">Овог: Базаржав </label>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label id="lblFirstName">Нэр: Даваабат </label>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label id="lblUnit">Анги: ЗХ-189 </label>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-8">
              <label id="lblAlbanTushaal">Албан тушаал: Программ зохиогч </label>
          </div>
          <div class="clearfix"></div>
          <h3><strong>Энхийг сахиулах ажиллагааны мэдээлэл</strong></h3>
          <table id="dtMissionByRD" class="table table-striped table-bordered" style="width:100%;">
            <thead>
              <tr>
                <th>ID</th>
                <th>Ажиллагааны улс</th>
                <th>Ээлж</th>
                <th>Салбар</th>
                <th>Ажиллагааны цол</th>
                <th>Ажиллагааны албан тушаал</th>
                <th>Бүртгэл хийсэн огноо</th>
                <th>Админ</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="clearfix"></div>
        <h4><strong>Шагнал</strong></h4>
        <table id="dtAwardsByRD" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th>Ажиллагааны улс</th>
              <th>Ээлж</th>
              <th>Шагнал</th>
              <th>Бүртгэл хийсэн огноо</th>
              <th>Админ</th>
            </tr>
          </thead>
        </table>
        <h4><strong>Шийтгэл</strong></h4>
        <table id="dtPunishmentsByRD" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th>Ажиллагааны улс</th>
              <th>Ээлж</th>
              <th>Шийтгэл</th>
              <th>Бүртгэл хийсэн огноо</th>
              <th>Админ</th>
            </tr>
          </thead>
        </table>
        <h4><strong>Сургалт дамжаа</strong></h4>
        <table id="dtTrainingsByRD" class="table table-striped table-bordered" style="width:100%;">
            <thead>
                <tr>
                    <th>Сургалтын төрөл</th>
                    <th>Улс</th>
                    <th>Тайлбар</th>
                    <th>Явсан огноо</th>
                    <th>Ирсэн огноо</th>
                    <th>Бүртгэсэн огноо</th>
                    <th>Админ</th>
                </tr>
            </thead>
        </table>
      </div>
      {{-- END MODAL BODY --}}
      <div class = "modal-footer">
        <button type="button" id="btnPrintEmpMissionDetails" class="btn btn-basic">Хэвлэх</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END NEW COUNTRY --}}
