<form action="{{ url('/update/admin') }}" method="post">
    @csrf
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
        <label for="">Нэр: </label>
        <input type="text" value="{{ $admin->name }}" name="name" class="form-control" required>
        <input type="hidden" value="{{ $admin->id }}" name="id" class="form-control" required>
    </div>
    <div class="clearfix"></div>
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
        <label for="">Цахим хаяг: </label>
        <input type="text" value="{{ $admin->email }}" name="email" class="form-control" required>
    </div>
    <div class="clearfix"></div>
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
        <label for="">Хэрэглэгчийн эрх: </label>
        <select class="form-control" name="permission" required>
            @if ($admin->permission == 0)
              <option value="0" selected>Хязгаарлагдмал эрхтэй</option>
            @else
              <option value="0">Хязгаарлагдмал эрхтэй</option>
            @endif
            @if ($admin->permission == 1)
              <option value="1" selected>Бүрэн эрхтэй</option>
            @else
              <option value="1">Бүрэн эрхтэй</option>
            @endif
        </select>
    </div>
    <div class="clearfix"></div>
    <input type="submit" name="btnUpdate" value="Засах" class="form-control" />
    <div class="clearfix"></div>
</form>
