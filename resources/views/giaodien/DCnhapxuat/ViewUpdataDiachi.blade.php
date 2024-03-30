<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách địa chỉ</li>
        <li class="breadcrumb-item">Cập nhật địa chỉ</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Cập nhật địa chỉ</h3>
          <div class="tile-body">

            @if (Session::Has('alert'))
              <div class="alert alert-success">
                  <strong>Success!</strong> {{ Session::Get('alert') }}.
              </div>
            @endif

            @if (Session::Has('err'))
              <div class="alert alert-warning">
                  <strong>Error!</strong> {{ Session::Get('err') }}.
              </div>
            @endif

            <form class="row" action="{{ route('diachinhapxuat.update') }}" method="post">
              @csrf
              
              <div class="form-group col-md-5">
                <label class="control-label">Tên địa chỉ</label>
                <input class="form-control" name="TENDC" type="text" value="{{ $diachi->TENDC }}">
                @error('TENDC')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
                <label class="control-label">Chi tiết địa chỉ</label>
                <input class="form-control" name="DCNHAPXUAT" type="text" value="{{ $diachi->DCNHAPXUAT }}">
                @error('DCNHAPXUAT')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <input type="hidden" name="MADC" value="{{ $diachi->MADC }}">

              </div>
                <input class="btn btn-save" type="submit" name="submit" value="Lưu Lại">
                <a class="btn btn-cancel" href="{{ route('diachinhapxuat.index') }}">Hủy bỏ</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
</main>
