<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách sản phẩm</li>
        <li class="breadcrumb-item">Cập nhật sản phẩm</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Cập nhật sản phẩm</h3>
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

            <form class="row" action="{{ route('sanpham.update') }}" method="post">
              @csrf
              
              <div class="form-group col-md-5">
                <label class="control-label">Tên sản phẩm</label>
                <input class="form-control" name="TENSP" type="text" value="{{ $sanpham->TENSP }}">
                @error('TENSP')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
                <label class="control-label">Thông tin sản phẩm</label>
                <input class="form-control" name="THONGTIN" type="text" value="{{ $sanpham->THONGTIN }}">
                @error('THONGTIN')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
                <label class="control-label">Giá sản phẩm</label>
                <input class="form-control" name="GIASP" type="text" value="{{ $sanpham->GIASP }}">
                @error('GIASP')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>


              <div class="form-group col-md-3">
                <label for="exampleSelect1" class="control-label">Phân loại</label>
                <select class="form-control" name="MALOAI" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @if (!empty($Loaisp))
                      @foreach ($Loaisp as $keys => $values)
                          @if ($sanpham->MALOAI == $values['MALOAI'])
                              <option value="{{ $values['MALOAI'] }}" selected >{{ $values['TENLOAI'] }}</option>
                          @else
                              <option value="{{ $values['MALOAI'] }}">{{ $values['TENLOAI'] }}</option>
                          @endif   
                      @endforeach
                  @endif

                </select>
                @error('MALOAI')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>


              <div class="form-group col-md-3">
                <label for="exampleSelect1" class="control-label">Nhà cung cấp</label>
                <select class="form-control" name="MANCC" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @if (!empty($Nhacungcap))
                      @foreach ($Nhacungcap as $keys => $values)
                          @if ($sanpham->MANCC == $values['MANCC'])
                              <option value="{{ $values['MANCC'] }}" selected >{{ $values['TENNCC'] }}</option>
                          @else
                              <option value="{{ $values['MANCC'] }}">{{ $values['TENNCC'] }}</option>
                          @endif   
                      @endforeach
                  @endif

                </select>
                @error('MANCC')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <input type="hidden" name="MASP" value="{{ $sanpham->MASP }}">

            </div>
                <input class="btn btn-save" type="submit" name="submit" value="Cập nhật">
                <a class="btn btn-cancel" href="{{ route('sanpham.index') }}">Hủy bỏ</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
</main>
