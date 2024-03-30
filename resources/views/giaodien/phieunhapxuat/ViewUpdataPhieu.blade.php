<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách Phiếu</li>
        <li class="breadcrumb-item">Cập nhật phiếu</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Cập Nhật Phiếu</h3>
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

            <form class="row" action="{{ route('phieunhapxuat.update') }}" method="post">
              @csrf
              
               @php
                  $sophieu = explode( '-', $phieu['SOPHIEU']);
               @endphp
                       
                <div class="form-group col-md-6">
                    <label class="control-label">Mã Phiếu</label>
                    <input class="form-control" name="sophieu" type="text" value="{{ $sophieu[0] }}">
                    @error('sophieu')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleSelect1" class="control-label">Nơi Vận Chuyển</label>
                    <select class="form-control" name="madiachi" id="exampleSelect1">

                        <option value="">Chọn</option> 

                        @foreach ($DCnhapxuat as $item)

                            @if ($phieu['MADC'] == $item->MADC)
                                <option value="{{ $item->MADC }}" selected >{{ $item->TENDC }}</option>
                            @else
                                <option value="{{ $item->MADC }}">{{ $item->TENDC }}</option>
                            @endif

                        @endforeach

                    </select>
                    @error('madiachi')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" name="idphieu" value="{{ $phieu['id'] }}">

                </div>
                    <input class="btn btn-save" type="submit" name="submit" value="Lưu Lại">
                    <a class="btn btn-cancel" href="{{ route('phieunhapxuat.index') }}">Hủy bỏ</a>
                </div>

             

              {{-- @dd($phieu['MADC']) --}}

            </form>
          </div>
        </div>
      </div>
    </div>
</main>