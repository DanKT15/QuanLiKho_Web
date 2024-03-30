<br>
<br>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách Phiếu</li>
        <li class="breadcrumb-item">Tạo Phiếu Mới</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Tạo Phiếu Mới</h3>
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

            <form class="row" action="{{ route('phieunhapxuat.store') }}" method="post">
              @csrf
              
              <div class="form-group col-md-6">
                <label class="control-label">Mã Phiếu</label>
                <input class="form-control" name="sophieu" type="text" value="{{ old("sophieu") }}">
                @error('sophieu')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group col-md-3">
                <label for="exampleSelect1" class="control-label">Nơi Vận Chuyển</label>
                <select class="form-control" name="madiachi" id="exampleSelect1">

                  <option value="">Chọn</option> 

                  @foreach ($DCnhapxuat as $item)

                    @if (old('madiachi') == $item->MADC)
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

              <div class="form-group col-md-3">
                <label for="exampleSelect1" class="control-label">Trạng Thái</label>
                <select class="form-control" name="matrangthai" id="exampleSelect1">

                  <option value="">Chọn</option> 
                  
                  @foreach ($Trangthai as $item)

                    @if (old('matrangthai') == $item->MATT)
                      <option value="{{ $item->MATT }}" selected >{{ $item->TENTT }}</option>
                    @else
                      <option value="{{ $item->MATT }}">{{ $item->TENTT }}</option>
                    @endif

                  @endforeach

                </select>
                @error('matrangthai')
                    <span style="color: red">{{ $message }}</span>
                @enderror
              </div>

                <table style="border-collapse: collapse" cellspacing="0" cellpadding="0" class="table" id="dynamicAddRemove">
                  <tr>
                      <th>Sản Phẩm</th>
                      <th>Số Lượng</th>
                      <th>Chức Năng</th>
                  </tr>
                  <tr>
                      <td>
                        <div class="form-group col-md-12">
                          <select class="form-control" name="sp[0][idsp]" id="exampleSelect1">
            
                            <option value="">Chọn</option> 
                            
                            @foreach ($Sanpham as $item)

                              @if (old("sp.0.idsp") == $item->MASP )
                                <option value="{{ $item->MASP }}" selected >{{ $item->TENSP }}</option>
                              @else
                                <option value="{{ $item->MASP }}">{{ $item->TENSP }}</option>
                              @endif

                            @endforeach
            
                          </select>
                          @error("sp.0.idsp")
                              <span style="color: red">{{ $message }}</span>
                          @enderror
                        </div>
                      </td>

                      <td>
                        <div class="form-group col-md-12">
                          <input class="form-control" name="sp[0][slsp]" type="number" value="{{ old("sp.0.slsp") }}">
                          @error("sp.0.slsp")
                              <span style="color: red">{{ $message }}</span>
                          @enderror
                        </div>
                      </td>

                      <td>
                        <div class="form-group col-md-10">
                          <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Thêm SP</button>
                        </div>
                      </td>
                  </tr>



                  {{-- hien thi lai sp khi loi xay ra --}}
                  @php
                    $resul = old('sp');
                  @endphp
                  
                    @if ($resul)
                                            
                      @for ($i = 1; $i < count($resul); $i++)
                          
                          <tr>
                            <td>
                              <div class="form-group col-md-12">
                                <select class="form-control" name="sp[{{ $i }}][idsp]" id="exampleSelect1">
                  
                                  <option value="">Chọn</option> 
                                  
                                  @foreach ($Sanpham as $item)
      
                                    @if ($resul[$i]['idsp'] == null)
                                      <option value="">Chọn</option> 
                                    @endif

                                    @if ($resul[$i]['idsp'] == $item->MASP )
                                      <option value="{{ $item->MASP }}" selected >{{ $item->TENSP }}</option>
                                    @else
                                      <option value="{{ $item->MASP }}">{{ $item->TENSP }}</option>
                                    @endif
      
                                  @endforeach
                  
                                </select>
                                @error("sp.".$i.".idsp")
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                              </div>
                            </td>
      
                            <td>
                              <div class="form-group col-md-12">
                                <input class="form-control" name="sp[{{ $i }}][slsp]" type="number" value="{{ $resul[$i]['slsp'] }}">
                                @error("sp.".$i.".slsp")
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                              </div>
                            </td>
      
                            <td>
                              <div class="form-group col-md-10">
                                <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                              </div>
                            </td>
                        </tr>

                      @endfor
                      {{-- @dd($resul) --}}
                    @endif 
  

              </table>
        
              </div>
                <input class="btn btn-save" type="submit" name="submit" value="Lưu Lại">
                <a class="btn btn-cancel" href="{{ route('phieunhapxuat.index') }}">Hủy bỏ</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
</main>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    let i = 0;

    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr id = "id'+ i +'"></tr>');
        $("#id"+ i +"").append('<td><div class="form-group col-md-12"><select class="form-control" name="sp['+ i +'][idsp]" id="exampleSelect1"><option value="">Chọn</option>@foreach ($Sanpham as $item)<option value="{{ $item->MASP }}">{{ $item->TENSP }}</option>@endforeach</select>@error("sp.'+ i +'.idsp")<span style="color: red">{{ $message }}</span>@enderror</div></td>');
        $("#id"+ i +"").append('<td><div class="form-group col-md-12"><input class="form-control" name="sp['+ i +'][slsp]" type="number"">@error("sp.'+ i +'.slsp")<span style="color: red">{{ $message }}</span>@enderror</div></td>');
        $("#id"+ i +"").append('<td><div class="form-group col-md-10"><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></div></td>');
    });
    $(document).on('click', '.remove-input-field', function () {
         $(this).parents('tr').remove();
    });
</script>