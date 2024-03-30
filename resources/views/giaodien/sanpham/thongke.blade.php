<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Tồn Kho</b></a></li>
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
            
                            <form action="{{ route('sanpham.pdfthongke') }}" method="post">
                                @csrf

                                @if (isset($thongke) && isset($thongke[0]->date1) && isset($thongke[0]->date2))
                                    <input class="form-control" type="hidden" name="date1" value="{{ $thongke[0]->date1 }}">
                                    <input class="form-control" type="hidden" name="date2" value="{{ $thongke[0]->date2 }}">
                                    <input class="form-control" type="hidden" name="logic" value="1">
                                @else
                                    <input class="form-control" type="hidden" name="logic" value="0">
                                @endif

                                <button class="btn btn-add btn-sm">Export Pdf</button>
                            </form>

                        </div>
                    </div>

                    <form class="row" action="{{ route('sanpham.tonkhoDate') }}" method="post">
                        @csrf
                        <div class="form-group col-md-5">
                            <input class="form-control" type="date" name="date1">
                        </div>
                        <div class="form-group col-md-5">
                            <input class="form-control" type="date" name="date2">
                        </div>
                        <div class="form-group col-md-2">
                            <button class="form-control" type="submit">Thống kê</button>
                        </div>
                    </form>

                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng nhập</th>
                                <th>Số lượng xuất</th>
                                <th>Tồn kho</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @dd($thongke) --}}

                            @php
                                $stt = 0;
                            @endphp

                            @if (!empty($thongke))
                                
                                @foreach ($thongke as $value)
                                    
                                    <tr>
                                        <td>{{ $stt }}</td>
                                        <td>{{ $value->MASP }}</td>
                                        <td>{{ $value->TENSP }}</td>
                                        <td>{{ $value->SLNHAP }}</td>
                                        <td>{{ $value->SLXUAT }}</td>
                                        <td>{{ $value->SLTONKHO }}</td>
                                    </tr>

                                    @php
                                        $stt += 1;
                                    @endphp

                                @endforeach

                            @endif
                                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
