<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách Loại Sản Phẩm</li>
        <li class="breadcrumb-item">Tạo Loại Sản Phẩm Mới</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Tạo Loại Sản Phẩm Mới</h3>
          <div class="tile-body">

            @if (Session::Has('alert'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ Session::Get('alert') }}.
              </div>
            @endif
            
            <form class="row" action="{{ route('loaisp.store') }}" method="post">
              @csrf
              
              <div class="form-group col-md-3">
                <label class="control-label">Tên loại sản phẩm</label>
                <input class="form-control" name="TENLOAI" type="text" value="">
              </div>

              </div>
                <input class="btn btn-save" type="submit" name="submit" value="Lưu Lại">
                <a class="btn btn-cancel" href="{{ route('loaisp.index') }}">Hủy bỏ</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
</main>