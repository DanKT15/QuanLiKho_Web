<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách nhân viên</li>
        <li class="breadcrumb-item">Thêm nhân viên Mới</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Thêm nhân viên Mới</h3>
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

            <form class="row" action="{{ route('taikhoan.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group col-md-6">
                <label class="control-label">Tên TENNV</label>
                <input class="form-control" name="TENNV" type="text" value="{{ old("TENNV") }}">
                @error('TENNV')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">email</label>
                <input class="form-control" name="email" type="email" value="{{ old("email") }}">
                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">password</label>
                <input class="form-control" name="password" type="password" value="{{ old("password") }}">
                @error('password')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">SDT</label>
                <input class="form-control" name="SDT" type="tel" value="{{ old("SDT") }}">
                @error('SDT')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">DC</label>
                <input class="form-control" name="DC" type="text" value="{{ old("DC") }}">
                @error('DC')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">GIOITINH</label>
                <select class="form-control" name="GIOITINH" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @if (old('GIOITINH') == 'Nam')
                    <option value="Nam" selected>Nam</option> 
                    <option value="Nữ">Nữ</option>
                  @endif 

                  @if (old('GIOITINH') == 'Nữ')
                    <option value="Nam">Nam</option> 
                    <option value="Nữ" selected>Nữ</option>
                  @endif 

                  @if (!old('GIOITINH'))
                    <option value="Nam">Nam</option> 
                    <option value="Nữ">Nữ</option>
                  @endif
                  
                </select>
                @error('GIOITINH')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">KHO</label>
                <select class="form-control" name="KHO" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @isset($kho)
                      @foreach ($kho as $keys => $values)
                          @if (old('KHO') == $values['MAKHO'])
                              <option value="{{ $values['MAKHO'] }}" selected >{{ $values['TENKHO'] }}</option>
                          @else
                              <option value="{{ $values['MAKHO'] }}">{{ $values['TENKHO'] }}</option>
                          @endif   
                      @endforeach
                  @endisset

                </select>
                @error('KHO')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">QUYEN</label>
                <select class="form-control" name="QUYEN" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @if (old('QUYEN') == 'quantri')
                    <option value="quantri" selected>Admin</option> 
                    <option value="nhanvien">Staff</option> 
                  @endif 

                  @if (old('QUYEN') == 'nhanvien')
                    <option value="quantri">Admin</option> 
                    <option value="nhanvien" selected>Staff</option> 
                  @endif

                  @if (!old('QUYEN'))
                    <option value="quantri">Admin</option> 
                    <option value="nhanvien">Staff</option> 
                  @endif

                </select>
                @error('QUYEN')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">HINHANH</label>
                <div id="myfileupload">
                  <input type="file" id="uploadfile" name="HINHANH"/>
                </div>
                <div id="thumbbox">
                  <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
                  <a class="removeimg" href="javascript:"></a>
                </div>
                <div id="boxchoice">
                  <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</a>
                  <p style="clear:both"></p>
                </div>
                @error('HINHANH')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              </div>
                <input class="btn btn-save" type="submit" name="submit" value="Lưu Lại">
                <a class="btn btn-cancel" href="{{ route('taikhoan.index') }}">Hủy bỏ</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
</main>
