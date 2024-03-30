<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách nhân viên</b></a></li>
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

                          <a class="btn btn-add btn-sm" href="{{ route('taikhoan.create') }}" title="Thêm"><i class="fas fa-plus"></i>Thêm nhân viên Mới</a></div>

                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Mã nhân viên</th>
                                <th>Tên nhân viên</th>
                                <th>Giới tính</th>
                                <th>Kho</th>
                                <th>quyền hạn</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($User))
                                
                                {{-- @dd($User) --}}

                                @foreach ($User as $key)

                                    <tr>
                                        <td>{{ $key->MANV }}</td>
                                        <td>{{ $key->TENNV }}</td>
                                        <td>{{ $key->GIOITINH }}</td>
                                        <td>{{ $key->TENKHO }}</td>
                                        <td>{{ $key->QUANTRI }}</td>

                                        <td>
                                            
                                            <a class="btn btn-primary btn-sm edit" href="{{ route('taikhoan.edit', ['id' => $key->MANV]) }}" title="Sửa"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-primary btn-sm edit" href="{{ route('taikhoan.show', ['id' => $key->MANV]) }}" title="Chi tiết"><i class="fas fa-edit"></i></a>
                                            <form class="btn" action="{{ route('taikhoan.destroy') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="MANV" value="{{ $key->MANV }}">
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
