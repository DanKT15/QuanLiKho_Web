<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách nhà cung cấp</li>
        <li class="breadcrumb-item">Cập Nhật nhà cung cấp </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Cập Nhật nhà cung cấp </h3>
          <div class="tile-body">

            @if (Session::Has('alert'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ Session::Get('alert') }}.
              </div>
            @endif
            
            <form class="row" action="{{ route('nhacungcap.update') }}" method="post">
              @csrf
              
              <div class="form-group col-md-3">
                <label class="control-label">Tên nhà cung cấp</label>
                <input class="form-control" name="TENNCC" type="text" value="{{ $ncc->TENNCC }}">
              </div>
              <div class="form-group col-md-2">
                <label class="control-label">SĐT</label>
                <input class="form-control" name="SDT" type="text" value="{{ $ncc->SDT }}">
              </div>
              <div class="form-group col-md-5">
                <label class="control-label">Địa chỉ nhà cung cấp</label>
                <input class="form-control" name="DC" type="text" value="{{ $ncc->DC }}">
              </div>
              <input type="hidden" name="MANCC" value="{{ $ncc->MANCC }}">
              </div>
                <input class="btn btn-save" type="submit" name="submit" value="Lưu Lại">
                <a class="btn btn-cancel" href="{{ route('nhacungcap.index') }}">Hủy bỏ</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
</main>