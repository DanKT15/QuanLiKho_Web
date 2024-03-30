<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách trạng thái</b></a></li>
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

                          <a class="btn btn-add btn-sm" href="{{ route('trangthai.create') }}" title="Thêm"><i class="fas fa-plus"></i>Tạo trạng thái Mới</a></div>

                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Mã trạng thái</th>
                                <th>Tên trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($trangthai))
                                
                                @foreach ($trangthai as $key => $value)
                                    
                                    <tr>
                                        <td>{{ $value['MATT'] }}</td>
                                        <td>{{ $value['TENTT'] }}</td>

                                        <td>
                                            
                                            <a class="btn btn-primary btn-sm edit" href="{{ route('trangthai.edit', ['id' => $value['MATT']]) }}" title="Sửa"><i class="fas fa-edit"></i></a>
                                        
                                            <form class="btn" action="{{ route('trangthai.destroy') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="MATT" value="{{ $value['MATT'] }}">
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
