<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách Loại Sản Phẩm</b></a></li>
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

                          <a class="btn btn-add btn-sm" href="{{ route('loaisp.create') }}" title="Thêm"><i class="fas fa-plus"></i>Tạo Loại Sản Phẩm Mới</a></div>

                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Mã loại sản phẩm</th>
                                <th>Tên loại sản phẩm</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($loai))
                                
                                @foreach ($loai as $key => $value)
                                    
                                    <tr>
                                        <td>{{ $value['MALOAI'] }}</td>
                                        <td>{{ $value['TENLOAI'] }}</td>

                                        <td>
                                            
                                            <a class="btn btn-primary btn-sm edit" href="{{ route('loaisp.edit', ['id' => $value['MALOAI']]) }}" title="Sửa"><i class="fas fa-edit"></i></a>
                                        
                                            <form class="btn" action="{{ route('loaisp.destroy',['id' => $value['MALOAI']]) }}" method="post">
                                                @csrf
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
