<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Chi tiết Phiếu</b></a></li>
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
                            <a class="btn btn-add btn-sm" href="{{ route('phieunhapxuat.index') }}" title="Trở về">Danh sách phiếu</a>
                            <a class="btn btn-add btn-sm" href="{{ route('phieunhapxuat.pdf', ['id' => $phieu['id']]) }}" title="xuất file">Export Pdf</a>
                        </div>

                        </div>
                    </div>

                    @if (!empty($phieu))

                       <h3>Mã phiếu: {{ $phieu['SOPHIEU'] }}</h3>
                       <h3>Kho: {{ $kho }}</h3>
                       <b>Ngày lập: {{ $phieu['NGAYLAP'] }}</b><br>
                       <b>Người lập: {{ $nhanvien }}</b><br>

                       @if (!empty($Trangthai))
                            @foreach ($Trangthai as $key => $values)
                                @if ($values['MATT'] == $phieu['MATT'])
                                    <b>Loại phiếu: {{ $values['TENTT'] }}</b><br>
                                @endif
                            @endforeach
                        @endif

                        @if (!empty($DCnhapxuat))
                            @foreach ($DCnhapxuat as $key => $values)
                                @if ($values['MADC'] == $phieu['MADC'])
                                    <b>Điểm đến: {{ $values['TENDC'] }} - địa chỉ: {{ $values['DCNHAPXUAT'] }}</b><br><br>
                                @endif
                            @endforeach
                        @endif
                       
                
                     @endif

                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $tong = 0;
                            @endphp

                            @if (!empty($ctphieu))
                                
                                @foreach ($ctphieu as $key => $value)
                                    
                                    @php
                                        $tong += $value['THANHTIEN'];
                                    @endphp

                                    <tr>

                                        <td>{{ $value['MASP'] }}</td>

                                        @if (!empty($sanpham))
                                            @foreach ($sanpham as $key => $values)
                                                @if ($values['MASP'] == $value['MASP'])
                                                    <td>{{ $values['TENSP'] }}</td>
                                                @endif
                                            @endforeach
                                        @endif

                                        <td>{{ $value['SOLUONG'] }}</td>
                                        <td>{{ $value['DONGIA'] }}đ</td>
                                        <td>{{ $value['THANHTIEN'] }}đ</td>
                                    </tr>

                                @endforeach

                                {{-- @dd($ctphieu) --}}

                            @endif
                                        
                        </tbody>
                    </table>

                    <div>Tổng tiền: {{ $tong }}đ</div>

                </div>
            </div>
        </div>
    </div>
</main>
