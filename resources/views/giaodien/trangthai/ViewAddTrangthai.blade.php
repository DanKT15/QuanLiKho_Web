<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách trạng thái</li>
        <li class="breadcrumb-item">Tạo trạng thái Mới</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Tạo trạng thái Mới</h3>
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

            <form class="row" action="{{ route('trangthai.store') }}" method="post">
              @csrf
              
              <div class="form-group col-md-6">
                <label class="control-label">Tên trạng thái</label>
                <input class="form-control" name="TENTT" type="text" value="{{ old("TENTT") }}">
                @error('TENTT')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              </div>
                <input class="btn btn-save" type="submit" name="submit" value="Lưu Lại">
                <a class="btn btn-cancel" href="{{ route('trangthai.index') }}">Hủy bỏ</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
</main>
