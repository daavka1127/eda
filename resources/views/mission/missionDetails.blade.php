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
          <input type="button" id="btnEditEmpInfo" class="btn btn-warning btn-xs" name="" value="ЦАХ-ийн мэдээлэл засах" data-toggle="collapse" data-target="#collapseEmpInfo" />
          @include('mission.detailsEmpEditCollapse')

          <div class="clearfix"></div>

          <h3><strong>Энхийг сахиулах ажиллагааны мэдээлэл</strong></h3>
          <table id="dtMissionByRD" class="table table-striped table-bordered" style="width:100%;">
            <thead>
              <tr>
                <th>ID</th>
                <th>Улс код</th>
                <th>Ажиллагааны нэр</th>
                <th>Ээлж</th>
                <th>Цол</th>
                <th>Ажиллагааны албан тушаал</th>
                <th>Бүртгэл хийсэн огноо</th>
                <th>Админ</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="clearfix"></div>
        <input type="button" id="btnOnlyMissionNew" class="btn btn-success btn-xs" name="" value="Энэ ЦАХ-д ажиллагаа нэмэх" data-toggle="collapse" data-target="#collapseMissionNew" />
        <input type="button" id="btnOnlyMissionEdit" class="btn btn-warning btn-xs" name="" value="Энэ ЦАХ-ийн ажиллагааг засах" />
        <input type="button" post-url="{{url("delete/mission/only/mission")}}" id="btnOnlyMissionDelete" class="btn btn-danger btn-xs pull-right" name="" value="Устгах" />
        @include('mission.detailsMissionNewCollapse')
        @include('mission.detailsMissionEditCollapse')


        <div class="clearfix"></div>
        <h4><strong>Шагнал</strong></h4>
        <table post-url="{{url("/readmore/awards/rd")}}" id="dtAwardsByRD" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Улсын код</th>
              <th>Ажиллагааны улс</th>
              <th>Ээлж</th>
              <th>Шагнал</th>
              <th>Бүртгэл хийсэн огноо</th>
              <th>Админ</th>
            </tr>
          </thead>
        </table>
        <input type="button" id="btnOnlyAwardsNew" class="btn btn-success btn-xs" name="" value="Энэ ЦАХ-д шагнал нэмэх" data-toggle="collapse" data-target="#collapseAwardsNew" />
        <input type="button" id="btnOnlyAwardsEdit" class="btn btn-warning btn-xs" name="" value="Энэ ЦАХ-ийн шагнал засах" />
        <input type="button" post-url="{{url("")}}" id="btnOnlyMissionDelete" class="btn btn-danger btn-xs pull-right" name="" value="Устгах" />
        @include('mission.detailsAwardsNewCollapse')
        @include('mission.detailsAwardsEditCollapse')
        <div class="clearfix"></div>

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
        <div class="clearfix"></div>

        <h4><strong>Сургалт дамжаа</strong></h4>
        <table post-url="{{url("/get/mission/rd")}}" id="dtTrainingsByRD" class="table table-striped table-bordered" style="width:100%;">
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

<style media="screen">
  #dtMissionByRD tbody tr.selected {
    color: white;
    background-color: #4052e8;
  }
  #dtMissionByRD tbody tr{
    cursor: pointer;
  }

  #dtAwardsByRD tbody tr.selected {
    color: white;
    background-color: #4052e8;
  }
  #dtAwardsByRD tbody tr{
    cursor: pointer;
  }
</style>

<script type="text/javascript">

</script>
