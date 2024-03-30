<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách nhân viên</li>
        <li class="breadcrumb-item">Cập nhật thông tin nhân viên</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Cập nhật thông tin nhân viên</h3>
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

            <form class="row" action="{{ route('taikhoan.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              
              {{-- @dd($user[0]->TENNV) --}}

              <div class="form-group col-md-5">
                <label class="control-label">Tên TENNV</label>
                <input class="form-control" name="TENNV" type="text" value="{{ $user[0]->TENNV }}">
                @error('TENNV')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              {{-- <div class="form-group col-md-5">
                <label class="control-label">email</label>
                <input class="form-control" name="email" type="email" value="{{ $user[0]->email }}">
                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div> --}}

              <div class="form-group col-md-5">
                <label class="control-label">password</label>
                <input class="form-control" name="password" type="password" value="">
                @error('password')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
                <label class="control-label">SDT</label>
                <input class="form-control" name="SDT" type="tel" value="{{ $user[0]->SDT }}">
                @error('SDT')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
                <label class="control-label">DC</label>
                <input class="form-control" name="DC" type="text" value="{{ $user[0]->DC }}">
                @error('DC')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
                <label for="exampleSelect1" class="control-label">GIOITINH</label>
                <select class="form-control" name="GIOITINH" id="exampleSelect1">

                  <option value="">Chọn</option>  

                  @switch($user[0]->GIOITINH)
                      @case('Nam')
                          <option value="Nam" selected>Nam</option> 
                          <option value="Nữ">Nữ</option>
                          @break
                      @case('Nữ')
                          <option value="Nam">Nam</option> 
                          <option value="Nữ" selected>Nữ</option>
                          @break
                      @default
                          <option value="Nam">Nam</option> 
                          <option value="Nữ" >Nữ</option>
                  @endswitch
                  
                </select>
                @error('GIOITINH')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
                <label for="exampleSelect1" class="control-label">KHO</label>
                <select class="form-control" name="KHO" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @isset($kho)
                      @foreach ($kho as $keys => $values)
                          @if ($user[0]->MAKHO == $values['MAKHO'])
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

              <div class="form-group col-md-5">
                <label for="exampleSelect1" class="control-label">QUYEN</label>
                <select class="form-control" name="QUYEN" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @if ($user[0]->QUANTRI == 'quantri')
                    <option value="quantri" selected>Admin</option> 
                    <option value="nhanvien">Staff</option> 
                  @endif 

                  @if ($user[0]->QUANTRI == 'nhanvien')
                    <option value="quantri">Admin</option> 
                    <option value="nhanvien" selected>Staff</option> 
                  @endif

                </select>
                @error('QUYEN')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-5">
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

              <input type="hidden" name="OLDHINHANH" value="{{ $user[0]->HINHANH }}">
              <input type="hidden" name="MANV" value="{{ $user[0]->MANV }}">

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
