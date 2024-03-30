<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">

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

            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">

                          <a class="btn btn-add btn-sm" href="{{ route('sanpham.create') }}" title="Thêm"><i class="fas fa-plus"></i>Tạo sản phẩm Mới</a>
                          <a class="btn btn-add btn-sm" href="{{ route('sanpham.tonkho') }}" title="Tồn Kho"><i class="fas fa-plus"></i>Tồn Kho</a>

                        </div>

                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Loại sản phẩm</th>
                                <th>Nhà cung cấp</th>
                                <th>Địa chỉ NCC</th>
                                <th>Thông tin</th>
                                <th>Giá sản phẩm</th>

                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($sanpham))
                                
                                @foreach ($sanpham as $key => $value)
                                    
                                    <tr>
                                        <td>{{ $value['MASP'] }}</td>
                                        <td>{{ $value['TENSP'] }}</td>

                                        @if (!empty($Loaisp))
                                            @foreach ($Loaisp as $keys => $values)
                                                @if ($values['MALOAI'] == $value['MALOAI'])
                                                    <td>{{ $values['TENLOAI'] }}</td>
                                                @endif   
                                            @endforeach
                                        @endif

                                        @if (!empty($Nhacungcap))
                                            @foreach ($Nhacungcap as $keys => $values)
                                                @if ($values['MANCC'] == $value['MANCC'])
                                                    <td>{{ $values['TENNCC'] }}</td>
                                                    <td>{{ $values['DC'] }}</td>
                                                @endif   
                                            @endforeach
                                        @endif
                                        
                                        <td>{{ $value['THONGTIN'] }}</td>
                                        <td>{{ $value['GIASP'] }}</td>

                                        <td>
                                            
                                            <a class="btn btn-primary btn-sm edit" href="{{ route('sanpham.edit', ['id' => $value['MASP']]) }}" title="Sửa"><i class="fas fa-edit"></i></a>
                                        
                                            <form class="btn" action="{{ route('sanpham.destroy') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="MASP" value="{{ $value['MASP'] }}">
                                                <button class="btn btn-primary btn-sm trash" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>

                                        </td>
                                    </tr>

                                @endforeach

                            @endif
                                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
