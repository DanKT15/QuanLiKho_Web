<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách kho</b></a></li>
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

                          <a class="btn btn-add btn-sm" href="{{ route('kho.create') }}" title="Thêm"><i class="fas fa-plus"></i>Tạo Kho Mới</a></div>

                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Mã kho</th>
                                <th>Tên kho</th>
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($kho))
                                
                                @foreach ($kho as $key => $value)
                                    
                                    <tr>
                                        <td>{{ $value['MAKHO'] }}</td>
                                        <td>{{ $value['TENKHO'] }}</td>
                                        <td>{{ $value['SDT'] }}</td>
                                        <td>{{ $value['DC'] }}</td>
                                   
                                        <td>
                                            
                                            <a class="btn btn-primary btn-sm edit" href="{{ route('kho.edit', ['id' => $value['MAKHO']]) }}" title="Sửa"><i class="fas fa-edit"></i></a>
                                        
                                            <form class="btn" action="{{ route('kho.destroy', ['id' => $value['MAKHO']]) }}" method="post">
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
